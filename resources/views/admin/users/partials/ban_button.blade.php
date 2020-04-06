@if(\Auth::id()!=$author->id)
<div class="">{{ $author->enable}}</div>
<div class="switch-button switch-button-success">
    <input 
        type="checkbox" 
        @if($author->ban==1)checked="" @endif 
        name="ban" 
        id="switch{{$author->id}}" 
        value="{{ $author->ban}}" 
        data-action="ban"
        data-id="{{ $author->id}}"
        >
        <span>
        <label for="switch{{ $author->id}}"></label>
    </span>
</div>
@endif