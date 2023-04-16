<?php

namespace App\Repositories\Subdistrict;

use LaravelEasyRepository\Implementations\Eloquent;
use App\Models\Subdistrict;

class SubdistrictRepositoryImplement extends Eloquent implements SubdistrictRepository{

    /**
    * Model class to be used in this repository for the common methods inside Eloquent
    * Don't remove or change $this->model variable name
    * @property Model|mixed $model;
    */
    protected $model;

    public function __construct(Subdistrict $model)
    {
        $this->model = $model;
    }

    public function getAll($provienceId, $search = null)
    {
        return $this->model->byDistrict($provienceId)->likeByName($search)->orderByName()->get();
    }
}
