<?php

namespace Tests\Feature;

use App\Models\Kategori;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic test example.
     */
    public function test_the_application_returns_a_successful_response(): void
    {
        Kategori::forceCreate([
            'nama_kategori' => 'Universitas',
            'slug' => 'universitas',
            'urutan' => 1,
        ]);

        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
