<div class="container">
    <div class="card p-5 shadow p-3">
        <h3>10 Ultimos posts</h3>
        @foreach ($lastPosts as $posts)
            <a href="{{ route('show', $posts->id) }}" class="linkLastPosts"><div class="row">
                <div class="col-3">
                    <img src="{{ asset("images/$posts->image_path") }}" alt="{{ $posts->title }}" class="imagesPost mt-3" />
                </div>
                <div class="col-9 mt-2">
                    <h6>{{ $posts->title }}</h6>
                </div>
            </div></a>
            <hr>
        @endforeach
    </div>
</div>
