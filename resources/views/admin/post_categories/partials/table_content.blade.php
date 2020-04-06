<table class="table table-striped table-bordered first">
    <thead>
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Description</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody id="table-for-post-categories">
        @foreach($postCategories as $category)
        <tr data-id="{{ $category->id}}">
            <td>{{ $category->id }}</td>
            <td>{{ $category->name}}</td>

            <td>{{ $category->description}}</td>

            <td>
                <div class="btn-group ml-auto">
                    <a href="{{ route('admin.post_categories.edit',['category'=>$category->id])}}"><button class="btn btn-sm btn-outline-light">Edit</button></a>
                    <button 
                        class="btn btn-sm btn-outline-light" 
                        data-toggle="modal" 
                        data-target="#modalDiscount"
                        data-id="{{ $category->id}}"
                        data-action="delete"
                        data-name="{{ $category->name}}"
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
            <th>Description</th>
            <th>Actions</th>
        </tr>
    </tfoot>
</table>

<script>
    $('#table-for-post-categories [data-action="delete"]').on('click', function () {
        let categoryId = $(this).attr('data-id');
        let categoryName = $(this).attr('data-name');

        $('#modalDiscount #category_name').text(categoryName);
        $('#modalDiscount [name="category_id"]').val(categoryId);
    });
    $('#modalDiscount').on('submit', function (e) {
        e.preventDefault();
        $(this).modal('hide');
        $.ajax({
            "url": "{{ route('admin.post_categories.delete')}}",
            "type": "post",
            "data": $(this).serialize(),
 
        }).done(function (response) {
            
            loadTableContent();
        }).fail(function () {
            
        });
    });
</script>