<?php

namespace App\Http\Controllers;

use App\Http\Resources\MecR;
use App\Models\Mec;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MecController extends ResponseController
{
    public function index()
    {
        $mecevi = Mec::all();
        return $this->porukaOUspehu(MecR::collection($mecevi), 'Prikazani su svi mecevi.');
    }


    public function store(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'prviTimID' => 'required',
            'drugiTimID' => 'required',
            'rezultat' => 'required',
            'sportID' => 'required'
        ]);
        if($validator->fails()){
            return $this->porukaOGresci($validator->errors());
        }

        $mec = Mec::create($input);

        return $this->porukaOUspehu(new MecR($mec), 'Kreiran je novi mec.');
    }


    public function show($ID)
    {
        $mec = Mec::find($ID);

        if (is_null($mec)) {
            return $this->porukaOGresci('Mec sa zadatim id-em ne postoji.');
        }
        return $this->porukaOUspehu(new MecR($mec), 'Mec sa zadatim id-em je prikazan.');
    }


    public function update(Request $request, $ID)
    {
        $mec = Mec::find($ID);
        if (is_null($mec)) {
            return $this->porukaOGresci('Mec sa zadatim id-em ne postoji.');
        }

        $input = $request->all();

        $validator = Validator::make($input, [
            'prviTimID' => 'required',
            'drugiTimID' => 'required',
            'rezultat' => 'required',
            'sportID' => 'required'
        ]);

        if($validator->fails()){
            return $this->porukaOGresci($validator->errors());
        }

        $mec->prviTimID = $input['prviTimID'];
        $mec->drugiTimID = $input['drugiTimID'];
        $mec->rezultat = $input['rezultat'];
        $mec->sportID = $input['sportID'];
        $mec->save();

        return $this->porukaOUspehu(new MecR($mec), 'Podaci o mecu su azurirani.');
    }

    public function destroy($ID)
    {
        $mec = Mec::find($ID);
        if (is_null($mec)) {
            return $this->porukaOGresci('Mec sa zadatim id-em ne postoji.');
        }

        $mec->delete();

        return $this->porukaOUspehu([], 'Mec je obrisan.');
    }
}
