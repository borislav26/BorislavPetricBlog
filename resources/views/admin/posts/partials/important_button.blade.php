@if($post->status_important==0)
<span class="text-danger">NOT IMPORTANT</span>
@endif
@if($post->status_important==1)
<span class="text-success">IMPORTANT</span>
@endif
<div class="switch-button switch-button-success">
    <input 
        type="checkbox" 
        data-action="important"
        data-id="{{$post->id}}"
        data-value="{{$post->status_important}}"
        @if($post->status_important) checked="" @endif  
        id="switch_{{ $post->id}}" 
        value="{{ $post->status_important}}"
        >
    <span>
        <label for="switch_{{ $post->id}}"></label>
    </span>
</div>

