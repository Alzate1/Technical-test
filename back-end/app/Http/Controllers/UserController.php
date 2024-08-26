<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Mail\getEmails;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    // Método para registrar un nuevo usuario
    // Desarrollado por Juan Camilo Alzate
    public function register(Request $request)
    {
        try {
            // Validar los datos del request
            $request->validate([
                'username' => 'required|string|max:50',
                'name' => 'required|string|max:50',
                'email' => 'required|string|max:50',
                'password' => 'required'
            ]);

            // Verificar si el nombre de usuario ya está registrado
            $existingUsers = User::where('username', '=', $request->input('username'))->first();

            // Verificar si el correo electrónico ya está registrado
            $existingEmailByUsers = User::where('email', '=', $request->input('email'))->first();

            // Si el nombre de usuario ya existe, devolver un error 409
            if ($existingUsers) {
                return response()->json(['userError' => true, 'message' => 'El nombre de usuario ya existe.'], 409);
            }
            // Si el correo electrónico ya existe, devolver un error 409
            else if ($existingEmailByUsers) {
                return response()->json(['emailError' => true, 'message' => 'El correo electrónico ya está registrado.'], 409);
            }

            // Crear un nuevo usuario
            $user = new User();
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $user->username = $request->input('username');
            $user->password = bcrypt($request->input('password')); // Cifrar la contraseña
            $user->email_verified_at = now(); // Marcar el correo electrónico como verificado

            // Asignar un ID por defecto si solo hay un usuario (opcional)
            // $user->id = 1; // Esta línea puede ser opcional, dependiendo de la configuración de la base de datos

            $user->save(); // Guardar el nuevo usuario en la base de datos

            // Preparar los datos para el correo electrónico
            $data = [
                'username' => $user->username,
                'password' => $request->input('password'),
            ];

            // Enviar un correo electrónico de bienvenida al usuario
            $email = $user->email = $request->input('email');
            Mail::to($email)->send(new getEmails($data));

            // Devolver una respuesta de éxito
            return response()->json(['success' => true]);

        } catch (\Throwable $th) {
            // Manejo de excepciones y devolver un error 500
            return response()->json(['error' => 'Ocurrió un error durante el registro', 'detalle' => $th->getMessage()], 500);
        }
    }
}
