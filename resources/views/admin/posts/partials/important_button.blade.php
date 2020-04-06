<div class="text-center">
    {{ $post->status_important}}
</div>
<div class="switch-button switch-button-success">
    <input type="checkbox" checked="" name="important" id="switch_{{ $post->id}}" value="{{ $post->important}}">
    <span>
        <label for="switch_{{ $post->id}}"></label>
    </span>
</div>

