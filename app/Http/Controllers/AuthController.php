<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\DeviceToken;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules\Password as RulesPassword;
use Illuminate\Validation\ValidationException;
use JWTAuth;
use function Pest\Laravel\json;

class AuthController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'register', 'forgotPassword', 'reset']]);
    }

    public function register(UserRequest $request)
    {
        $user = new User([
            'nome' => $request->nome,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        $user->save();
        //enviando email de verification
        event(new Registered($user));

        $token = $user->createToken('myapptoken')->plainTextToken;

        return response()->json([
            'message'=>'User has been registered',
            'user' => $user,
            'token' => $token
        ], 201);
    }

    public function editUser(Request $request, int $id)
    {

    }


    public function login()
    {
        $credentials = request(['email', 'password']);

        if (! $token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'E-mail ou senha inválidos!'], 401);
        }
//        dd(request());
        $device_token = request(['device_token'])['device_token'];
//        dd($device_token);
//        dd(request(['device_token'])['device_token']);

        $this->saveTokenDevice(auth()->id(), $device_token);
        //verificar se esta funcionando pra gravar os tokens do celular. primeiro no loca, depois subir

        return $this->respondWithToken($token);
    }


    public function me()
    {
        return response()->json(['user' => auth()->user(), 'animais' => auth()->user()->animais()->count()], 200);
    }


    public function logout()
    {
        auth()->logout();
        return response()->json(['message' => 'Logout realizado com sucesso']);
    }


    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    public function forgotPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        if ($status == Password::RESET_LINK_SENT) {
            return [
                'status' => __($status)
            ];
        }

        throw ValidationException::withMessages([
            'email' => [trans($status)],
        ]);
    }

    public function reset(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => ['required', 'confirmed', RulesPassword::defaults()],
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user) use ($request) {
                $user->forceFill([
                    'password' => Hash::make($request->password),
                    'remember_token' => Str::random(60),
                ])->save();

                $user->tokens()->delete();

                event(new PasswordReset($user));
            }
        );

        if ($status == Password::PASSWORD_RESET) {
            return response()->json(['message'=> 'Password reset successfully'], 200);
        }

        return response()->json([
            'message'=> __($status)
        ], 500);

    }

    public function sendVerificationEmail(Request $request)
    {
        if ($request->user()->hasVerifiedEmail()) {
            return [
                'message' => 'Already Verified'
            ];
        }

        $request->user()->sendEmailVerificationNotification();

        return ['status' => 'verification-link-sent'];
    }

    public function verify(EmailVerificationRequest $request)
    {
        if ($request->user()->hasVerifiedEmail()) {
            return [
                'message' => 'Email already verified'
            ];
        }

        if ($request->user()->markEmailAsVerified()) {
            event(new Verified($request->user()));
        }

        return [
            'message'=>'Email has been verified'
        ];
    }


    protected function respondWithToken(string $token)
    {
        return response()->json([
            'user' => auth()->user(),
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }

    public function destroy()
    {
        if(Auth::user()->id){
            User::find(Auth::user()->id)->delete();
            return response()->json(['message' => 'Usuário deletado com sucesso']);
        }
    }

    private function saveTokenDevice(int $id, String $token)
    {
        $token_device = new DeviceToken([
            'token_device' => $token,
            'id_user' => $id,
        ]);
        User::find($id)->tokenDevices()->save($token_device);
    }


}
