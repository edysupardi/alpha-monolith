<?php

namespace App\Services\Branch;

use LaravelEasyRepository\BaseService;

interface BranchService extends BaseService{

    public function getById($encryptId): array;
    public function myBranchs(): array;
}
