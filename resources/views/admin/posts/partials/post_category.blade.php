@if($post->post_category_id==0)
<span class="text-warning">Uncategorized</span>
@endif
@if($post->post_category_id!=0)
{{ $post->category->name}}
@endif