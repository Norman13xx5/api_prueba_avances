<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $credentials = $request->only('identification_number', 'password');
        $token = Auth::guard('api')->setTTL(1440)->attempt($credentials);
        $typeUser = $request->type == 1 ? 'professional' : 'patient';
        if ($token) {
            return response()->json([
                "message" => "Bienvenido al sistema de gestión roles y permisos.",
                "typeUser" => $typeUser,
                'authorization' => [
                    'token' => $token,
                    'type' => 'bearer',
                ],
            ], 200);
        } else {
            return response()->json([
                "message" => "Las credenciales que ingresaste no son correctas, vuelve a intentarlo."
            ], 401);
        };
    }

    /**
     * A description of the entire PHP function.
     *
     * @param datatype $paramname description
     * @throws Some_Exception_Class description of exception
     * @return Some_Return_Value
     */
    public function getAllDataSesion()
    {
        try {
            $data = Auth::guard('api')->user();
            return response()->json(["message" => "Datos de sesion.", "data" => $data], 200);
        } catch (\Exception $e) {
            return response()->json(["message" => $e], 400);
        };
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout(Request $request)
    {
        Auth::guard('api')->logout();
        return response()->json(["message" => "Successfully logged out"], 200);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }

    /**
     * Register a new user.
     *
     * @param Request $request The request containing user information
     * @throws \Illuminate\Validation\ValidationException If validation fails
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'identification_number' => 'required|string|max:100|unique:users',
            'first_name' => 'required|max:100|',
            'last_name' => 'required|max:100|',
            'email' => 'required|string|email|max:100',
            'phone_number' => 'required|max:100|',
            'location' => 'required|max:100|',
            'password' => 'required|string|min:6',
            'type' => 'required|integer|max:2',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson(), 400);
        }

        $user = User::create(array_merge(
            $validator->validate(),
            ['password' => bcrypt($request->password)]
        ));

        return response()->json([
            'message' => '¡Usuario registrado exitosamente!',
            'user' => $user
        ], 201);
    }
}
