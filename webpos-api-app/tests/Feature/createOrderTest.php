<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class createOrderTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $productList = [
            [
                "productId" => 1,
                "quantity" => 30
            ],
            [
                "productId" => 2,
                "quantity" => 2
            ]
        ];

        $json = json_encode(["productList" => $productList]);

        $response = $this->post('http://127.0.0.1:8000/api/create-order', [
            'user_id' => 1,
            'product_list' =>  $json
        ]);



        $response->assertStatus(200);
    }
}
