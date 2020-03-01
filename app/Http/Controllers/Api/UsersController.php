<?php

namespace App\Http\Controllers\Api;

use Illuminate\Auth\AuthenticationException;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Api\UsersService;
use Auth;
use App\Http\Requests\Users\RegisterRequest;
use App\Http\Requests\Users\LoginRequest;

class UsersController extends Controller
{

    private $usersService;
    public function __construct(UsersService $usersService)
    {
        $this->usersService = $usersService;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(RegisterRequest $request)
    {
        $user = $this->usersService->registerUser($request->validated());
        $token = Auth::login($user);
        return compact('token', 'user');
    }

    public function login(LoginRequest $request)
    {
        $credentials = $request->validated();
        if (!$token = Auth::attempt($credentials)) {
            throw new AuthenticationException;
        }

        $user = auth()->user();

        return compact('token', 'user');
    }

    public function getProfile(Request $request)
    {
        return auth()->user();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
