<?php

namespace App\Repositories\District;

use LaravelEasyRepository\Repository;

interface DistrictRepository extends Repository{

    public function getAll($provienceId, $search = null);
}
