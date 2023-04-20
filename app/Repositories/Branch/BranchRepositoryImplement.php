<?php

namespace App\Repositories\Branch;

use LaravelEasyRepository\Implementations\Eloquent;
use App\Models\Branch;

class BranchRepositoryImplement extends Eloquent implements BranchRepository{

    /**
    * Model class to be used in this repository for the common methods inside Eloquent
    * Don't remove or change $this->model variable name
    * @property Model|mixed $model;
    */
    protected $model;

    public function __construct(Branch $model)
    {
        $this->model = $model;
    }

    public function findComplete($id)
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

    public function getByCompanyId($companyId)
    {
        return $this->model->with([
            'subdistrict' => function($q){
                $q->select('id', 'name');
            },
            'district' => function($q){
                $q->select('id', 'name');
            },
            'provience' => function($q){
                $q->select('id', 'name');
            }
        ])->findByCompany($companyId)->get();
    }
}
