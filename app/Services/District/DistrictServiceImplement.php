<?php

namespace App\Services\District;

use App\Http\Requests\RequestDistrictAll;
use App\Services\BaseService;
use App\Repositories\District\DistrictRepository;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Crypt;

class DistrictServiceImplement extends BaseService implements DistrictService{

     /**
     * don't change $this->mainRepository variable name
     * because used in extends service class
     */
     protected $mainRepository;

    public function __construct(DistrictRepository $mainRepository)
    {
      $this->mainRepository = $mainRepository;
    }

    public function detail($encryptId) : array
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
                $result = [
                    'success' => true,
                    'code' => 200,
                    'message' => __('content.ok'),
                    'data' => $data,
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

    public function getAll(RequestDistrictAll $request) : array
    {
        $result = [
            'success'   => false,
            'code'      => 400,
        ];

        try {
            $provienceId = Crypt::decrypt($request->provience);
            $data = $this->mainRepository->getAll($provienceId, $request != null && $request->has('search') ? $request->search : null);
            if(!$data){
                $result['message']  = __('content.not_found');
                $result['code']     = 404;
            } else {
                $result = [
                    'success' => true,
                    'code' => 200,
                    'message' => __('content.ok'),
                    'data' => $data,
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
}
