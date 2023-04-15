<?php

namespace App\Services\User;

use LaravelEasyRepository\Service;
use App\Repositories\User\UserRepository;
use App\Traits\PrintLog;
use Illuminate\Support\Facades\{Auth, Hash, Session, Validator};

class UserServiceImplement extends Service implements UserService{
    use PrintLog;
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

                $data = [
                    'access_token'  => $tokenPlain,
                    'token_type'    => 'Bearer',
                    'user'          => $user,
                ];

                $session = [
                    'id'         => $user->id,
                    'avatar'     => $user->avatar,
                    'email'      => $user->email,
                    'name'       => $user->name,
                    'branch_id'  => $user->branch_id,
                    'company_id' => $user->company_id,
                    'token'      => $tokenPlain,
                ];
                session($session);

                $result['message']  = __('content.ok');
                $result['data']     = $data;
                $result['code']     = 200;
            }
        } else {
            $result['message']  = __('auth.account_not_found');
        }

        return $result;
    }

    function signout($request): array
    {
        $userId  = Session::get('id');

        $user = $this->mainRepository->getUserById($userId)->first();
        $user->tokens()->delete(); // remove token
        $request->session()->flush(); // remove session
        $result = [
            'success'   => true,
            'code'      => 200,
            'message'   => __('auth.logout'),
        ];

        return $result;
    }
}
