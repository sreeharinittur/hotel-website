<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable=[
        'room_id',
        'name',
        'email',
        'phone',
        'start_date',
        'end_date'

    ];

    public function room()
    {
        return $this->hasOne(Room::class, 'room_id', 'id');
    }
}
