<?php

namespace Tests\Feature\Post;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CreatingPostTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /** @test */
    public function itCanLoadTheCreatePostForm()
    {
        $response = $this->get('/posts/create');

        $response->assertStatus(200)
            ->assertSeeText('Create Post')
            ->assertSeeText('Title')
            ->assertSeeText('Description');
    }

    /** @test */
    public function itCanCreateAPostWithValidData()
    {
        $data = [
            'title' => $this->faker->jobTitle(),
            'description' => $this->faker->sentence(),
        ];

        $response = $this->post('/posts', $data);

        $response->assertRedirect();

        $this->assertDatabaseHas('posts', $data);
    }

    /** @test */
    public function itCannotCreateAPostWithoutTitle()
    {
        $data = [
            'description' => $this->faker->sentence(),
        ];

        $response = $this->post('/posts', $data);

        $response->assertSessionHasErrors('title');

        $this->assertDatabaseMissing('posts', $data);
    }

    /** @test */
    public function itCannotCreateAPostWithoutDescription()
    {
        $data = [
            'title' => $this->faker->jobTitle(),
        ];

        $response = $this->post('/posts', $data);

        $response->assertSessionHasErrors('description');

        $this->assertDatabaseMissing('posts', $data);
    }
}
