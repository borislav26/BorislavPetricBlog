<table class="table table-striped table-bordered first">
    <col width="5%">
    <col width="15%">
    <col width="15%">
    <col width="15%">
    <col width="40%">
    <col width="10%">
    <thead>
        <tr>
            <th>#</th>
            <th>Author of comment</th>
            <th>Email of author</th>
            <th>Content of comment</th>
            <th>Post where is comment</th>
            <th>Actions</th>

        </tr>
    </thead>
    <tbody id="table-for-comments">

        @foreach($comments as $comment)
        <tr data-id="{{ $comment->id}}">
            <td>{{ $comment->id }}</td>
            <td>{{ $comment->name_of_visitor}}</td>
            <td>{{ $comment->email_of_visitor}}</td>
            <td>{{ $comment->content}}</td>
            <td>
                <p class="text-danger">ID:{{ $comment->post->id}}</p>
                <p>Title: {{ $comment->post->title}}</p>
                <p>URL: <a href="{{ route('front.posts.single',['post'=>$comment->post->id])}}"> Click here to see post</a></p>

            </td>



            <td>
                <div class="">{{ $comment->enable}}</div>
                <div class="switch-button switch-button-success">
                    <input 
                        type="checkbox" 
                        @if($comment->enable==1)checked="" @endif 
                        name="enable" 
                        id="switch{{$comment->id}}" 
                        value="{{ $comment->enable}}" 
                        data-action="enable"
                        data-id="{{ $comment->id}}"
                        >
                        <span>
                        <label for="switch{{ $comment->id}}"></label>
                    </span>
                </div>
            </td>
        </tr>
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <th>#</th>
            <th>Author of comment</th>
            <th>Email of author</th>
            <th>Content of comment</th>
            <th>Post where is comment</th>
            <th>Actions</th>

        </tr>
    </tfoot>
</table>
<script>
    $('#table-for-comments [data-action="enable"]').on('click', function (e) {

        let commentId = $(this).attr('data-id');
        $.ajax({
            "url": "{{ route('admin.comments.enable')}}",
            "type": "POST",
            "data": {
                "comment_id": commentId,
                "_token": "{{  csrf_token()}}"
            },
            "error": function (xhr, ajaxOptions, thrownError) {
                alert(xhr.status);
                alert(thrownError);
            }
        }).done(function (response) {

            loadTableContent();
        }).fail(function () {
            alert('negde je doslo do greske');
        });
    });
</script>