<?php

namespace App\Repositories\Poly;

use LaravelEasyRepository\Implementations\Eloquent;
use App\Models\Poly;

class PolyRepositoryImplement extends Eloquent implements PolyRepository{

    /**
    * Model class to be used in this repository for the common methods inside Eloquent
    * Don't remove or change $this->model variable name
    * @property Model|mixed $model;
    */
    protected $model;

    public function __construct(Poly $model)
    {
        $this->model = $model;
    }

    // Write something awesome :)
}
