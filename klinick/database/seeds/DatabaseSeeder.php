<?php

use Illuminate\Database\Seeder;
use App\Entities\User;

class DatabaseSeeder extends Seeder
{
    /***
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        User::create([
            'name' => 'souza2',
            'username' => 'souza2',
            'password' => env('PASSWORD_HASH') ? bcrypt('123456') : '123456',
            'email' => 'souza2@gmail.com',
            'sexo' => 'M',
            'phone' => '123456789',
            'dataNasc' => '2001-01-01',
        ]);

    }
}
