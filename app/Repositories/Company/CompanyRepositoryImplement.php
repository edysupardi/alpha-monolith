<?php

namespace App\Repositories\Company;

use LaravelEasyRepository\Implementations\Eloquent;
use App\Models\Company;

class CompanyRepositoryImplement extends Eloquent implements CompanyRepository{

    /**
    * Model class to be used in this repository for the common methods inside Eloquent
    * Don't remove or change $this->model variable name
    * @property Model|mixed $model;
    */
    protected $model;

    public function __construct(Company $model)
    {
        $this->model = $model;
    }

    public function find($id)
    {
        return $this->model->with([
            'village' => function($q){
                $q->select('id', 'name');
            },
            'subdistrict' => function($q){
                $q->select('id', 'name');
            },
            'district' => function($q){
                $q->select('id', 'name');
            },
            'provience' => function($q){
                $q->select('id', 'name');
            }
        ])->find($id);
    }
}
