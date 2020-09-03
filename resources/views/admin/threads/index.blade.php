@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row d-flex align-items-center">
                        <div class="col-sm-6">
                            <h5 class="card-title"><!-- insert title here --></h5>
                        </div>
                        <div class="col-sm-6 text-right">
                            <a href="{{ route('admin.threads.create') }}" class="btn btn-primary btn-sm">
                                @lang('crud.create_button')
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    @foreach($channels as $channel)
                        <h1>{{ $channel->name }}</h1>
                        @foreach($channel->threads as $thread)
                        <article>
                            <h4>
                                <a href="{{ route('admin.thread.show', [$thread->channel->slug, $thread]) }}">
                                    {{ $thread->topic }}
                                </a>
                            </h4>
                            <div class="body">
                                {{ $thread->body }}
                            </div>
                            <hr>
                        </article>
                        @endforeach
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@stop
