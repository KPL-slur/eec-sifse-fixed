<?php
namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Admin Admin',
            'email' => 'admin@eecid.com',
            'is_admin' => '1',
            'email_verified_at' => now(),
            'password' => Hash::make('secret'),
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('users')->insert([
            'name' => 'Eko Eko',
            'email' => 'eko@eecid.com',
            'is_admin' => '0',
            'email_verified_at' => now(),
            'password' => Hash::make('12345'),
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
