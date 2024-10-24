<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Guest extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'phone_code'];

    public function guest()
    {
        return $this->hasMany(Guest::class);
    }
}
