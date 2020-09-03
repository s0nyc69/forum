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
                            <a href="{{ route('admin.posts.create') }}" class="btn btn-primary btn-sm">
                                @lang('crud.create_button')
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    @include('crudable::notifications')
                    @if($posts->isEmpty())
                    @lang('crud.no_entries')
                    @else
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>id</th>
                                <th>body</th>
                                <th>user</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($posts as $post)
                            <tr>
                                <td>{{ $post->id }}</td>
                                <td>{{ $post->body }}</td>
                                <td>{{ $post->user->name }}</td>
                                <td class="text-right">
                                    <div class="btn-group" role="group">
                                        <a class="btn btn-sm btn-primary" href="{{ route('admin.posts.edit',$post->id) }}">
                                            <i class="glyphicon glyphicon-pencil"></i> @lang('crud.edit')
                                        </a>
                                        <form class="btn-group"
                                            action="{{ route('admin.posts.destroy',$post->id) }}"
                                            method="POST">
                                            {{ csrf_field() }}
                                            {{ method_field('DELETE') }}
                                            <button class="btn btn-sm btn-danger"
                                                    type="submit"><i class="glyphicon glyphicon-trash"></i> @lang('crud.delete')</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@stop
