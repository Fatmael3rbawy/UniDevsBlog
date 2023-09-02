<?php

namespace Modules\User\Repositories;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Repositories\BaseRepository;
use Modules\User\Models\User;

class AuthRepository extends BaseRepository
{
   

    public function __construct(User $model)
    {
        parent::__construct($model);
    }

   
    public function login($request)
    {
       return Auth::attempt($request);
    }

   
}