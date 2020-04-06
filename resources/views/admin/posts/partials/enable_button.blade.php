<div class="text-center">{{ $post->enable}}</div>
<div class="switch-button switch-button-success">
    <input type="checkbox" checked="" name="enable" id="switch{{$post->id}}" value="{{ $post->enable}}">
    <span>
        <label for="switch{{ $post->id}}"></label>
    </span>
</div>