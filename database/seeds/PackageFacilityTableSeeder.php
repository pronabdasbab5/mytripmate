<?php

use Illuminate\Database\Seeder;

class PackageFacilityTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('package_facility')->insert([
		    ['facility' => 'Hotel', 'images' => '4534578.png', 'created_at' => now(), 'updated_at' => now()],
		    ['facility' => 'Transfer', 'images' => '7865348.png', 'created_at' => now(), 'updated_at' => now()]
		]);
    }
}
