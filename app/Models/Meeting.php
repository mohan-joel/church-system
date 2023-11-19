<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meeting extends Model
{
    use HasFactory;
    protected $fillable = [
            'date',
            'description'
    ];

    public function agendas()
    {
         return $this->hasMany(Agenda::class);
    }

    public function decisions()
    {
        return $this->hasMany(Decision::class);
    }

    public function attendees()
    {
        return $this->hasMany(Attendee::class);
    }
}
