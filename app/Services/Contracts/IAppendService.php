<?php

namespace App\Services\Contracts;

interface IAppendService {

    public function createAppend(
        string $temp_path,
        string $name,
        string $type_slug = 'document',
        int    $user_id,
        bool   $is_public
    ): array;
}