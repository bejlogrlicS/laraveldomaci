<?php

namespace App\Http\Controllers;

use App\Http\Resources\TimR;
use App\Models\Tim;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TimController extends ResponseController
{
    public function index()
    {
        $timovi = Tim::all();
        return $this->porukaOUspehu(TimR::collection($timovi), 'Prikazani su svi timovi.');
    }


    public function store(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'tim' => 'required',
            'drzava' => 'required'
        ]);

        if($validator->fails()){
            return $this->porukaOGresci($validator->errors());
        }

        $tim = Tim::create($input);

        return $this->porukaOUspehu(new TimR($tim), 'Kreiran je novi tim.');
    }


    public function show($ID)
    {
        $tim = Tim::find($ID);
        if (is_null($tim)) {
            return $this->porukaOGresci('Tim sa zadatim id-em ne postoji.');
        }
        return $this->porukaOUspehu(new TimR($tim), 'Tim sa zadatim id-em je prikazan.');
    }


    public function update(Request $request, $ID)
    {
        $tim = Tim::find($ID);
        if (is_null($tim)) {
            return $this->porukaOGresci('Tim sa zadatim id-em ne postoji.');
        }

        $input = $request->all();

        $validator = Validator::make($input, [
            'tim' => 'required',
            'drzava' => 'required'
        ]);

        if($validator->fails()){
            return $this->porukaOGresci($validator->errors());
        }

        $tim->tim = $input['tim'];
        $tim->drzava = $input['drzava'];
        $tim->save();

        return $this->porukaOUspehu(new TimR($tim), 'Podaci o timu su azurirani.');
    }

    public function destroy($ID)
    {
        $tim = Tim::find($ID);
        if (is_null($tim)) {
            return $this->porukaOGresci('Tim sa zadatim id-em ne postoji.');
        }

        $tim->delete();
        return $this->porukaOUspehu([], 'Tim je obrisan.');
    }

}
