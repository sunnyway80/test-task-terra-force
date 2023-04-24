<?php

namespace Tests\Feature;

use App\Entity\PaginateLimits;
use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;
use Tests\TestCase;

class PostTest extends TestCase
{
    use WithFaker;

    protected User $user;

    public function setUp(): void
    {
        parent::setUp();

        Post::factory(10)->create();

        $this->user = User::factory()->create();
    }

    /**
     * A basic test example.
     * @test
     */
    public function paginate(): void
    {
        $response = $this->actingAs($this->user)
            ->get(route('posts.index'));

        $response->assertStatus(ResponseAlias::HTTP_OK)
            ->assertJson($response->json())
            ->assertJsonCount(PaginateLimits::ADMIN, 'data');
    }

    /**
     * A basic test example.
     * @test
     */
    public function show(): void
    {
        $post     = Post::firstOrFail();
        $response = $this->actingAs($this->user)
            ->getJson(route('posts.show', $post->slug));

        $response->assertStatus(ResponseAlias::HTTP_OK)
            ->assertJson($response->json());
    }

    /**
     * A basic test example.
     * @test
     */
    public function create(): void
    {
        $response = $this->actingAs($this->user)
            ->postJson(route('posts.store'), [
                'title' => $this->faker->sentence,
                'description' => $this->faker->text,
                'content' => $this->faker->text,
            ]);

        $response->assertStatus(ResponseAlias::HTTP_CREATED)
            ->assertJson($response->json());

        $this->assertDatabaseHas(Post::class, [
            'id'         => $response->json('data.id'),
        ]);
    }

    /**
     * A basic test example.
     * @test
     */
    public function update(): void
    {
        $post = Post::firstOrFail();

        $response = $this->actingAs($this->user)
            ->putJson(route('posts.update', $post->id), [
                'title' => $this->faker->sentence,
                'description' => $this->faker->text,
                'content' => $this->faker->text,
            ]);

        $response->assertStatus(ResponseAlias::HTTP_OK)
            ->assertJson($response->json());
    }

    /**
     * A basic test example.
     * @test
     */
    public function destroy(): void
    {
        $post = Post::firstOrFail();

        $response = $this->actingAs($this->user)
            ->deleteJson(route('posts.destroy', $post->id));

        $response->assertStatus(ResponseAlias::HTTP_OK);

        $this->assertDatabaseMissing(Post::class, [
            'id'         => $response->json('id'),
        ]);
    }
}
