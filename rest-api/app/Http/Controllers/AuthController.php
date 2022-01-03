<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    private $_user;

    public function __construct(User $user)
    {
        $this->_user = $user;
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

            if ($user->save()) {
                $error = 0;
                $message = 'Registrado com sucesso !';
            }
        } catch (\Exception $e) {
            $message = $e->getCode();
            if($e->getCode() == $this->_user::EMAIL_EXISTENTE){
                $error = 1;
                $message = 'Email de usuário já existente.';
            }
        }

        return response()->json([
            'error' => $error,
            'message' => $message
        ]);
    }

    public function login1(Request $request)
    {
        //validate incoming request
        $this->validate($request, [
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        if($credentials = $request->only(['email', 'password'])) {
            $user_data = $this->_user
                ->where('email', $request->get('email'))
                ->first();
        }

        if (!$token = Auth::attempt($credentials)) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token, [
            'id_user' => $user_data->id,
            'email_user' => $user_data->email,
            'name_user' => $user_data->name,
            'access_level_user' => $user_data->access_level
        ]);
    }

    public function login(Request $request) : JsonResponse
    {
        if($request->session()->get('user_logged')){
            if($request->session()->get('user_logged')['user_email'] == $request->input('email')) {
                $token = Auth::attempt($request->input('email'));

                return $this->respondWithToken($token, [
                    $request->session()->get('user_logged'),
                ]);
            }
        }

        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        try {
            $data = $this->_user
                ->where('email', $request->get('email'))
                ->first();

            $message = "Usuário ou senha incorretos.";

            if ($token = Auth::attempt($request->only(['email', 'password']))) {
                $request->session()->put('user_logged', [
                    'user_id' => $data->id,
                    'user_name' => $data->name,
                    'user_email' => $data->email,
                    'access_level_user' => $data->access_level,
                    'is_logged' => true
                ]);

                return $this->respondWithToken($token, [
                    $request->session()->get('user_logged'),
                ]);

            }
        } catch (\Exception $e) {
            $message = $e->getMessage();
        }

        return response()->json([
            'message' => $message
        ]);
    }

    function logout(Request $request){
        $request->session()->pull('user_logged');
        $request->session()->flush();
        return response()->json(['message' => 'Deslogado com sucesso.']);

    }
}
