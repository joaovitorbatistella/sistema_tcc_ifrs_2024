<?php

namespace App\Services\Contracts;

interface ITCCService {

    public function createTccClass(
        string $name,
        int $user_id
    ): array;

    public function createUserClass(
        int   $class_id,
        int   $user_id
    ): array;

    public function createClassActivities(
        array $activities,
        int $user_class_id,
        int $user_id
    ): array;
}