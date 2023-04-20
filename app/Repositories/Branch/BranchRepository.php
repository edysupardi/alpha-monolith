<?php

namespace App\Repositories\Branch;

use LaravelEasyRepository\Repository;

interface BranchRepository extends Repository{

    public function findComplete($id);
    public function getByCompanyId($companyId);
}
