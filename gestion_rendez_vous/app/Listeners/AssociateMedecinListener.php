<?php



namespace App\Listeners;

use App\Models\Medecin;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class AssociateMedecinListener implements ShouldQueue
{
    use InteractsWithQueue;

    public function handle($event)
    {
        $user = $event->user;

        if ($user->role == '1') {
            Medecin::create([
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'password' => $user->password,
                // Add other necessary columns from the users table
            ]);
        }
    }
}
