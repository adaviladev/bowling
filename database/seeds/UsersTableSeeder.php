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
    public function run()
    {
        factory(User::class, 50)->create();

        User::where('id', 1)->update([
            'first_name' => 'Adrian',
            'last_name' => 'Davila',
            'email' => 'adavila@bowling.test'
        ]);
    }
}
