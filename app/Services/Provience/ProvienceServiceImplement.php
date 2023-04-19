<?php

namespace App\Services\Provience;

use App\Http\Requests\RequestProvienceAll;
use App\Repositories\Provience\ProvienceRepository;
use App\Services\BaseService;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Crypt;

class ProvienceServiceImplement extends BaseService implements ProvienceService{

     /**
     * don't change $this->mainRepository variable name
     * because used in extends service class
     */
     protected $mainRepository;

    public function __construct(ProvienceRepository $mainRepository)
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

    public function getAll(RequestProvienceAll $request = null) : array
    {
        $result = [
            'success'   => false,
            'code'      => 400,
        ];

        try {
            $data = $this->mainRepository->getAll($request != null && $request->has('search') ? $request->search : null);
            if(!$data){
                $result['message']  = __('content.not_found');
                $result['code']     = 404;
            } else {
                $provience = [];
                foreach ($data as $v) {
                    $provience[] = [
                        'id' => $v->id,
                        'ref' => $v->id,
                        'name' => $v->name,
                    ];
                }
                $result = [
                    'success' => true,
                    'code' => 200,
                    'message' => __('content.ok'),
                    'data' => $provience,
                ];
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
}
