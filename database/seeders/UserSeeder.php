<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        /**
         * Create a dummy user for doctor and manually setup a token this user can
         * always use to authenticate
         */
        $user = User::create([
            'name'     => 'Tobi',
            'email'    => 'tobexkee@gmail.com',
            'password' => Hash::make('password'),
        ]);

        $user->tokens()->create([
            'name'      => 'auth',
            'token'     => hash('sha256', $this->token()),
            'abilities' => ['*'],
        ]);

        /**
         * Create a new entry for the patient
         */
        User::create([
            'name'     => 'Tobi',
            'email'    => 'user@gmail.com',
            'password' => Hash::make('password'),
        ]);
    }

    public function token(): string
    {
        return base64_encode('User Access Token');
    }
}
