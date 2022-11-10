<?php

namespace Tests\Feature\Http\Controllers;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Author;
use App\Models\User;

class AuthorControllerTest extends TestCase
{
    /**
     * A function test for create new author.
     *
     * @return void
     */
    public function test_create_new_author()
    {
        $user = \App\Models\User::factory(User::class)->create();
        $response = $this->actingAs($user, 'api')
            ->json('post', '/api/author/create', [
                'author_name' => 'Osamu Dazai',
                'phone' => '2022-10-20',
                'city' => 'Kanagawa',
                'address' => 'buried by author on earth',
                'state' => 'Nagasaki', 
            ]);
    
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'code',
            'message'
        ]);
    }

    /**
     * A function test for update existing author.
     *
     * @return void
     */
    public function test_update_new_author()
    {
        $user = \App\Models\User::factory(User::class)->create();
        $response = $this->actingAs($user, 'api')
            ->json('put', '/api/author/update?id=2', [
                'author_name' => 'Fujiko Fujio',
                'phone' => '2022-10-20',
                'city' => 'Kanagawa',
                'address' => 'buried by author on earth',
                'state' => 'Nagasaki', 
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
            ->json('post', '/api/author/create', [
                'author_name' => '',
                'phone' => '',
                'city' => 'Kanagawa',
                'address' => '',
                'state' => 'Nagasaki', 
            ]);
    
        $response->assertStatus(422);
        $response->assertJsonStructure([
            'message',
            'errors' => [
                'author_name',
                'phone',
                'address'
            ]
        ]);
    }

    /**
     * A function test to get detail of author.
     *
     * @return void
     */
    public function test_get_detail()
    {
        $user = \App\Models\User::factory(User::class)->create();
        $response = $this->actingAs($user, 'api')
            ->json('get', '/api/author/detail?id=2');
    
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'code',
            'data' => [
                0 => [
                    'id',
                    'author_name',
                    'phone',
                    'address',
                    'city',
                    'state',
                    'created_at',
                    'updated_at',
                    'book'
                ],
            ],
        ]);
    }

    /**
     * A function test to get detail of author.
     *
     * @return void
     */
    public function test_get_detail_if_fails()
    {
        $user = \App\Models\User::factory(User::class)->create();
        $response = $this->actingAs($user, 'api')
            ->json('get', '/api/author/detail?id=100');
    
        $response->assertStatus(404);
        $response->assertJsonStructure([
            'code',
            'message',
        ]);
    }
}
