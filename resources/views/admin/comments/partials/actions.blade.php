@if($comment->enable==0)
<span class="text-danger">DISABLED</span>
@endif
@if($comment->enable==1)
<span class="text-success">ENABLED</span>
@endif
<div class="switch-button switch-button-success">
    <input 
        type="checkbox" 
        name="enable" 
        id="switch_{{$comment->id}}" 
        value="{{ $comment->enable}}" 
        data-action="enable"
        data-id="{{ $comment->id}}"
        @if($comment->enable==1)checked="" @endif 
        >
        <span>
        <label for="switch_{{ $comment->id}}"></label>
    </span>
</div>
