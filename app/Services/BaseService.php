<?php

namespace App\Services;

use App\Traits\PrintLog;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\{Crypt, DB, Log};

class BaseService implements InterfaceService
{
    use PrintLog;

    public function __construct()
    {
        if(config('app.debug') == true){
            DB::enableQueryLog();
        }
    }

    function logError($message){
		Log::channel('global-error')->error($message);
	}

	function logInfo($message){
		Log::channel('global-info')->info($message);
	}

    /**
     * Find an item by id
     * @param mixed $id
     * @return array
     */
    public function find($id)
    {
        $result = [
            'success'   => false,
            'code'      => 400,
        ];
        try {
            $id = Crypt::decrypt($id);
            $data = $this->mainRepository->find($id);
            if(!$data){
                $result['code'] = 404;
                $result['message'] = __('content.not_found');
            } else {
                $result['code'] = 200;
                $result['message'] = __('content.ok');
                $result['data'] = $data;
            }
        } catch (DecryptException $e) {
            if(config('app.debug') == true){
                $result['message'] = $e->getMessage();
            } else {
                $result['message'] = __('content.payload_invalid');
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

    /**
     * Find an item by id or fail
     * @param mixed $id
     * @return Model|null
     */
    public function findOrFail($id)
    {
        $data = $this->mainRepository->findOrFail($id);
        $found = $data ? true : false;
        $result = [
            'success'   => $found,
            'code'      => $found ? 200 : 404,
            'message'   => __('content.ok'),
            'data'      => $data,
        ];
        return $result;
    }

    /**
     * Return all items
     * @return Collection|null
     */
    public function all()
    {
        $data = $this->mainRepository->all();
        $result = [
            'success'   => true,
            'code'      => 200,
            'message'   => __('content.ok'),
            'data'      => $data,
        ];
        return $result;
    }

    /**
     * Create an item
     * @param array $data
     * @return array
     */
    // public function create(FormRequest $formRequest)
    // {
    //     DB::beginTransaction();
    //     $result = [
    //         'success'   => false,
    //         'code'      => 400,
    //         'message'   => __('content.something_error'),
    //     ];
    //     try {
    //         $data = $formRequest->all();
    //         $store = $this->mainRepository->create($data);
    //         if($store){
    //             DB::commit();
    //             $result['success'] = true;
    //             $result['code'] = 201;
    //             $result['data'] = $data;
    //             $result['message'] = __('content.ok');
    //         } else {
    //             DB::rollback();
    //             $result['code'] = 500;
    //         }
    //     }  catch (\Throwable $th) {
    //         DB::rollback();
    //         if(config('app.debug') == true){
    //             $result['message'] = $th->getMessage();
    //         } else {
    //             $result['message'] = __('content.something_error');
    //         }
    //     }
    //     return $result;
    // }
    public function create($data)
    {
        DB::beginTransaction();
        $result = [
            'success'   => false,
            'code'      => 400,
            'message'   => __('content.something_error'),
        ];
        try {
            $store = $this->mainRepository->create($data);
            if($store){
                DB::commit();
                $result['success'] = true;
                $result['code'] = 201;
                $result['data'] = $data;
                $result['message'] = __('content.ok');
            } else {
                DB::rollback();
                $result['code'] = 500;
            }
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

    /**
     * Update a model
     * @param int|mixed $id
     * @param array $data
     * @return array
     */
    // public function update($id, FormRequest $formRequest)
    // {
    //     DB::beginTransaction();
    //     $result = [
    //         'success'   => false,
    //         'code'      => 400,
    //         'message'   => __('content.something_error'),
    //     ];
    //     try {
    //         $data = $formRequest->all();
    //         $id  = Crypt::decrypt($id);
    //         $update = $this->mainRepository->update($id, $data);
    //         if($update){
    //             DB::commit();
    //             $result['success'] = true;
    //             $result['code'] = 200;
    //             $result['data'] = $data;
    //             $result['message'] = __('content.ok');
    //         } else {
    //             DB::rollback();
    //             $result['code'] = 500;
    //         }
    //     } catch (DecryptException $e) {
    //         DB::rollback();
    //         if(config('app.debug') == true){
    //             $result['message'] = $e->getMessage();
    //         } else {
    //             $result['message'] = __('content.payload_invalid');
    //         }
    //     } catch (\Throwable $th) {
    //         DB::rollback();
    //         if(config('app.debug') == true){
    //             $result['message'] = $th->getMessage();
    //         } else {
    //             $result['message'] = __('content.something_error');
    //         }
    //     }
    //     return $result;
    // }
    public function update($id, $data)
    {
        DB::beginTransaction();
        $result = [
            'success'   => false,
            'code'      => 400,
            'message'   => __('content.something_error'),
        ];
        try {
            $id  = Crypt::decrypt($id);
            $update = $this->mainRepository->update($id, $data);
            if($update){
                DB::commit();
                $result['success'] = true;
                $result['code'] = 200;
                $result['data'] = $data;
                $result['message'] = __('content.ok');
            } else {
                DB::rollback();
                $result['code'] = 500;
            }
        } catch (DecryptException $e) {
            DB::rollback();
            if(config('app.debug') == true){
                $result['message'] = $e->getMessage();
            } else {
                $result['message'] = __('content.payload_invalid');
            }
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

    /**
     * Delete a model
     * @param int|Model $id
     * @return array
     */
    public function delete($id)
    {
        DB::beginTransaction();
        $result = [
            'success'   => false,
            'code'      => 400,
        ];
        try {
            $id  = Crypt::decrypt($id);
            $result['success'] = true;
            $result['code'] = 200;
            $result['data'] = $this->mainRepository->delete($id);
            $result['message'] = __('content.success_delete');
            DB::commit();
        } catch (DecryptException $e) {
            DB::rollback();
            if(config('app.debug') == true){
                $result['message'] = $e->getMessage();
            } else {
                $result['message'] = __('content.payload_invalid');
            }
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

    /**
     * multiple delete
     * @param array $id
     * @return array
     */
    public function destroy(array $id)
    {
        DB::beginTransaction();
        $result = [
            'success'   => false,
            'code'      => 400,
        ];
        try {
            $decId = [];
            foreach ($id as $v ) {
                $decId[] = Crypt::decrypt($v);
            }
            $result['success'] = true;
            $result['code'] = 200;
            $result['data'] = $this->mainRepository->destroy($decId);
            DB::commit();
        } catch (DecryptException $e) {
            DB::rollback();
            if(config('app.debug') == true){
                $result['message'] = $e->getMessage();
            } else {
                $result['message'] = __('content.payload_invalid');
            }
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
}
