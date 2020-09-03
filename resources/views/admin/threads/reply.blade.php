<div class="row pt-2 pb-2">
    <div class="col-sm-12 col-md-12">
        <div class="card">
            <div class="card-header">
                <a href="#">
                    {{ $post->user->name }}
                </a> wrote {{ $post->created_at->diffForHumans() }}
            </div>
            <div class="card-body">
                {{ $post->body }}
            </div>
        </div>

    </div>
</div>
