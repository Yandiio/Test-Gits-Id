<?php

namespace Tests\Feature\Http\Controllers;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Book;
use App\Models\User;

class BookControllerTest extends TestCase
{
    /**
     * A function test for create new book.
     *
     * @return void
     */
    public function test_create_new_book()
    {
        $user = \App\Models\User::factory(User::class)->create();
        $response = $this->actingAs($user, 'api')
            ->json('post', '/api/book/create', [
                'book_name' => 'The Last Day on Mars',
                'date_release' => '2022-10-20',
                'author_id' => 2,
                'description' => 'buried by book',
                'number_of_page' => 260, 
                'publisher_id' => 2
            ]);
    
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'code',
            'message'
        ]);
    }

    /**
     * A function test for update existing book.
     *
     * @return void
     */
    public function test_update_new_book()
    {
        $user = \App\Models\User::factory(User::class)->create();
        $response = $this->actingAs($user, 'api')
            ->json('put', '/api/book/update?id=2', [
                'book_name' => 'The Last Day on s',
                'date_release' => '2022-10-20',
                'author_id' => 2,
                'description' => 'buried by book on earth',
                'number_of_page' => 260, 
                'publisher_id' => 2
            ]);
    
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'code',
            'message'
        ]);
    }

    /**
     * A function test to validate the transaction.
     *
     * @return void
     */
    public function test_validation()
    {
        $user = \App\Models\User::factory(User::class)->create();
        $response = $this->actingAs($user, 'api')
            ->json('post', '/api/book/create', [
                'book_name' => 'Key Value to Success',
                'date_release' => '',
                'author_id' => 2,
                'description' => '',
                'number_of_page' => 260, 
                'publisher_id' => 2
            ]);
    
        $response->assertStatus(422);
        $response->assertJsonStructure([
            'message',
            'errors' => [
                'date_release',
                'description'
            ]
        ]);
    }

    /**
     * A function test to get detail of book.
     *
     * @return void
     */
    public function test_get_detail()
    {
        $user = \App\Models\User::factory(User::class)->create();
        $response = $this->actingAs($user, 'api')
            ->json('get', '/api/book/detail?id=1');
    
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'code',
            'data' => [
                0 => [
                    'id',
                    'book_name',
                    'date_release',
                    'description',
                    'number_of_page',
                    'created_at',
                    'updated_at',
                    'author'
                ],
            ],
        ]);
    }

    /**
     * A function test to get detail of book.
     *
     * @return void
     */
    public function test_get_detail_if_fails()
    {
        $user = \App\Models\User::factory(User::class)->create();
        $response = $this->actingAs($user, 'api')
            ->json('get', '/api/book/detail?id=100');
    
        $response->assertStatus(404);
        $response->assertJsonStructure([
            'code',
            'message',
        ]);
    }
}
