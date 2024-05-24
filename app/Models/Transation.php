<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transation extends Model
{
    use HasFactory;
     public function adminName(){
        return $this->belongsTo(Admin::class,'admin_id');
    }
}
