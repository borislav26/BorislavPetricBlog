<table class="table table-striped table-bordered first">
    <col width="33%">
    <col width="33%">
    <col width="33%">
    <thead>
        <tr>
            <th>#</th>
            <th>Name</th>

            <th>Actions</th>
        </tr>
    </thead>
    <tbody id="table-for-post-tags">
        @foreach($postTags as $tag)
        <tr data-id="{{ $tag->id}}">
            <td>{{ $tag->id }}</td>
            <td>#{{ $tag->name}}</td>



            <td>
                <div class="btn-group ml-auto" style="float: right;">
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
                    <button class="btn btn-sm btn-outline-light">
                        <i class="fas fa-eye"></i>
                    </button>
                    <span class="btn btn-outline-secondary" data-action="button-for-priority"  style="display: none;" data-action="change-priority-button">
                        <i class="fas fa-sort">Change priority</i>
                    </span>
                </div>
            </td>
        </tr>
        @endforeach

    </tbody>
    <tfoot>
        <tr>
            <th>#</th>
            <th>Name</th>

            <th>Actions</th>
        </tr>
    </tfoot>
</table>
<script>
    $('#table-for-post-tags [data-action="delete"]').on('click', function () {
        let categoryId = $(this).attr('data-id');
        let categoryName = $(this).attr('data-name');

        $('#modalDiscount #tag_name').text(categoryName);
        $('#modalDiscount [name="tag_id"]').val(categoryId);
    });
    $('#modalDiscount').on('submit', function (e) {
        e.preventDefault();
        $(this).modal('hide');
        $.ajax({
            "url": "{{ route('admin.post_tags.delete')}}",
            "type": "post",
            "data": $(this).serialize(),
            "error": function (xhr, ajaxOptions, thrownError) {
                alert(xhr.status);
                alert(thrownError);
            }
        }).done(function (response) {

            loadTableContent();
        }).fail(function () {
            alert('negde je doslo do greske');
        });
    });
</script>
