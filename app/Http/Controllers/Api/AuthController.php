<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Traits\ApiResponse;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Password;
use App\Http\Requests\forgotPasswordRequest;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    use ApiResponse;
    public function register(RegisterRequest $request)
    {
        User::create($request->validated());

        return $this->successMessage(__('auth.register_success'));
    }

    public function login(LoginRequest $request)
    {
        $user = User::where(function ($query) use ($request) {
            $query->where('email', $request->email)
                ->orWhere('phone', $request->phone);
        })->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return $this->errorResponse(__('auth.invalid_credentials'), 401);
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        return $this->successResponse([
            'user' => new UserResource($user),
            'access_token' => $token,
        ], __('auth.login_success'));
    }


    public function forgotPassword(forgotPasswordRequest $request)
    {

        $status = Password::sendResetLink(
            $request->only('email')
        );

        if ($status === Password::RESET_LINK_SENT) {
            return $this->successResponse(
                [],
                __('messages.password_reset_link_sent'),
                200
            );
        }

        return $this->errorResponse(
            __('messages.password_reset_user_not_found'),
            422
        );
    }



    public function resetPassword(Request $request)
    {


        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->save();
            }
        );

        if ($status === Password::PASSWORD_RESET) {
            return $this->successResponse(
                [],
                __('messages.password_reset_success'),
                200
            );
        }

        return $this->errorResponse(
            __('messages.password_reset_failed'),
            422
        );
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return $this->successMessage(__('auth.logout_success'));
    }
}
