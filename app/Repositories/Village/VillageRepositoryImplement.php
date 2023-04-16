<?php

namespace App\Repositories\Village;

use LaravelEasyRepository\Implementations\Eloquent;
use App\Models\Village;

class VillageRepositoryImplement extends Eloquent implements VillageRepository{

    /**
    * Model class to be used in this repository for the common methods inside Eloquent
    * Don't remove or change $this->model variable name
    * @property Model|mixed $model;
    */
    protected $model;

    public function __construct(Village $model)
    {
        $this->model = $model;
    }

    public function getAll($subdistrictId, $search = null)
    {
        return $this->model->bySubdistrict($subdistrictId)->likeByName($search)->orderByName()->get();
    }
}
