<?php

namespace App\Modules\User\Services;

use App\Helpers\TransformerResponse;
use App\Modules\User\Repositories\Interfaces\UserRepositoryInterface;
use App\Modules\User\Services\Interfaces\UserServiceInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;

class UserService implements UserServiceInterface
{
    private $userRepository;
    private $transformerResponse;

    const LOGIN_SUCCESS = "Login Successfully";
    const LOGIN_FAIL = "Login failed";

    public function __construct(
        TransformerResponse $transformerResponse,
        UserRepositoryInterface $userRepositoryInterface
    )
    {
        $this->transformerResponse = $transformerResponse;
        $this->userRepository      = $userRepositoryInterface;
    }

    public function register($request)
    {
        try {
            $validated = $request->validated();
            $validated["password"] = bcrypt($validated["password"]);
            $user = $this->userRepository->create($validated);
            return $this->transformerResponse->response(
                false,
                [
                    'user' => $user
                ],
                TransformerResponse::HTTP_CREATED,
                TransformerResponse::CREATE_SUCCESS_MESSAGE
            );
        } catch (QueryException $exception) {
            return $this->transformerResponse->response(
                true,
                [],
                TransformerResponse::HTTP_INTERNAL_SERVER_ERROR,
                TransformerResponse::INTERNAL_SERVER_ERROR_MESSAGE
            );

        } catch (ModelNotFoundException $exception) {
            return $this->transformerResponse->response(
                true,
                [],
                TransformerResponse::HTTP_NOT_FOUND,
                TransformerResponse::NOT_FOUND_MESSAGE,
            );
        }
    }

    public function login($request)
    {
        try {
            $validated = $request->only('name','password');

            if (Auth::attempt($validated)) {
                $user = auth()->user();
                $token = Auth::user()->createToken('son')->accessToken;
                return $this->transformerResponse->response(
                    false,
                    [
                        'user' => $user,
                        'token' => $token,
                    ],
                    TransformerResponse::HTTP_OK,
                    self::LOGIN_SUCCESS,
                );
            }

            return $this->transformerResponse->response(
                true,
                [],
                TransformerResponse::HTTP_OK,
                self::LOGIN_FAIL,
            );
        } catch (QueryException $exception) {
            return $this->transformerResponse->response(
                true,
                [],
                TransformerResponse::HTTP_INTERNAL_SERVER_ERROR,
                TransformerResponse::INTERNAL_SERVER_ERROR_MESSAGE
            );
        } catch (ModelNotFoundException $exception) {
            return $this->transformerResponse->response(
                true,
                [],
                TransformerResponse::HTTP_NOT_FOUND,
                TransformerResponse::NOT_FOUND_MESSAGE,
            );
        }
    }

    public function getCurrentUser()
    {
        try {
            $user = auth()->user();
            return $this->transformerResponse->response(
                false,
                [
                    'user' => $user
                ],
                TransformerResponse::HTTP_OK,
                TransformerResponse::GET_SUCCESS_MESSAGE
            );
        } catch (QueryException $exception) {
            return $this->transformerResponse->response(
                true,
                [],
                TransformerResponse::HTTP_INTERNAL_SERVER_ERROR,
                TransformerResponse::INTERNAL_SERVER_ERROR_MESSAGE
            );
        } catch (ModelNotFoundException $exception) {
            return $this->transformerResponse->response(
                true,
                [],
                TransformerResponse::HTTP_NOT_FOUND,
                TransformerResponse::NOT_FOUND_MESSAGE,
            );
        }
    }
}
