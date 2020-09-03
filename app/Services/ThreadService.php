<?php

namespace App\Services;

use App\Thread;
use App\Contracts\ThreadContract;
use Flobbos\Crudable;
use Illuminate\Http\Request;

class ThreadService implements ThreadContract {

    use Crudable\Crudable;

    public function __construct(Thread $thread) {
        $this->model = $thread;
    }

    public function addPost(Request $request)
    {
        if ($request->has('thread_id')) {
            $this->model->find($request->get('thread_id'))->posts()->create($request->all());
        }
    }
}
