<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;
use Illuminate\Support\Facades\Log;

class AuthService
{
    /**
     * Create a new class instance.
     */
    public function __construct() {}

    public function create(array $data): User
    {
        $data['password'] = Hash::make($data['password']);

        return User::create($data);
    }

    public function login(array $credentials): string
    {
        if (!$token = auth('api')->attempt($credentials)) {
            Log::channel('security')->warning('Login falhou', [
                'email' => $credentials['email'],
                'ip' => request()->ip(),
            ]);

            throw new UnauthorizedHttpException('', 'Credenciais inválidas');
        }

        return $token;
    }
}
