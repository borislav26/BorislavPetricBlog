<div class="btn-group ml-auto">
    <a href="{{ route('admin.posts.edit',['post'=>$post->id])}}"><button class="btn btn-sm btn-outline-light">Edit</button></a>
    <button 
        class="btn btn-sm btn-outline-light" 
        data-toggle="modal" 
        data-target="#modalDiscount"
        data-id="{{ $post->id}}"
        data-action="delete"
        data-name="{{ $post->title}}"
        >
        <i class="far fa-trash-alt"></i>
    </button>
    <a href="{{ $post->getFrontUrl()}}">
        <button class="btn btn-sm btn-outline-light">
            <i class="fas fa-eye"></i>
        </button>
    </a>
</div>