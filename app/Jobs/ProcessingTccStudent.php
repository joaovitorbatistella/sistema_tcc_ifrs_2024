<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Bus\Batchable;
use Illuminate\Bus\Batch;
use Illuminate\Support\Facades\Log;
use App\Models\QueueProcess;
use App\Services\Contracts\ITCCService;

class ProcessingTccStudent implements ShouldQueue
{
    use Dispatchable, Batchable, InteractsWithQueue, Queueable, SerializesModels;

    private int $queue_id;
    private int $student_id;
    private $tccService;

    /**
     * Create a new job instance.
     */
    public function __construct(int $queue_id, int $student_id)
    {
        $this->queue_id = $queue_id;
        $this->student_id = $student_id;
        $this->tccService = app(ITCCService::class);
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        try {
            if(!isset($this->queue_id)) throw new \Exception("queue_id not found.");

            $queue_process = QueueProcess::find($this->queue_id);

            if(!isset($queue_process)) throw new \Exception("queue_process not found.");

            $data = json_decode($queue_process->data, true);

            if(!isset($queue_process->class_id)) throw new \Exception("ERROR: class_id not found.");            

            $user_class = (object) $this->tccService->createUserClass(
                                        $queue_process->class_id,
                                        $this->student_id
                                    );
            if(!isset($user_class->user_class_id)) throw new \Exception("ERROR: user_class_id not found.");            

            $response = (object) $this->tccService->createClassActivities(
                                                    $data['activities'],
                                                    $user_class->user_class_id,
                                                    $this->student_id
                                                );
                            
            if(isset($response->error)) throw new \Exception($response->error);
        } catch (\Exception $e) {
            $this->fail($e);
        }
    }
}
