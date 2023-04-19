<?php

namespace App\Services\Village;

use App\Http\Requests\RequestVillageAll;
use LaravelEasyRepository\Service;
use App\Repositories\Village\VillageRepository;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Crypt;

class VillageServiceImplement extends Service implements VillageService{

     /**
     * don't change $this->mainRepository variable name
     * because used in extends service class
     */
     protected $mainRepository;

    public function __construct(VillageRepository $mainRepository)
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

    public function getAll(RequestVillageAll $request) : array
    {
        $result = [
            'success'   => false,
            'code'      => 400,
        ];

        try {
            $subdistrictId = Crypt::decrypt($request->subdistrict);
            $data = $this->mainRepository->getAll($subdistrictId, $request != null && $request->has('search') ? $request->search : null);
            if(!$data){
                $result['message']  = __('content.not_found');
                $result['code']     = 404;
            } else {
                $village = [];
                foreach ($data as $v) {
                    $village[] = [
                        'id' => $v->id,
                        'ref' => $v->id,
                        'name' => $v->name,
                    ];
                }
                $result = [
                    'success' => true,
                    'code' => 200,
                    'message' => __('content.ok'),
                    'data' => $village,
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
