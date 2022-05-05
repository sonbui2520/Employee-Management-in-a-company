<?php

namespace App\Modules\User\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\User\Requests\UserLoginRequest;
use App\Modules\User\Requests\UserRegisterRequest;
use App\Modules\User\Services\Interfaces\UserServiceInterface;

class UserController extends Controller
{
    private $userService;

    public function __construct(UserServiceInterface $userSevice)
    {
        $this->userService = $userSevice;
    }

    public function register(UserRegisterRequest $request)
    {
        return $this->userService->register($request);
    }

    public function login(UserLoginRequest $request)
    {
        return $this->userService->login($request);
    }

    public function getCurrentUser()
    {
        return $this->userService->getCurrentUser();
    }
}
