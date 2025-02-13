<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $fillable =['name'];

    public function users(){
        return $this->hasMany(User::class);
    }
}
