<?php
namespace App\Services;

use App\Models\TCC;
use App\Models\TccClass;
use App\Models\User;
use App\Models\UserClass;
use App\Models\UserClassActivity;
use App\Models\UserClassActivityAppend;
use App\Helpers\FileHelper;
use App\Services\Contracts\ITCCService;
use App\Services\Contracts\IAppendService;
use App\Exceptions\ObjectNotFound;
use \Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class TCCService implements ITCCService
{
    protected $append_service;

    public function __construct(IAppendService $appendService)
    {
        $this->append_service = $appendService;
    }

    public function createTccClass(
        string $name,
        int    $user_id
    ): array
    {
        try {
            $tcc = TCC::create([
                "user_id"   => $user_id,
                "name"      => $name,
                "status"    => 'in_progress'
            ]);
    
            if(!isset($tcc)) {
                throw new ObjectNotFound("TCC not Found.");
                
            }
    
            $class = TccClass::create([
                'tcc_type_id'   => 1,
                'tcc_id'        => $tcc->tcc_id,
                'status'        => 'in_progress'
            ]);

            return [
                "tcc_type_id"   => $class->tcc_type_id,
                "tcc_id"        => $class->tcc_id,
                "tcc_class_id"  => $class->tcc_class_id,
                "status"        => $class->status,
                "name"          => $tcc->name
            ];

        } catch (\Exception $e) {
            return [
                "error" => $e->getMessage()
            ];
        } catch (ObjectNotFound $e) {
            return [
                "error" => $e->getMessage()
            ];
        }
    }

    public function createUserClass(
        int   $class_id,
        int   $user_id
    ): array
    {
        try {
            $class = TccClass::find($class_id);

            if(!isset($class)) throw new ObjectNotFound("Class not found.");

            $user = User::find($user_id);

            if(!isset($user)) throw new ObjectNotFound("User not found.");

            $user_class = UserClass::create([
                              'tcc_class_id' => $class->tcc_class_id,
                              'user_id'     => $user->id
                          ]);

            return [
                'user_class_id' => $user_class->user_class_id
            ];

        } catch (\Exception $e) {
            return [
                "error" => $e->getMessage()
            ];
        } catch (ObjectNotFound $e) {
            return [
                "error" => $e->getMessage()
            ];
        }
    }

    public function createClassActivities(
        array $activities,
        int   $user_class_id,
        int   $user_id
    ): array
    {
        try {

            foreach ($activities as $activity) {    
                $activity = (object) $activity;
                                            
                $user_class_activity = UserClassActivity::create([
                                           'user_class_id' => $user_class_id,
                                           'name'          => $activity->name,
                                           'description'   => $activity->description,
                                           'due_at'        => $activity->due_at ?? null
                                       ]);

                if(!isset($user_class_activity)) throw new ObjectNotFound("User Class Activity not found");

                if(isset($activity->files)) {

                    foreach ($activity->files as $file) {
                        $append = (object)
                            $this->append_service->createAppend(
                                                    $file['path'],
                                                    $file['name'],
                                                    FileHelper::getSlugTypeByExtension(
                                                                    $file['extension']
                                                                ),
                                                    $user_id,
                                                    false
                                                );
                                                
                        Log::info('append', [$append]);

                        if(!isset($append)) throw new \Exception("Error create append");

                        $user_class_activity_append = 
                                UserClassActivityAppend::create([
                                    'user_class_activity_id' => $user_class_activity->user_class_activity_id,
                                    'append_id'              => $append->append_id,
                                ]);      
                                
                        if(!isset($user_class_activity_append)) throw new \Exception("Error user_class_activity_append");
                    }
                }

            }

            return [
                "user_class_activity" => $user_class_activity->user_class_activity_id
            ];

        } catch (\Exception $e) {
            throw $e;
        } catch (ObjectNotFound $e) {
            return [
                "error" => $e->getMessage()
            ];
        }
    }
}