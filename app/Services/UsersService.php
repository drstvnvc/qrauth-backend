<?php

namespace App\Services\Api;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UsersService {
    public function registerUser($data) {
        $data['password'] = Hash::make($data['password']);
        $user = User::create($data);
        return $user;
    }

}
