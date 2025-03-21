<?php

namespace Tests\Feature;

use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use PHPUnit\Framework\Attributes\Test;

class PostTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function it_creates_a_post()
    {
        $response = $this->post('/posts', [
            'title' => 'My First Post',
            'description' => 'This is the content of my first post.',
        ]);

        $response->assertStatus(201);
        $this->assertDatabaseHas('posts', [
            'title' => 'My First Post',
            'description' => 'This is the content of my first post.',
        ]);
    }

    #[Test]
    public function it_reads_a_post()
    {
        $post = Post::factory()->create([
            'title' => 'My Post',
            'description' => 'Content of the post.',
        ]);

        $response = $this->get("/posts/{$post->id}");

        $response->assertStatus(200);
        $response->assertJson([
            'title' => 'My Post',
            'description' => 'Content of the post.',
        ]);
    }

    #[Test]
    public function it_updates_a_post()
    {
        $post = Post::factory()->create([
            'title' => 'Old Title',
            'description' => 'Old Content',
        ]);

        $response = $this->put("/posts/{$post->id}", [
            'title' => 'Updated Title',
            'description' => 'Updated Content',
        ]);

        $response->assertStatus(200);
        $this->assertDatabaseHas('posts', [
            'title' => 'Updated Title',
            'description' => 'Updated Content',
        ]);
    }

    /** #[Test] */
    public function it_deletes_a_post()
    {
        $post = Post::factory()->create([
            'title' => 'Post to delete',
            'description' => 'This post will be deleted.',
        ]);

        $response = $this->delete("/posts/{$post->id}");

        $response->assertStatus(200);
        $this->assertDeleted($post);
    }
}