<?php 

namespace App\Http\Controllers;

use App\Repository\UserRepositoryInterface;

class UsersController extends Controller
{
    private $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository; 
    }

    public function index() 
    {
        $users = $this->userRepository->all();
        return view('users.index', ['users' => $users]);
    }
}