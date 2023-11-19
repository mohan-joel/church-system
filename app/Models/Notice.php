<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notice extends Model
{
    use HasFactory;
    protected $fillable = [
        'fellowship',
        'vanue',
        'date',
        'lead_id',
        'sermon_id'
    ];

    public function lead()
    {
        return $this->belongsTo(Youth::class,'lead_id','id');
    }
    
    public function sermon()
    {
        return $this->belongsTo(Youth::class,'sermon_id','id');
    }
}
