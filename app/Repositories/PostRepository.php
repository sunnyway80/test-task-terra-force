<?php

namespace App\Repositories;

    use App\Models\Post;
    use App\Repositories\Interfaces\PostRepositoryInterface;

    /**
     * Class PostRepository.
     */
    class PostRepository extends BaseRepository implements PostRepositoryInterface
    {
        /**
         * @param Post $post
         */
        public function __construct(Post $post)
        {
            parent::__construct($post);
        }
    }
