<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;

class CategoryTest extends TestCase
{

    use WithFaker;
    public function setUp(): void
    {
        parent::setUp();
    }

    public function test_create() : void
    {
        $requestData = [
            'name' => 'Education'
        ];

        $response = $this->postJson( '/api/categories', $requestData );
        $response->assertStatus( 201 )
            ->assertJson( [
                'data' => 'Created successfully',
                'statusCode' => 201
            ] );

        $this->assertDatabaseHas( 'categories', [
            'name' => 'Education'
        ] );

        $response = $this->postJson( '/api/categories', $requestData );
        $response->assertStatus( 500 )
            ->assertJson( [
                'error'      => 'Category already exists with the same name',
                'statusCode' => 500
            ] );
    }
}
