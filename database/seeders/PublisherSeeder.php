<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class PublisherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('publisher')->insert([
            'publisher_name' => 'Viktor E. Frankl',
            'phone_number' => '+47 699-2934-212',
            'address' => 'Jl. Raya Jagakarsa No.40',
            'city' => 'Jakarta Selatan',
            'state' => 'Ciganjur',
            'zip' => '12620',
            'created_at' =>  \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
        ]);

        DB::table('publisher')->insert([
            'publisher_name' => 'Noura Publishing',
            'phone_number' => '(021) 78880556',
            'address' => 'Gedung Kompas-Gramedia Lantai 2, Jl. Palmerah Barat No. 29 - 32, Gelora, Tanah Abang.',
            'city' => ' Jakarta',
            'state' => 'Tanah abang',
            'zip' => '10270',
            'created_at' =>  \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
        ]);
    }
}
