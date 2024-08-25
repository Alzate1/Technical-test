<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use App\Mail\getEmails;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
class UserController extends Controller
{
    public function register(Request $request){
        try {
            $request->validate([
                'username' => 'required|string|max:50',
                'name' => 'required|string|max:50',
                'email' => 'required|string|max:50',
                'password' => 'required'
            ]);
            $existingUsers = User::where('username', '=', $request->input('username'))->first();
            $existingEmailByUsers = User::where('email', '=', $request->input('email'))->first();

            if ($existingUsers) {
                // Nombre de usuario ya existe, devuelve una respuesta con mensaje de error y código 409
                return response()->json(['userError' => true, 'message' => 'El nombre de usuario ya existe.'], 409);
            } else if ($existingEmailByUsers) {
                // Correo ya existe, devuelve una respuesta con mensaje de error y código 409
                return response()->json(['emailError' => true, 'message' => 'El correo electrónico ya está registrado.'], 409);
            }
            $user = new User();
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $user->username = $request->input('username');
            $user->password = bcrypt($request->input('password'));
            $user->email_verified_at = now();
            $user->save();
            // Auth::login($user);
            $data = [
                'username' => $user->username,
                'password' => $request->input('password'),
            ];
            $email = $user->email = $request->input('email');
            Mail::to($email)->send(new getEmails($data));
            return response()->json(['success' => true]);
        } catch (\Throwable $th) {
            // Manejo de excepciones
            return response()->json(['error' => 'Ocurrió un error durante el registro', 'detalle' => $th->getMessage()], 500);
        }

    }
    public function login(Request $request)
    {
        try{
            $request->validate([
                'username' => 'required',
                'password' => 'required',
            ]);
            $user = User::where('username', $request['username'])->first();
            if ($user && Hash::check($request['password'], $user->password)) {
                Auth::login($user);
                return response()->json(['success' => true]);
            } else {
                return response()->json(['errorCredentails' => true,'message'=>'Las credenciales no son correctas.'],401);
            }
        }catch(\Throwable $th){
            return response()->json(['error' => 'Ocurrió un error durante el inicio de sesión', 'detalle' => $th->getMessage()], 500);
        }

    }
    public function logOut()
    {
        try{
            Auth::logout();

            return response()->json(['success' => true]);

        }catch (\Throwable $th) {
            // Manejo de excepciones
            return response()->json(['error' => 'Ocurrió un error al cerrar la sesión', 'detalle' => $th->getMessage()], 500);
        }

    }

}
