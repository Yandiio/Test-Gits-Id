<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;
use Str;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('book')->insert([
            'book_name' => 'Man Search for Meaning',
            'date_release' => '2022',
            'description' => 'Man search for meaning',
            'number_of_page' => 200,
            'author_id' => 1,
            'publisher_id' => 1,
            'created_at' =>  \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
        ]);

        DB::table('book')->insert([
            'book_name' => 'Yes to Life',
            'date_release' => '2022-10-20',
            'description' => 'Say yes to life',
            'number_of_page' => 256,
            'author_id' => 1,
            'publisher_id' => 1,
            'created_at' =>  \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
        ]);

        DB::table('book')->insert([
            'book_name' => 'Doraemon',
            'date_release' => '2022-10-21',
            'description' => 'Buku Komik Doraemon',
            'number_of_page' => 110,
            'author_id' => 2,
            'publisher_id' => 2,
            'created_at' =>  \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
        ]);
    }
}
