<div class="btn-group ml-auto">
    <a href="{{ route('admin.posts.edit',['post'=>$post->id])}}"><button class="btn btn-sm btn-outline-light">Edit</button></a>
    <button class="btn btn-sm btn-outline-light">
        <i class="far fa-trash-alt"></i>
    </button>
    <button class="btn btn-sm btn-outline-light">
        <i class="fas fa-eye"></i>
    </button>
</div>