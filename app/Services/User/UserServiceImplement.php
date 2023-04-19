<?php

namespace App\Services\User;

use App\Helpers\Strings;
use App\Repositories\User\UserRepository;
use App\Services\BaseService;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\{Auth, Crypt, Hash, Session};

class UserServiceImplement extends BaseService implements UserService{

    /**
     * don't change $this->mainRepository variable name
     * because used in extends service class
     */
    protected UserRepository $mainRepository;

    public function __construct(UserRepository $mainRepository)
    {
        $this->mainRepository = $mainRepository;
    }

    public function signin($email, $password): array
    {
        $result = [
            'success' => false,
            'code' => 400,
        ];

        // check user by email, exists or not
        $user = $this->mainRepository->getUserByEmail($email);
        if($user){
            if(!$user->status){
                $result['message']  = __('auth.nonactive');
            } else {
                // if email & password not matching
                if(Hash::check($password, $user->password)){
                    $result['message'] = __('auth.failed');
                }

                $token = $user->createToken('auth_token'); // create token
                $tokenPlain = $token->plainTextToken;
                $tokenId = $token->accessToken->id;

                $tokenType = 'Bearer';
                $data = [
                    'access_token'  => $tokenPlain,
                    'token_type'    => $tokenType,
                    'user'          => $user->toArray(),
                ];
                $data['user']['id'] = Crypt::encrypt($data['user']['id']);
                $data['user']['name'] = $user->personal->name;
                $data['user']['simple_name'] = Strings::simpleString($user->personal->name);
                unset($data['user']['personal_id']);
                unset($data['user']['personal']);

                $session = [
                    'id'          => Crypt::encrypt($user->id),
                    'avatar'      => $user->avatar,
                    'email'       => $user->email,
                    'name'        => $user->name,
                    'simple_name' => $data['user']['simple_name'],
                    'branch_id'   => Crypt::encrypt($user->branch_id),
                    'company_id'  => Crypt::encrypt($user->company_id),
                    'token'       => $tokenPlain,
                    'token_type'  => $tokenType,
                    'token_id'    => Crypt::encrypt($tokenId),
                ];
                session($session);
                // Auth::setUser($user);
                Auth::login($user);

                $result['message']  = __('content.ok');
                $result['data']     = $data;
                $result['code']     = 200;
            }
        } else {
            $result['message']  = __('auth.account_not_found');
            $result['code']     = 404;
        }

        return $result;
    }

    function signout($request): array
    {
        $result = [
            'success'   => false,
            'code'      => 400,
        ];
        try {
            $encryptUserId  = Session::get('id');
            if(!empty($encryptUserId)){
                $userId = Crypt::decrypt($encryptUserId);
                $user = $this->mainRepository->getUserById($userId);
                if($user){
                    $user->tokens()->delete(); // remove token
                }
            }
            $request->session()->flush(); // remove session
            Auth::logout();
            $result = [
                'success'   => true,
                'code'      => 200,
                'message'   => __('auth.logout'),
            ];
        } catch(DecryptException $e){
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

    public function getById($encryptId)
    {
        $result = [
            'success'   => false,
            'code'      => 400,
        ];
        try {
            $id = Crypt::decrypt($encryptId);
            $user = $this->mainRepository->getUserById($id);
            $userArray = $user->toArray();
            unset($userArray['id']);

            $result = [
                'success'   => true,
                'code'      => 200,
                'message'   => __('content.ok'),
                'data'      => $userArray,
            ];
        } catch(DecryptException $e){
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
