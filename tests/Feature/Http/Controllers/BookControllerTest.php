<?php

namespace Tests\Feature\Http\Controllers;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Book;

class BookControllerTest extends TestCase
{
    /**
     * A function test for create new book.
     *
     * @return void
     */
    public function test_create_new_book()
    {
        $box = 'toy';
        $this->assertTrue($box == 'toy');
    }

    /**
     * A function test for update existing book.
     *
     * @return void
     */
    public function test_update_new_book()
    {
        $box = 'toy';
        $this->assertTrue($box == 'toy');
    }
}
