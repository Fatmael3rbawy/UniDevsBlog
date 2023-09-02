<?php

namespace Modules\User\Http\Controllers;

use App\Http\Controllers\BaseResponse;
use Illuminate\Http\Request;
use Modules\User\Http\Requests\RegisterRequest;
use Illuminate\Support\Facades\DB;
use Modules\User\Http\Resources\UserResource;
use Modules\User\Repositories\AuthRepository;

class AuthController extends BaseResponse
{


    private $AuthRepository;
    public function __construct(AuthRepository $AuthRepository)
    {
        $this->AuthRepository = $AuthRepository;
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }


    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login()
    {
        $credentials = request(['email', 'password']);
        try {
            $token = $this->AuthRepository->login($credentials);
            if (!$token)
                return $this->response(101, 'Validation Error', 200,'These credentials do not match our records.');
            return $this->response(200, 'User is logged in successfully', 200, [],  [
                'token' => $token,
                'user' => new UserResource(auth()->user()),
            ]);
        } catch (\Exception $e) {
            return $this->response(500, $e->getMessage(), 500);
        }
    }

    function register(RegisterRequest $request)
    {
        DB::beginTransaction();
        try {
            $request->merge(['password'=> bcrypt($request->password)]);
            $result = $this->AuthRepository->create($request->all());
            DB::commit();
            return $this->response(200, 'User is registerd Successfully', 200, [], [
                'User' => new UserResource($result)
            ]);
        } catch (\Exception $e) {
            DB::rollback();
            return $this->response(500, $e->getMessage(), 500);
        }
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function myProfile()
    {
        return $this->response(200, 'User Details', 200, [], [
            'User' => new UserResource(auth()->user())
        ]);
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }
}
