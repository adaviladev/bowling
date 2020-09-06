<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        factory(User::class, 20)->create();

        User::where('id', 1)->update([
            'first_name' => config('develop.first_name'),
            'last_name' => config('develop.last_name'),
            'email' => config('develop.email'),
        ]);
    }
}
