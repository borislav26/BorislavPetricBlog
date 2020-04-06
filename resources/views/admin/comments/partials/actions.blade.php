@if($comment->enable==0)
<div class="text-danger">DISABLED</div>
@endif
@if($comment->enable==1)
<div class="text-success">ENABLED</div>
@endif
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
