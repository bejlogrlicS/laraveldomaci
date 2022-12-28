<?php

namespace App\Http\Controllers;

use App\Http\Resources\SportR;
use App\Models\Sport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SportController extends ResponseController
{
    public function index()
    {
        $sportovi = Sport::all();
        return $this->porukaOUspehu(SportR::collection($sportovi), 'Prikazani su svi sportovi.');
    }


    public function store(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'sport' => 'required',
        ]);

        if($validator->fails()){
            return $this->porukaOGresci($validator->errors());
        }

        $sport = Sport::create($input);

        return $this->porukaOUspehu(new SportR($sport), 'Kreiran je novi sport.');
    }


    public function show($ID)
    {
        $sport = Sport::find($ID);

        if (is_null($sport)) {
            return $this->porukaOGresci('Sport sa zadatim id-em ne postoji.');
        }

        return $this->porukaOUspehu(new SportR($sport), 'Sport sa zadatim id-em je prikazan.');
    }


    public function update(Request $request, $ID)
    {
        $sport = Sport::find($ID);
        if (is_null($sport)) {
            return $this->porukaOGresci('Sport sa zadatim id-em ne postoji.');
        }

        $input = $request->all();

        $validator = Validator::make($input, [
            'sport' => 'required',
        ]);

        if($validator->fails()){
            return $this->porukaOGresci($validator->errors());
        }

        $sport->sport = $input['sport'];
        $sport->save();

        return $this->porukaOUspehu(new SportR($sport), 'Podaci o sportu su azurirani.');
    }

    public function destroy($ID)
    {
        $sport = Sport::find($ID);
        
        if (is_null($sport)) {
            return $this->porukaOGresci('Sport sa zadatim id-em ne postoji.');
        }

        $sport->delete();
        return $this->porukaOUspehu([], 'Sport je obrisan.');
    }
}
