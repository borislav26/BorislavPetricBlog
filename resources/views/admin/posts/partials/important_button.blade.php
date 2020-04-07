@if($post->important==0)
<span class="text-danger">NOT IMPORTANT</span>
@endif
@if($post->important==1)
<span class="text-success">IMPORTANT</span>
@endif
<div class="switch-button switch-button-success">
    <input type="checkbox" @if($post->important) checked="" @endif name="important" id="switch_{{ $post->id}}" value="{{ $post->important}}">
    <span>
        <label for="switch_{{ $post->id}}"></label>
    </span>
</div>

