<?php

namespace App\Services\Branch;

use App\Services\InterfaceService;

interface BranchService extends InterfaceService{

    public function getById($encryptId): array;
    public function myBranchs(): array;
}
