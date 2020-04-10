@if(\Auth::id()!=$author->id)
<div class="">{{ $author->enable}}</div>
<div class="switch-button switch-button-success">
    <input 
        type="checkbox" 
        @if($author->ban==1)checked="" @endif 
        id="switch{{$author->id}}" 
        data-action="ban"
        data-value="{{$author->ban}}"
        data-id="{{ $author->id}}"
        >
        <span>
        <label for="switch{{ $author->id}}"></label>
    </span>
</div>
@endif