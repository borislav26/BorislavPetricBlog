<p class = "text-danger">ID:{{ $comment->post->id}}</p>
<p>Title: {{ $comment->post->title}}</p>
<p>URL: <a href = "{{ route('front.posts.single',['post'=>$comment->post->id])}}"> Click here to see post</a></p>