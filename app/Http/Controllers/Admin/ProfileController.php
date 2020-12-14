<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    public function index(){

        $loggedId = intval(Auth::id());
        $user = User::find($loggedId);

        if($user) {
            return view('admin.profile.index', [
                'user' => $user
            ]);
        }

        return redirect()->route('admin');
    }

    public function save(Request $request)
    {
        $loggedId = intval(Auth::id());
        $user = User::find($loggedId);

        if($user) {
            $data = $request->only([
                'name',
                'email',
                'password',
                'password_confirmation'
            ]);


            $validator = Validator::make([
                'name'  => $data['name'],
                'email' => $data['email']
            ],[
                'name'  => ['required', 'string', 'max:100'],
                'email' => ['required', 'string', 'email', 'max:100']
            ]);

            // 1. Ateração do Nome
            $user->name = $data['name'];

            // 2. Alteração do E-mail
            if($user->email != $data['email']) {
                $hasEmail = User::where('email', $data['email'])->get();
                if(count($hasEmail) ===0) {
                    $user->email = $data['email'];
                } else {
                    $validator->errors()->add('email', __('validation.unique', [
                        'attribute' => 'email'
                    ]));
                }
            }

            //3 Alteração da Senha
            //3.1 Verifica se o usuário digitou a senha

            if(!empty($data['password'])) {
                // 3.2 Verifica se a cofirmação está OK
                if(strlen($data['password']) >= 4 ){ 
                    if($data['password'] === $data['password_confirmation']) {
                        //3.3 Altera a Senha
                        $user->password = Hash::make($data['password']);
                    } else {
                        $validator->errors()->add('password', __('validation.confirmed', [
                            'attribute' => 'password'
                        ])); 
                    }
                 }else {
                    $validator->errors()->add('password', __('validation.min.string', [
                        'attribute' => 'Password',
                        'min' => 4
                    ]));
                }
            }

            if(count($validator->errors()) > 0) {
                return redirect()->route('profile', [
                    'user' => $loggedId
                ])->withErrors($validator);
            }

            $user->save();

            return redirect()->route('profile')
                   ->with('warning', 'Perfil alterado com sucesso!!!');
        }

        return redirect()->route('profile');
    }
}
