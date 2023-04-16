<?php

namespace App\Repositories\District;

use LaravelEasyRepository\Implementations\Eloquent;
use App\Models\District;

class DistrictRepositoryImplement extends Eloquent implements DistrictRepository{

    /**
    * Model class to be used in this repository for the common methods inside Eloquent
    * Don't remove or change $this->model variable name
    * @property Model|mixed $model;
    */
    protected $model;

    public function __construct(District $model)
    {
        $this->model = $model;
    }

    public function getAll($provienceId, $search = null)
    {
        return $this->model->byProvience($provienceId)->likeByName($search)->orderByName()->get();
    }
}
