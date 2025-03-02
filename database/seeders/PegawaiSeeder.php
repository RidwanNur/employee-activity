<?php

namespace Database\Seeders;

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PegawaiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');
 
    	for($i = 1; $i <= 5; $i++){
 
    	      // insert data ke table pegawai menggunakan Faker
    		$user = DB::table('employees')->insert([
    			'name' => $faker->name,
    			'nip' => $faker->numberBetween(10000,15000),
    			'position' => $faker->jobTitle,
    			'address' => $faker->city(),
    			'created_at' => $faker->dateTime()
    		]);
            // $user->assignRole('admin');
    	}
    }
}
