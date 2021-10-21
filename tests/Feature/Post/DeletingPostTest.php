<?php

namespace Tests\Feature\Post;

use App\Models\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DeletingPostTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /** @test */
    public function aPostCanBeDeleted()
    {
        $posts = Post::factory()->times(3)->create();

        $response = $this->delete('/posts/' . $posts->first()->id);

        $response->assertRedirect();

        $this->assertDatabaseCount('posts', 2);
    }
}
