<?php

namespace App\Repositories\Subdistrict;

use LaravelEasyRepository\Repository;

interface SubdistrictRepository extends Repository{

    public function getAll($provienceId, $search = null);
}
