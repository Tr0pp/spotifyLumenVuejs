<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    private $_user;

    public function __construct(User $user)
    {
        $this->_user = $user;
        $this->middleware('auth');
    }

    public function index()
    {
        return $this->_user->paginate(10);
    }

    public function show($id)
    {
        return $this->_user->find($id);
    }
}
