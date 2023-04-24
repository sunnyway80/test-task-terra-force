<?php

namespace App\Http\Controllers;

use App\Entity\PaginateLimits;
use App\Http\Requests\PostRequest;
use App\Http\Resources\PostResource;
use App\Models\Post;
use App\Repositories\Interfaces\PostRepositoryInterface;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Response;

/**
 * @group Post
 */
class PostController extends Controller
{
    /**
     * @var PostRepositoryInterface
     */
    private PostRepositoryInterface $repository;

    /**
     * @param PostRepositoryInterface $repository
     */
    public function __construct(PostRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): AnonymousResourceCollection
    {
        return PostResource::collection($this->repository->paginate(PaginateLimits::ADMIN));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $slug): JsonResource
    {
        return PostResource::make($this->repository->showBySlug($slug));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create(): Response
    {
        /*
         * @todo
         */
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PostRequest $request): JsonResource
    {
        return PostResource::make(
            $this->repository->create(
                $request->only([
                    'title',
                    'description',
                    'content',
                ])
            )
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param string $id
     *
     * @return Response
     */
    public function edit(string $id): Response
    {
        /*
         * @todo
         */
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PostRequest $request, Post $post): JsonResource
    {
        return PostResource::make(
            $this->repository->update(
                $post,
                $request->only([
                    'title',
                    'description',
                    'content',
                ])
            )
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post): ?bool
    {
        return $this->repository->delete($post);
    }
}
