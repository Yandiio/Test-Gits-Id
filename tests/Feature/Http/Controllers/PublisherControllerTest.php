<?php

namespace Tests\Feature\Http\Controllers;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Publisher;

class PublisherControllerTest extends TestCase
{
    /**
     * A function test for create new publisher.
     *
     * @return void
     */
    public function test_create_new_publisher()
    {
        $user = \App\Models\User::factory(User::class)->create();
        $response = $this->actingAs($user, 'api')
            ->json('post', '/api/publisher/create', [
                'publisher_name' => 'PT. Gramedia Pustaka Utama',
                'phone_number' => '(022) 5405765',
                'city' => 'Bandung',
                'address' => 'Jl. Caringin No.254',
                'state' => 'Kopo',
                'zip' => '40222'
            ]);
    
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'code',
            'message'
        ]);
    }

    /**
     * A function test for update existing publisher.
     *
     * @return void
     */
    public function test_update_new_publisher()
    {
        $user = \App\Models\User::factory(User::class)->create();
        $response = $this->actingAs($user, 'api')
            ->json('put', '/api/publisher/update?id=2', [
                'publisher_name' => 'PT. Gramedia Pustaka',
                'phone_number' => '(022) 5405765',
                'city' => 'Bandung',
                'address' => 'Jl. Caringin No.254',
                'state' => 'Kedai',
                'zip' => '40222'
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
            ->json('post', '/api/publisher/create', [
                'publisher_name' => '',
                'phone_number' => '',
                'city' => 'Kanagawa',
                'address' => '',
                'state' => 'Nagasaki', 
                'zip' => '40299'
            ]);
    
        $response->assertStatus(422);
        $response->assertJsonStructure([
            'message',
            'errors' => [
                'publisher_name',
                'phone_number',
                'address',
            ]
        ]);
    }

    /**
     * A function test to get detail of publisher.
     *
     * @return void
     */
    public function test_get_detail()
    {
        $user = \App\Models\User::factory(User::class)->create();
        $response = $this->actingAs($user, 'api')
            ->json('get', '/api/publisher/detail?id=2');
    
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'code',
            'data' => [
                0 => [
                    'id',
                    'publisher_name',
                    'phone_number',
                    'address',
                    'city',
                    'state',
                    'created_at',
                    'updated_at',
                    'zip',
                ],
            ],
        ]);
    }

    /**
     * A function test to get detail of publisher.
     *
     * @return void
     */
    public function test_get_detail_if_fails()
    {
        $user = \App\Models\User::factory(User::class)->create();
        $response = $this->actingAs($user, 'api')
            ->json('get', '/api/publisher/detail?id=100');
    
        $response->assertStatus(404);
        $response->assertJsonStructure([
            'code',
            'message',
        ]);
    }
}
