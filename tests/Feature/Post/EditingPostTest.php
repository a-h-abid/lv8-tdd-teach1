<?php

namespace Tests\Feature\Post;

use App\Models\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class EditingPostTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /** @test */
    public function itCanLoadTheEditPostForm()
    {
        $post = Post::factory()->create();

        $response = $this->get('/posts/' . $post->id . '/edit');

        $response->assertStatus(200)
            ->assertSeeText('Edit Post')
            ->assertSeeText('Title')
            ->assertSee($post->title)
            ->assertSeeText('Description')
            ->assertSeeText($post->description);
    }

    /** @test */
    public function itCanEditAPostWithValidData()
    {
        $post = Post::factory()->create();

        $data = [
            'title' => $this->faker->jobTitle(),
            'description' => $this->faker->sentence(),
        ];

        $response = $this->put('/posts/' . $post->id, $data);

        $response->assertRedirect();

        $this->assertDatabaseHas('posts', $data);
    }

    /** @test */
    public function itCannotEditAPostWithoutTitle()
    {
        $post = Post::factory()->create();

        $data = [
            'description' => $this->faker->sentence(),
        ];

        $response = $this->put('/posts/' . $post->id, $data);

        $response->assertSessionHasErrors('title');

        $this->assertDatabaseMissing('posts', $data);
    }

    /** @test */
    public function itCannotEditAPostWithoutDescription()
    {
        $post = Post::factory()->create();

        $data = [
            'title' => $this->faker->jobTitle(),
        ];

        $response = $this->put('/posts/' . $post->id, $data);

        $response->assertSessionHasErrors('description');

        $this->assertDatabaseMissing('posts', $data);
    }
}
