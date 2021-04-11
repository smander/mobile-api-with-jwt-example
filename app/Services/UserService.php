<?php

namespace App\Services;

use App\Repository\Eloquent\UserRepository;
use App\User;

class UserService
{

    protected $userRepository;
    
    public function __construct(UserRepository $userRepository){
        $this->userRepository = $userRepository;
    }

    public function getAllUsers()
    {
        return $this->userRepository->all();
    }

    public function findUserByid($id)
    {
        return $this->userRepository->find($id);
    }

    public function updateUser($id)
    {
        return $this->userRepository->update($id);
    }

}
