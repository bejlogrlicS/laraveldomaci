<?php

namespace App\Http\Resources;

use App\Models\Tim;
use App\Models\Sport;
use Illuminate\Http\Resources\Json\JsonResource;

class MecR extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $sport = Sport::find($this->sportID);
        $prviTim = Tim::find($this->prviTimID);
        $drugiTim = Tim::find($this->drugiTimID);

        return [
            'id' => $this->id,
            'prviTim' => $prviTim->tim,
            'drugiTim' => $drugiTim->tim,
            'rezultat' => $this->rezultat,
            'sportID' => $sport->sport
        ];
    }
}
