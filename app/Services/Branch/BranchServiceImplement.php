<?php

namespace App\Services\Branch;

use App\Helpers\OperatorIndonesia;
use App\Helpers\Strings;
use App\Http\Requests\BranchRequest;
use App\Repositories\Branch\BranchRepository;
use App\Repositories\District\DistrictRepository;
use App\Repositories\Provience\ProvienceRepository;
use App\Repositories\Subdistrict\SubdistrictRepository;
use App\Repositories\Village\VillageRepository;
use App\Services\BaseService;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

class BranchServiceImplement extends BaseService implements BranchService{

     /**
     * don't change $this->mainRepository variable name
     * because used in extends service class
     */
    protected $mainRepository;
    protected ProvienceRepository $provienceRepository;
    protected DistrictRepository  $districtRepository;
    protected SubdistrictRepository $subdistrictRepository;
    protected VillageRepository $villageRepository;

    public function __construct(BranchRepository $mainRepository, ProvienceRepository $provienceRepository,  DistrictRepository  $districtRepository,  SubdistrictRepository $subdistrictRepository,  VillageRepository $villageRepository)
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

    public function myBranchs(): array
    {
        $user = Auth::user();
        $companyId  = $user->company_id;
        $data = $this->mainRepository->getByCompanyId($companyId);
        $arrayData = [];
        foreach ($data as $val) {
            $v = $val->toArray();
            if($v['provience_id']){
                unset($v['provience_id']);
                $v['provience'] = $v['provience']['name'];
            } else {
                $v['provience'] = '';
            }
            if($v['district_id']){
                unset($v['district_id']);
                $v['district'] = $v['district']['name'];
            } else {
                $v['district'] = '';
            }
            if($v['subdistrict_id']){
                unset($v['subdistrict_id']);
                $v['subdistrict'] = $v['subdistrict']['name'];
            } else {
                $v['subdistrict'] = '';
            }

            unset($v['village_id']); // tidak di relasi dengan village, jadi tidak perlu menampilkan nama desanya
            unset($v['company_id']);
            $v['simple_name'] = Strings::simpleString($v['name'], true, true);
            $v['updated_at'] = $val->updated_at;
            $v['id_ref'] = $val->id;
            $arrayData[] = $v;
        }

        $result = [
            'success'   => true,
            'code'      => 200,
            'message'   => __('content.ok'),
            'data'      => $arrayData,
        ];
        return $result;
    }

    public function create($data)
    {
        DB::beginTransaction();
        $result = [
            'success'   => false,
            'code'      => 400,
            'message'   => __('content.error'),
        ];
        try {
            $user = Auth::user();
            $request = new BranchRequest();
            $request->replace($data);
            $validation = $this->validateRequest($request);
            if(!$validation['success'])
                return $validation;
            $data = $validation['data'];
            $data['company_id']      = $user->company_id;

            $result['success']              = true;
            $result['code']                 = 200;
            $result['data']                 = $this->mainRepository->create($data);
            $result['data']['simple_name']  = Strings::simpleString($data['name'], true, true);
            $result['data']['id_ref']       = $result['data']->id;
            $result['message']              = __('content.success_save');

            DB::commit();
        }  catch (\Throwable $th) {
            DB::rollback();
            if(config('app.debug') == true){
                $result['message'] = $th->getMessage();
            } else {
                $result['message'] = __('content.something_error');
            }
        }
        return $result;
    }

    public function update($id, $data)
    {
        $result = [
            'success'   => false,
            'code'      => 400,
            'message'   => __('content.error'),
        ];
        try {
            $request = new BranchRequest();
            $request->replace($data);
            $validation = $this->validateRequest($request);
            if(!$validation['success'])
                return $validation;
            $result = parent::update($id, $validation['data']);
            if($result['success']){
                $result['data']['simple_name'] = Strings::simpleString($data['name'], true, true);
                $result['data']['id_ref']      = Crypt::decrypt($id);
                $result['message']             = __('content.success_update');
            }
        } catch (\Throwable $th) {
            if(config('app.debug') == true){
                $result['message'] = $th->getMessage();
            } else {
                $result['message'] = __('content.something_error');
            }
        }
        return $result;
    }

    private function validateRequest($request)
    {
        $result = [
            'success'   => false,
            'code'      => 400,
            'message'   => __('content.something_error')
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
            'is_main'          => $request->has('is_main') && $request->is_main == 'on' ? 1 : 0,
        ];
        $result = [
            'success'   => true,
            'code'      => 200,
            'data'      => $data,
        ];

        return $result;
    }
}
