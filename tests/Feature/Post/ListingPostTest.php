<?php

namespace Tests\Feature\Post;

use App\Models\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ListingPostTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function itCanListAllPosts()
    {
        $posts = Post::factory()->times(3)->create();

        $response = $this->get('/posts');

        $response->assertStatus(200);

        foreach ($posts as $post) {
            $response->assertSeeText($post->title);
            $response->assertSeeText($post->description);
        }

        $response->assertSeeText('Total: 3');
    }

    /** @test */
    public function itCanListPostsInPagination()
    {
        $posts = Post::factory()->times(5)->create();

        $response = $this->get('/posts?per_page=3');

        $response->assertStatus(200);

        foreach ($posts->take(3) as $post) {
            $response->assertSeeText($post->title);
            $response->assertSeeText($post->description);
        }

        $response->assertSeeText('Total: 5');
        $response->assertSeeText('Showing: 3');

        $response = $this->get('/posts?per_page=3&page=2');

        $response->assertStatus(200);

        foreach ($posts->splice(3) as $post) {
            $response->assertSeeText($post->title);
            $response->assertSeeText($post->description);
        }

        $response->assertSeeText('Total: 5');
        $response->assertSeeText('Showing: 2');
    }
}
