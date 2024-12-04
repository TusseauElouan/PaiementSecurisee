<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Silber\Bouncer\BouncerFacade as Bouncer;

class RoleAndUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Bouncer::create(['name' => 'admin', 'title'=> 'Administrateur']);
        Bouncer::create(['name'=> 'user', 'title'=> 'Utilisateur']);


        $admin = User::firstOrCreate([
            'email' => 'admin@example.com',
        ], [
            'name' => 'Admin User',
            'password' => bcrypt('password'),
        ]);

        Bouncer::assign('admin')->to($admin);

        // Créer un utilisateur classique
        $user = User::firstOrCreate([
            'email' => 'user@example.com',
        ], [
            'name' => 'Normal User',
            'password' => bcrypt('password'),
        ]);

        Bouncer::assign('user')->to($user);
    }
}
