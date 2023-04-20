<?php

namespace App\Services\Branch;

use App\Helpers\Strings;
use App\Repositories\Branch\BranchRepository;
use App\Services\BaseService;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class BranchServiceImplement extends BaseService implements BranchService{

     /**
     * don't change $this->mainRepository variable name
     * because used in extends service class
     */
     protected $mainRepository;

    public function __construct(BranchRepository $mainRepository)
    {
      $this->mainRepository = $mainRepository;
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
            unset($v['provience_id']);
            unset($v['district_id']);
            unset($v['subdistrict_id']);
            unset($v['village_id']);
            unset($v['company_id']);
            $v['subdistrict'] = $v['subdistrict']['name'];
            $v['district'] = $v['district']['name'];
            $v['provience'] = $v['provience']['name'];
            $v['simple_name'] = Strings::simpleString($v['name'], true, true);
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
}
