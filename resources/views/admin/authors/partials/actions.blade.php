<div class="btn-group ml-auto">
    <a href="{{ route('admin.authors.edit',['author'=>$author->id])}}"><button class="btn btn-sm btn-outline-light">Edit</button></a>
    <button class="btn btn-sm btn-outline-light" data-toggle="modal" data-target="#modalDiscount" data-action="delete" data-id="{{$author->id}}" data-name="{{$author->name}}">
        <i class="far fa-trash-alt"></i>
    </button>
    <a href="{{ route('front.posts.author',['author'=>$author->id])}}">
        <button class="btn btn-sm btn-outline-light">
            <i class="fas fa-eye"></i>
        </button>
    </a>
    <span class="btn btn-outline-secondary" data-action="button-for-priority"  style="display: none;" data-action="change-priority-button">
        <i class="fas fa-sort">Change priority</i>
    </span>
</div>
