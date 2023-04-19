<?php

namespace App\Services\Company;

use App\Http\Requests\RequestCompany;
use LaravelEasyRepository\BaseService;

interface CompanyService extends BaseService{

    public function getById($encryptId): array;
    public function myCompany(): array;
    public function updateMine(RequestCompany $request): array;
    public function customUpdate($encryptId, RequestCompany $request): array;
}
