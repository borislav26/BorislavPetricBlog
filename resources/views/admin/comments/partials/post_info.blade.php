<p class = "text-danger">ID:{{ $comment->post->id}}</p>
<p>Title: {{ $comment->post->title}}</p>
<p>URL: <a href = "{{ $comment->post->getFrontUrl()}}"> Click here to see post</a></p>