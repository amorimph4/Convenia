<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Tymon\JWTAuth\Contracts\JWTSubject as JWTSubejectContract;

class User extends Authenticatable implements JWTSubejectContract
{
    use Notifiable;
    use SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'phone','address','cep','cnpj','email','password' 
    ];

    protected $dates = ['deleted_at'];
    
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function getJWTIdentifier(){
        return $this->id;
    }

    
    public function getJWTCustomClaims(){
        return [
            'email' => $this->email,
            'name' => $this->name
        ];
    }
}
