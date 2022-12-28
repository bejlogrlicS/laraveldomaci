<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserController extends ResponseController
{
    public function prijava(Request $request)
    {
        $uspesnoLogovanje = Auth::attempt(['email' => $request->email, 'password' => $request->password]);

        if($uspesnoLogovanje){
            $authUser = Auth::user();
            $odgovor['token'] =  $authUser->createToken('Token')->plainTextToken;
            $odgovor['name'] =  $authUser->name;

            return $this->porukaOUspehu($odgovor, 'Uspesno ste se logovali. ');
        }
        else{
            return $this->porukaOGresci('Autentifikacija neuspesna.', ['error'=>'Greska pri podacima za logovanje']);
        }
    }

    public function registracija(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'confirm_password' => 'required|same:password',
        ]);

        if($validator->fails()){
            return $this->porukaOGresci('Greska pri validaciji', $validator->errors());
        }

        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        $odgovor['name'] =  $user->name;
        $odgovor['token'] =  $user->createToken('Token')->plainTextToken;

        return $this->porukaOUspehu($odgovor, 'Uspesno napravljen korisnik.');
    }
}
