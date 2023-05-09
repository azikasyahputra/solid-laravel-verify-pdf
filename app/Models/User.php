<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use PHPOpenSourceSaver\JWTAuth\Contracts\JWTSubject;
use App\Http\DataTransferObject\StoreUser;

class User extends Authenticatable implements JWTSubject
{
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $keyType = 'int';
    public $incrementing = true;

    protected $fillable = ['name', 'email', 'password'];
    protected $hidden = ['password'];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    public static function store($request)
    {
        $storeUser = Self::Create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>$request->password
        ]);

        return $storeUser;
    }
}
