<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class ProvidersResource extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $empresa = \App\Providers::findOrFail($this->user_id);

        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email, 
            'payment_monthly' => $this->payment_monthly,
            'active' => $this->active,
            'empresa' => $empresa->name
        ];
    }
}
