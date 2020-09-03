@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <p>{{ $thread->user->name }} wrote {{ $thread->created_at->diffForHumans() }}:</p>
                    <h5 class="card-title">{{ $thread->topic }}</h5>
                </div>
                @include('crudable::notifications')

                <div class="card-body">
                    {!! $thread->body !!}
                </div>
            </div>
            @foreach($thread->posts as $post)
                @include('admin.threads.reply')
            @endforeach
            @auth()
            <div class="card">
                <form action="{{ route('admin.posts.store') }}" role="form" method="POST"  enctype="multipart/form-data">
                    <div class="card-body">
                            {{ csrf_field() }}
                            <input type="hidden" name="user_id" value="{{ auth()->id() }}">
                            <input type="hidden" name="thread_id" value="{{ $thread->id }}">
                            <textarea name="body" id="body" rows="10"></textarea>
                    </div>
                    <div class="card-footer">
                        <button class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
            @endauth
        </div>

    </div>
</div>
@stop
