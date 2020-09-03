@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">

                <form action="{{ route('admin.threads.store') }}" role="form" method="POST"  enctype="multipart/form-data">
                    {{ csrf_field() }}

                    <div class="card-header">
                        <h5 class="card-title"><!-- insert title here --></h5>
                        @lang('crud.create_headline')
                    </div>

                    <div class="card-body">

                        @include('crudable::notifications')
                        <input type="hidden" name="user_id" value="{{ auth()->id() }}">
                        <div class="form-group">
                            <label for="channel_id" class="control-label">Select Channel</label>
                            <select name="channel_id" id="channel_id" class="form-control">
                                @foreach($channels as $channel)
                                    <option
                                        value="{{ $channel->id }}"
                                        @if(old('channel_id') == $channel->id) selected @endif>
                                        {{ $channel->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="topic">Topic</label>
                            <input class="form-control" type="text" id="topic" name="topic">
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="topic">Content</label>
                            <textarea class="form-control" id="topic" rows="8" name="body">

                            </textarea>
                        </div>

                    </div>

                    <div class="card-footer">

                        <div class="row">

                            <div class="col-sm-6">
                                <a href="{{ route('admin.threads.index') }}" class="btn btn-danger">{{ trans('crud.cancel') }}</a>
                            </div>

                            <div class="col-sm-6 text-right">
                                <button type="submit" class="btn btn-success">{{ trans('crud.save') }}</button>
                            </div>

                        </div>

                    </div>

                </form>

            </div>
        </div>

    </div>
</div>
@stop
