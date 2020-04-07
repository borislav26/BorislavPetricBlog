@if($post->enable==0)
<span class="text-danger">DISABLED</span>
@endif
@if($post->enable==1)
<span class="text-success">ENABLED</span>
@endif
<div class="switch-button switch-button-success">
    <input type="checkbox" @if($post->enable==1)checked="" @endif  name="enable" id="switch{{$post->id}}" value="{{ $post->enable}}">
           <span>
        <label for="switch{{ $post->id}}"></label>
    </span>
</div>