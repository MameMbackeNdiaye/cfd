<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = array('nom');
    use HasFactory;


    public function users(){
        return $this->belongsToMany(User::class);
    }
}
