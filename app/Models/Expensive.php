<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Expensive extends Model
{
    use HasFactory, Notifiable;
    
    protected $fillable = [
        'description',
        'category',
        'type',
        'date',
        'value',
        'paid',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
