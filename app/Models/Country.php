<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class Country extends Model
{
    use HasFactory, Notifiable;

    protected $fillable = ['name', 'phone_code'];

    public function guest()
    {
        return $this->hasMany(Guest::class);
    }
}
