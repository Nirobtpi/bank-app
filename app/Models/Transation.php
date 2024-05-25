<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transation extends Model
{
    use HasFactory;

    protected $guarded=[];
     public function adminName(){
        return $this->belongsTo(User::class,'user_id');
    }
}
