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
    }

    public function index()
    {
        return $this->user->paginate(10);
    }

    public function register(Request $request) : JsonResponse
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'password_confirm' => 'required|same:password'
        ]);

        try {
            $user = new User();
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $user->password = Hash::make($request->input('password'));

            $message = 'Erro ao registrar';

            if ($user->save()) {
                $message = 'Registrado com sucesso !';
            }
        } catch (\Exception $e) {
            $message = $e->getMessage();
        }

        return response()->json([
            'data' => [
                'message' => $message
            ]
        ]);
    }

    /**
     * @throws \Illuminate\Validation\ValidationException
     */
    public function authentication(Request $request) : JsonResponse
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        try {
            $data = $this->user
                ->where('email', $request->get('email'))
                ->first();

            $message = "Usuário ou senha incorretos.";

            if ($data && Hash::check($request->get('password'), $data->password)) {
                $request->session()->put('user_logged', [
                    'user_id' => $data->id,
                    'user_name' => $data->name,
                    'user_email' => $data->email,
                ]);


                $message = "Logado com sucesso !";
            }
        } catch (\Exception $e) {
            $message = $e->getMessage();
        }

        return response()->json([
            'data' => [
                'message' => $message
            ]
        ]);
    }

    public function show($id)
    {
        return $this->user->find($id);
    }
}
