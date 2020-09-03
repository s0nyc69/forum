<?php

namespace App\Contracts;

use App\Thread;
use Flobbos\Crudable\Contracts\Crud;
use Illuminate\Http\Request;

interface ThreadContract extends Crud{
    public function addPost(Request $request);
}

