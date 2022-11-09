<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class AuthorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('author')->insert([
            'author_name' => 'Viktor E. Frankl',
            'phone' => '+47 699-2934-212',
            'address' => 'Leopolstadt 48 St.Lauren',
            'city' => 'Vienna',
            'state' => 'Austria',
            'created_at' =>  \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
        ]);

        DB::table('author')->insert([
            'author_name' => 'Fujiko F. Fujio',
            'phone' => '+81 0293-2334-2',
            'address' => 'Leopolstadt 48 St.Lauren',
            'city' => ' Takaoka',
            'state' => 'Toyama',
            'created_at' =>  \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
        ]);
    }
}
