<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medecin extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'name',
        'email',

    ];
    protected $table = 'users';

    public function scopeMedecins($query)
    {
        return $query->where('role', '1');}
        // $usersWithRoleOne = User::where('role', '1')->get();

    //     // // Map the users to the medecins table
    //     // $medecins = $usersWithRoleOne->map(function ($user) {
    //     //     return Medecin::create([
    //     //         'name' => $user->name,
    //     //         'email' => $user->email,

    //     //         // Add other necessary colummakens from the users table
    //     //     ]);
    //     // });

    //     // return $medecins;
    // }

    // Relation avec les créneaux horaires
    public function timeSlots()
    {
        return $this->hasMany(TimeSlot::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
