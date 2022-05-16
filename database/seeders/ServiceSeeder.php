<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = array(
            array('service_name' => 'Inspection'),
            array('service_name' => 'Oil Change'),
            array('service_name' => 'Tire Rotation'),
            array('service_name' => 'Tune Up'),
            array('service_name' => 'Tire Change'),
            array('service_name' => 'Battery Replacement'),
            array('service_name' => 'Brake Service'),
            array('service_name' => 'Other'),
        );
        DB::table('services')->insert($data);
    }
}
