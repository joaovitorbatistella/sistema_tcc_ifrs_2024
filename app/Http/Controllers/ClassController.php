<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Append;
use App\Models\QueueProcess;
use App\Models\ClassTemplate;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Auth;
use App\Services\Contracts\ITCCService;
use App\Helpers\ArrayHelper;
use Illuminate\Bus\Batch;
use App\Jobs\ProcessingTccStudent;
use Illuminate\Support\Facades\Log;
use App\Helpers\FileHelper;
use \Carbon\Carbon;

class ClassController extends Controller
{

    private $tccService;

    public function __construct(ITCCService $tccService)
    {
        $this->tccService = $tccService;
    }

    public function index()
    {
        return view('turma.cadastroturma');
    }

    function step1(Request $request)
    {
        /*array_push(
            $values, 
            $request->input('semestre'),
            $request->input('ano'),
            $request->input('coordenador')
    );*/

        return response()->json(['status' => 'success', 'next' => 'step2']);
    }

    function step2(Request $request)
    {
    

        return response()->json(['status' => 'success', 'next' => 'step3']);
    }

    function step3(Request $request)
    {
    

        return response()->json(['status' => 'success', 'next' => 'finished']);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            // $request->validate([
            //     'file_1'  => 'mimes:pdf,jpg,png|max:2048',
            //     'file_2'  => 'mimes:pdf,jpg,png|max:2048',
            //     'file_3'  => 'mimes:pdf,jpg,png|max:2048',
            //     'file_4'  => 'mimes:pdf,jpg,png|max:2048',
            //     'file_5'  => 'mimes:pdf,jpg,png|max:2048'
            // ]);

            $data = [];
            // $activities = [];
            $students     = $request->get('students');
            $template_uid = $request->get('template');
            // $user_id      = $request->get('user_id');
            $class_name   = $request->get('year')."/".$request->get('semester');

            // foreach ($request->all() as $key => $value) {
            //     if(preg_match("/.+(_\d)$/", $key)) {
            //         $new_key = preg_replace("/_\d/", "", $key);

            //         $activities[(int) mb_substr($key, -1)][$new_key] =  $value;
            //     }
            // }

            // foreach ($activities as $key => $activity) {
            //     if(ArrayHelper::containsOnlyNull($activity)) {
            //         unset($activities[$key]);
            //     }
            // }

            $user_id            = Auth::id();
            $data['class_name'] = $class_name;
            $data['students']   = $students;
            $data['activities'] = $request->only('activities');
            
            if(isset($template_uid)) {
                $template = ClassTemplate::where('class_template_uid', $template_uid)->first();

                if(!isset($template)) throw new \Exception("Template not found", 401);

                $template_activities = (json_decode($template->payload));

                $template_activities = json_encode($template_activities);

                $template_activities = json_decode($template_activities, true);

                if(!isset($template_activities)) throw new \Exception("Template is broken", 401);

                $data['activities'] = $template_activities['activities'];
            } else {
                $data['activities'] = $data['activities']['activities'];
            }

            foreach ($data['activities'] as $key => $activity) {
                if(isset($activity['humanized_time'])) {
                    [$time, $unit] = explode('-', $activity['humanized_time']);
                    
                    $seconds = ClassTemplate::convertUnit($unit, (int) $time);
                    
                    $data['activities'][$key]['due_at'] = Carbon::now()->addSeconds($seconds)->format('Y-m-d h:i:s');
                } else {
                    $data['activities'][$key]['due_at'] = Carbon::createFromFormat('Y-m-d\TH:i', $data['activities'][$key]['due_at'])
                                                                ->format('Y-m-d h:i:s');
                }

                if(isset($activity['files'])) {
                    foreach ($activity['files'] as $k => $file) {
                        if($file instanceof UploadedFile) {
                            $file = $data['activities'][$key]['files'][$k];

                            $temp_path = $file->store($file->path());

                            $temp_path = storage_path("app/{$temp_path}");

                            $data['activities'][$key]['files'][$k] = [
                                "name"      => $file->getClientOriginalName(),
                                "extension" => $file->extension(),
                                "path"      => $temp_path,
                            ];
                        } else {
                            if(isset($file['append'])) {
                                $append = Append::where('append_id', $file['append'])->first();

                                if(!isset($append)) continue;

                                $data['activities'][$key]['files'][$k] = [
                                    "name"      => $append->name,
                                    "extension" => ".".pathinfo($append->name, PATHINFO_EXTENSION),
                                    "path"      => $append->path,
                                ];
                            }
                        }
                    }
                }
                // if(!isset($activity['file'])) continue;

                // $file = $data['activities'][$key]['file'];

                // $temp_path = $file->store($file->path());

                // $temp_path = storage_path("app/{$temp_path}");

                // $data['activities'][$key]['files'][] = [
                //     "name"      => $file->getClientOriginalName(),
                //     "extension" => $file->extension(),
                //     "path"      => $temp_path,
                // ];
            }

            $class = (object) $this->tccService->createTccClass(
                                                    $data['class_name'],
                                                    $user_id
                                                );

            if(!isset($class->tcc_class_id)) throw new \Exception("ERROR: tcc_class_id not found.");            

            $user_class = (object) $this->tccService->createUserClass(
                                        $class->tcc_class_id,
                                        $user_id
                                    );
            if(!isset($user_class->user_class_id)) throw new \Exception("ERROR: user_class_id not found.");            

            $response = (object) $this->tccService->createClassActivities(
                                                    $data['activities'],
                                                    $user_class->user_class_id,
                                                    $user_id
                                                );

            // Job Batch for students
            $queue_process = QueueProcess::create([
                'queue_uid' => uniqid(),
                'ip'        => $request->ip(),
                'user_id'   => $user_id,
                'class_id'  => $class->tcc_class_id,
                'queue'     => 'default',
                'data'      => json_encode($data),
                'status'    => QueueProcess::STATUS_ON_QUEUE
            ]);

            foreach ($data['students'] as $key => $student) {
                $jobs[] =   new ProcessingTccStudent(
                                    $queue_process->queue_id,
                                    $student
                                );
            }

            $batch = Bus::batch($jobs)
                ->finally(function (Batch $batch) use($queue_process) {
                    $jb = $queue_process->batchValues($batch);

                    if ($jb['progress'] === 100) {

                        $queue_process->clearTempFolder();
                        $queue_process->finishJobBatch($batch);

                    }
                })
                ->allowFailures()
                ->name('queue-process')
                ->onConnection('redis')
                ->onQueue('default')
                ->dispatch();

            if (filled($batch)) {
                $queue_process->batch_id    = $batch->id;
                $queue_process->status = QueueProcess::STATUS_APPROVED;
                $queue_process->approved_at = now();
                $queue_process->saveQuietly();
            }

            return response()->json([
                "success"   => true,
                "data"      => array(
                    "tcc_class_id"  => $class->tcc_class_id,
                    "on_queue"      => isset($queue_process->batch_id) ? true : false
                )
            ]);
        } catch (\Exception $e) {
            dd($e);
            Log::error($e);
            return response()->json([
                "success"   => false,
                "message"   => "An error ocurred."
            ]);
        }    
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
