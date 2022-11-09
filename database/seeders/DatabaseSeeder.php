<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;
use Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            BookSeeder::class,
            AuthorSeeder::class,
            PublisherSeeder::class,
            BookAuthorSeeder::class
        ]);
    }
}
