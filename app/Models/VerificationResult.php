<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VerificationResult extends Model
{
    protected $table = 'verification_result';
    protected $primaryKey = 'id';
    protected $keyType = 'int';
    public $incrementing = true;

    protected $fillable = ['user_id', 'file_type', 'verification_result'];
    const UPDATED_AT = null;

    public static function store($request)
    {
        $storeUser = Self::Create([
            'user_id'=>$request->user_id,
            'file_type'=>$request->file_type,
            'verification_result'=>$request->verification_result
        ]);

        return $storeUser;
    }

}
