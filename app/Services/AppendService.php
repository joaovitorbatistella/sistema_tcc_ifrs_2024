<?php
namespace App\Services;

use App\Models\User;
use App\Models\Append;
use App\Models\AppendType;
use App\Helpers\FileHelper;
use App\Services\Contracts\IAppendService;
use App\Exceptions\ObjectNotFound;
use \Carbon\Carbon;
use Illuminate\Support\Facades\File;

class AppendService implements IAppendService
{

    public function createAppend(
        string $temp_path,
        string $name,
        string $type_slug = 'document',
        int    $user_id,
        bool   $is_public
    ): array
    {
        try {
            $user = User::find($user_id);

            if(!isset($user)) throw new ObjectNotFound("User not found.");

            $type_id = AppendType::findIdBySlug($type_slug);

            if(!isset($type_id)) throw new ObjectNotFound("Type not found.");

            $uid = uniqid();
            
            $path = storage_path("app/appends/$uid");

            if(!File::isDirectory($path)){
                $directory = File::makeDirectory($path, 0777, true, true);

                if(!$directory) throw new \Exception("Error on directory creation.");
            }
            $now = ( new Carbon())->toIso8601ZuluString();
            $path = $path."/$now"."$name";

            $moved = copy($temp_path, $path);

            // rmdir(dirname($temp_path));

            if(!$moved) throw new \Exception("Error file saving.");

            $append  =  Append::create([
                            'name'      => $name,
                            'user_id'   => $user_id,
                            'type_id'   => $type_id,
                            'public'    => $is_public,
                            'path'      => $path,
                        ]);

            if(!isset($append)) throw new ObjectNotFound("Append not found.");

            return [
                "append_id" => $append->append_id,
                "path"      => $append->path,
                "is_public" => $append->public,
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
}