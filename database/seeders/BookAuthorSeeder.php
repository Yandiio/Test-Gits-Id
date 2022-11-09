<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class BookAuthorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('author_book')->insert([
            'author_id' => 1,
            'book_id' => 1
        ]);

        DB::table('author_book')->insert([
            'author_id' => 1,
            'book_id' => 2
        ]);

        DB::table('author_book')->insert([
            'author_id' => 2,
            'book_id' => 3
        ]);
    }
}
