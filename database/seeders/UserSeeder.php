<?php

namespace Database\Seeders;

use App\Models\User;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');
 
    	for($i = 1; $i <= 1; $i++){
 
    	      // insert data ke table pegawai menggunakan Faker
    		$user = User::create([
    			'username' => $faker->name,
    			'nip' => $faker->numberBetween(10000,15000),
    			'password' => Hash::make('123456')
    		]);
            $user->assignRole('atasan');
    	}
    }
    
}
