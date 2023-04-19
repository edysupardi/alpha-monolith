<?php

namespace App\Services\Company;

use App\Helpers\OperatorIndonesia;
use App\Http\Requests\RequestCompany;
use App\Repositories\Company\CompanyRepository;
use App\Repositories\District\DistrictRepository;
use App\Repositories\Provience\ProvienceRepository;
use App\Repositories\Subdistrict\SubdistrictRepository;
use App\Repositories\Village\VillageRepository;
use App\Services\BaseService;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

class CompanyServiceImplement extends BaseService implements CompanyService{

    /**
     * don't change $this->mainRepository variable name
     * because used in extends service class
     */
    protected $mainRepository;
    protected ProvienceRepository $provienceRepository;
    protected DistrictRepository  $districtRepository;
    protected SubdistrictRepository $subdistrictRepository;
    protected VillageRepository $villageRepository;

    public function __construct(CompanyRepository $mainRepository, ProvienceRepository $provienceRepository,  DistrictRepository  $districtRepository,  SubdistrictRepository $subdistrictRepository,  VillageRepository $villageRepository)
    {
        $this->mainRepository = $mainRepository;
        $this->provienceRepository = $provienceRepository;
        $this->districtRepository = $districtRepository;
        $this->subdistrictRepository = $subdistrictRepository;
        $this->villageRepository = $villageRepository;
    }

    public function getById($encryptId): array
    {
        $result = [
            'success'   => false,
            'code'      => 400,
        ];

        try {
            $id = Crypt::decrypt($encryptId);
            $data = $this->mainRepository->find($id);
            if(!$data){
                $result['message']  = __('content.not_found');
                $result['code']     = 404;
            } else {
                $arrayData = $data->toArray();
                $arrayData['provience_id_ref'] = $data->provience_id;
                $arrayData['district_id_ref'] = $data->district_id;
                $arrayData['subdistrict_id_ref'] = $data->subdistrict_id;
                $arrayData['village_id_ref'] = $data->village_id;
                $result = [
                    'success' => true,
                    'code' => 200,
                    'message' => __('content.ok'),
                    'data' => $arrayData,
                ];
            }
        } catch (DecryptException $e) {
            $result['message'] = __('content.payload_invalid');
        } catch (\Throwable $th) {
            if(config('app.debug') == true){
                $result['message'] = $th->getMessage();
            } else {
                $result['message'] = __('content.something_error');
            }
        }
        return $result;
    }

    public function myCompany(): array
    {
        $user = Auth::user();
        $encryptId  = Crypt::encrypt($user->company_id);
        return $this->getById($encryptId);
    }

    public function updateMine(RequestCompany $request): array
    {
        $user = Auth::user();
        return $this->serviceUpdate($user->company_id, $request);
    }

    public function customUpdate($encryptId, RequestCompany $request): array
    {
        try {
            $companyId  = Crypt::decrypt($encryptId);

            return $this->serviceUpdate($companyId, $request);
        } catch (DecryptException $e) {
            $result = [
                'success'   => false,
                'code'      => 400,
                'message'   => __('content.payload_invalid'),
            ];
            return $result;
        }
    }

    private function serviceUpdate($companyId, RequestCompany $request): array
    {
        $result = [
            'success'   => false,
            'code'      => 400,
        ];

        DB::beginTransaction();
        try {
            $data = $this->validateRequest($request);
            if(!$data['success'])
                return $data;

            $update = $this->mainRepository->update($companyId, $data['data']);
            if($update){
                DB::commit();

                $updatedData = $this->myCompany();
                $result = [
                    'success'  => true,
                    'code'     => 200,
                    'message'  => __('content.success_save'),
                    'data'     => $updatedData['data'],
                ];
            } else {
                DB::rollBack();
                $result['message']  = __('content.something_error');
            }
            return $result;
        } catch (DecryptException $e) {
            DB::rollback();
            $result['message'] = __('content.payload_invalid');
        } catch (\Throwable $th) {
            DB::rollback();
            if(config('app.debug') == true){
                $result['message'] = $th->getMessage();
            } else {
                $result['message'] = __('content.something_error');
            }
        }
        return $result;
    }

    private function validateRequest(RequestCompany $request)
    {
        $result = [
            'success'   => false,
            'code'      => 400,
        ];

        $encryptProvience   = $request->provience;
        $provienceId        = Crypt::decrypt($encryptProvience);
        $provience          = $this->provienceRepository->find($provienceId);
        if(!$provience){
            $result['message']  = __('field.validation_errors');
            $result['data']['provience'] = [__('validation.exists', ['attribute' => __('field.provience')])];
            return $result;
        }

        $encryptDistrict    = $request->district;
        $districtId         = Crypt::decrypt($encryptDistrict);
        $district           = $this->districtRepository->find($districtId);
        if(!$district){
            $result['message']  = __('field.validation_errors');
            $result['data']['district']  = [__('validation.exists', ['attribute' => __('field.district')])];
            return $result;
        } else {
            if($district->provience_id != $provienceId){
                $result['message']  = __('field.validation_errors');
                $result['data']['district']  = [__('validation.same', ['attribute' => __('field.district'), 'other' => __('field.provience')])];
                return $result;
            }
        }

        $encryptSubdistrict     = $request->subdistrict;
        $subdistrictId          = Crypt::decrypt($encryptSubdistrict);
        $subdistrict            = $this->subdistrictRepository->find($subdistrictId);
        if(!$subdistrict){
            $result['message']  = __('field.validation_errors');
            $result['data']['subdistrict']  = [__('validation.exists', ['attribute' => __('field.subdistrict')])];
        } else {
            if($subdistrict->district_id != $districtId){
                $result['message']  = __('field.validation_errors');
                $result['data']['subdistrict']  = [__('validation.same', ['attribute' => __('field.subdistrict'), 'other' => __('field.district')])];
                return $result;
            }
        }

        $encryptVillage     = $request->village;
        $villageId          = Crypt::decrypt($encryptVillage);
        $village            = $this->villageRepository->find($villageId);
        if(!$village){
            $result['message']  = __('field.validation_errors');
            $result['data']['village']  = [__('validation.exists', ['attribute' => 'village'])];
        } else {
            if($village->subdistrict_id != $subdistrictId){
                $result['message']  = __('field.validation_errors');
                $result['data']['village']  = [__('validation.same', ['attribute' => __('field.village'), 'other' => __('field.subdistrict')])];
                return $result;
            }
        }

        $checkPhone = OperatorIndonesia::correction($request->phone_number);
        if(!$checkPhone){
            $result['message']  = __('field.validation_errors');
            $result['data']['phone_number']  = [__('validation.regex', ['attribute' => __('field.phone_number')])];
            return $result;
        }
        $phoneNumber = OperatorIndonesia::parse($request->phone_number);

        $data = [
            'name'             => strtoupper($request->name),
            'phone_number'     => $phoneNumber,
            'provience_id'     => $provienceId,
            'district_id'      => $districtId,
            'subdistrict_id'   => $subdistrictId,
            'village_id'       => $villageId,
            'zip_code'         => $request->zip_code,
            'address'          => trim($request->address),
        ];
        $result = [
            'success'   => true,
            'code'      => 200,
            'data'      => $data,
        ];

        return $result;
    }
}
