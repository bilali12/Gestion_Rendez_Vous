<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TimeSlots extends Model
{
    use HasFactory;
    protected $table = 'time_slots';

    protected $fillable = ['user_id', 'date', 'start_time', 'end_time'];
    // Relation avec le médecin
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
