<?php

namespace App\Observers;

use App\Models\Append;

class AppendObserver
{
    public function creating(Append $append) {
        $append->append_uid = $append->generateUid();
    }
}
