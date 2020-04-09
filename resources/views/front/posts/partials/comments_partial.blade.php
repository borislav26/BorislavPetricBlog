<header>
<h3 class="h6">Post Comments<span class="no-of-comments">({{optional($post->comments())->where('enable','!=','0')->count()}})</span></h3>
</header>
@foreach(optional($post->comments())->where('enable','!=',0)->orderBy('created_at','desc')->get() as $comment)
<div class="comment">
    <div class="comment-header d-flex justify-content-between">
        <div class="user d-flex align-items-center">
            <div class="image"><img src="/themes/front/img/user.svg" alt="..." class="img-fluid rounded-circle"></div>
            <div class="title"><strong>{{$comment->name_of_visitor}}</strong><span class="date">{{ $comment->giveMeHumanFriendlyDate()}}</span></div>
        </div>
    </div>
    <div class="comment-body">
        <p>{{$comment->content}}</p>
    </div>
</div>
@endforeach

