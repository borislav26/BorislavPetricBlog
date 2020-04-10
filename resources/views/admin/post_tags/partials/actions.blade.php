<div class="btn-group ml-auto text-center">
    <a href="{{ route('admin.post_tags.edit',['tag'=>$tag->id])}}"><button class="btn btn-sm btn-outline-light">@lang('Edit')</button></a>
    <button 
        class="btn btn-sm btn-outline-light" 
        data-toggle="modal" data-target="#modalDiscount"
        data-id="{{ $tag->id}}"
        data-name="{{ $tag->name}}"
        data-action="delete"
        >
        <i class="far fa-trash-alt"></i>
    </button>
    <a href="{{ $tag->getFrontUrl()}}">
        <button class="btn btn-sm btn-outline-light">
            <i class="fas fa-eye"></i>
        </button>
    </a>

</div>