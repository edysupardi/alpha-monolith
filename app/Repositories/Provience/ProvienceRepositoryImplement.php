<?php

namespace App\Repositories\Provience;

use LaravelEasyRepository\Implementations\Eloquent;
use App\Models\Provience;

class ProvienceRepositoryImplement extends Eloquent implements ProvienceRepository{

    /**
    * Model class to be used in this repository for the common methods inside Eloquent
    * Don't remove or change $this->model variable name
    * @property Model|mixed $model;
    */
    protected Provience $model;

    public function __construct(Provience $model)
    {
        $this->model = $model;
    }

    public function getAll($search = null)
    {
        return $this->model->likeByName($search)->get();
    }
}
