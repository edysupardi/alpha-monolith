<?php

namespace App\Repositories\Village;

use LaravelEasyRepository\Repository;

interface VillageRepository extends Repository{

    public function getAll($provienceId, $search = null);
}
