<?php

namespace App\Repositories\Provience;

use LaravelEasyRepository\Repository;

interface ProvienceRepository extends Repository{

    public function getAll($search = null);
}
