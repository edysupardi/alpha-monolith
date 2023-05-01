<?php

namespace App\Services;

use App\Traits\PrintLog;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\{Crypt, DB, Log};
use LaravelEasyRepository\Service as CoreService;

class BaseService extends CoreService
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
     * @return Model|null
     */
    public function find($id)
    {
        $data = $this->mainRepository->find($id);
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
     * @param array|mixed $data
     * @return void
     */
    public function create($data)
    {
        $result = [
            'success'   => false,
            'code'      => 400,
        ];
        try {
            $result['success'] = true;
            $result['code'] = 200;
            $result['data'] = $this->mainRepository->create($data);
        }  catch (\Throwable $th) {
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
     * @param array|mixed $data
     * @return void
     */
    public function update($id, array $data)
    {
        $result = [
            'success'   => false,
            'code'      => 400,
        ];
        try {
            $id  = Crypt::decrypt($id);
            $result['success'] = true;
            $result['code'] = 200;
            $result['data'] = $this->mainRepository->update($id, $data);
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
     * Delete a model
     * @param int|Model $id
     * @return void
     */
    public function delete($id)
    {
        $result = [
            'success'   => false,
            'code'      => 400,
        ];
        try {
            $id  = Crypt::decrypt($id);
            $result['success'] = true;
            $result['code'] = 200;
            $result['data'] = $this->mainRepository->delete($id);
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
     * multiple delete
     * @param array $id
     * @return void
     */
    public function destroy(array $id)
    {
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
}
