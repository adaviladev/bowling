<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        factory(User::class, 20)->create();

        User::where('id', 1)->update([
            'first_name' => 'Adrian',
            'last_name' => 'Davila',
            'email' => 'adavila@bowling.test'
        ]);
    }
}
