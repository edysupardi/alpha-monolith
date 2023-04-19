<?php

namespace App\Services\Subdistrict;

use App\Http\Requests\RequestSubdistrictAll;
use App\Repositories\Subdistrict\SubdistrictRepository;
use App\Services\BaseService;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Crypt;

class SubdistrictServiceImplement extends BaseService implements SubdistrictService{

    /**
     * don't change $this->mainRepository variable name
     * because used in extends service class
     */
    protected $mainRepository;

    public function __construct(SubdistrictRepository $mainRepository)
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

    public function getAll(RequestSubdistrictAll $request) : array
    {
        $result = [
            'success'   => false,
            'code'      => 400,
        ];

        try {
            $districtId = Crypt::decrypt($request->district);
            $data = $this->mainRepository->getAll($districtId, $request != null && $request->has('search') ? $request->search : null);
            if(!$data){
                $result['message']  = __('content.not_found');
                $result['code']     = 404;
            } else {
                $subdistrict = [];
                foreach ($data as $v) {
                    $subdistrict[] = [
                        'id' => $v->id,
                        'ref' => $v->id,
                        'name' => $v->name,
                    ];
                }
                $result = [
                    'success' => true,
                    'code' => 200,
                    'message' => __('content.ok'),
                    'data' => $subdistrict,
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
