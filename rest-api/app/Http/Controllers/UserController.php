<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
        $this->middleware('auth');
    }

    public function index()
    {
        return $this->user->paginate(10);
    }

    public function show($id)
    {
        return $this->user->find($id);
    }
}
