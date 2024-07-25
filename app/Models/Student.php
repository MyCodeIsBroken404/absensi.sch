<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function presences(){
        return $this->hasMany(Presence::class);
    }

    public function grade(){
        return $this->belongsTo(Grade::class);
    }

    
}
