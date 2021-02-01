<?php

use Illuminate\Database\Seeder;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'email_verified_at' => \Carbon\Carbon::now(),
            'password' => Hash::make('password'),
            'phone' => '0888 888 888',
            'role' => 0
        ]);
    }
}
