<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Bus;
use Illuminate\Bus\Batch;
use App\Helpers\FileHelper;
use Illuminate\Support\Facades\Log;

class QueueProcess extends Model
{
    protected $table = 'queue_process';
    protected $primaryKey = 'queue_id';

    const FILE_PATH = 'queue-files/';

    const STATUS_PROCESSING = 'processing';
    const STATUS_PROCESSED  = 'processed';
    const STATUS_FAIL       = 'fail';
    const STATUS_ON_QUEUE   = 'on_queue';
    const STATUS_WAITING    = 'waiting';
    const STATUS_APPROVED = 'approved';

    protected $fillable = [
        'queue_uid',
        'batch_id',
        'ip',
        'user_id',
        'class_id',
        'queue',
        'data',
        'status',
        'progress',
        'created_at',
        'updated_at',
        'finished_at',
        'deleted_at',
    ];

    protected $casts = [
        'data' => 'array',
        'progress' => 'array'
    ];

    protected $appends = [
        'jobBatch'
    ];

    public function getJobBatchAttribute() {
        return $this->batch_id ? Bus::findBatch($this->batch_id) : null;
    }

    public function finishJobBatch(Batch $batch)
    {
        self::withoutEvents(function () use ($batch) {

            $qp = self::where('queue_id', $this->queue_id)->first();

            $status = $qp->status;

            $this->update([
                "status"      => $status === self::STATUS_FAIL ? self::STATUS_FAIL : self::STATUS_PROCESSED,
                "finished_at" => now()
            ]);

            $this->saveQuietly();

            // $batch->cancel();
        });
    }

    public static function batchValues($b)
    {
        $processedJobs = $b->processedJobs() + ($b->failedJobs);
        $progress = (int) ($b->totalJobs > 0 ? round(($processedJobs / $b->totalJobs) * 100) : 0);

        $manyFailures = false;

        if ($processedJobs > 0) {
            $perCentFailure = ($b->failedJobs * 100) / $processedJobs;

            if ($progress >= 5 && $perCentFailure >= 80) {
                $manyFailures = true;
            }
        }

        return [
            "progress"     => $progress,
            "total"        => $b->totalJobs,
            "done"         => $processedJobs,
            "fail"         => $b->failedJobs,
            "manyFailures" => $manyFailures,
        ];
    }

    public function clearTempFolder()
    {
        $data = json_decode($this->data, true);

        foreach ($data['activities'] as $key => $activity) {
            if(!isset($activity['file'])) continue;

            FileHelper::deleteDirectory(dirname($activity['file']['path']));
        }
    }

}
