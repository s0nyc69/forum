<?php

namespace App\Services;

use App\Post;
use App\Contracts\PostContract;
use Flobbos\Crudable;

class PostService implements PostContract {
    
    use Crudable\Crudable;
    
    public function __construct(Post $post) {
        $this->model = $post;
    }
    
}