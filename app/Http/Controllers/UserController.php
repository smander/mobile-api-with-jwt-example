<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $userService;

    /**
     * Create a new controller instance.
     *
     * @var UserService $userService
     *
     * @return void
     */
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
        $this->middleware('auth');
    }

    /**
     * Show all users
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = $this->userService->getAllUsers();

        $params = [
            'users' => $users
        ];

        return view('home',$params);
    }


    /*
     *
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
        $user = $this->userService->findUserByid($id);

        $params = [
            'user' => $user
        ];

        return view('auth.update',$params);
    }

    /*
     *
     * @return \Illuminate\Http\Response
     */
    public function updateProfile(Request $request)
    {
        $user = $this->userService->updateUser($request->all());

        return back();
    }
}
