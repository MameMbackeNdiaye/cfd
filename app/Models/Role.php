<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;
    protected $fillable = array('nom');
    
    protected $casts =[
        'created_at' => 'datetime:d-M-Y'
    ];


    public function users(){
        return $this->belongsToMany(User::class);
    }
}
