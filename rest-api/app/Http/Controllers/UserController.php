<?php

namespace App\Http\Controllers;

use App\Models\User;

class UserController extends Controller
{
    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function index()
    {
        return $this->user->paginate(10);
    }
}
