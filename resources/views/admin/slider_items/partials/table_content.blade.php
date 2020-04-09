<table class="table table-striped table-bordered first">
    <thead>
    <col width="5%">
    <col width="15%">
    <col width="10%">
    <col width="20%">
    <col width="15%">
    <col width="15%">
    <col width="30%">
    <tr>
        <th>#</th>

        <th>Title</th>
        <th>Image</th>
        <th>Url</th>
        <th>Name of button</th>
        <th>Enable</th>
        <th>Actions</th>
    </tr>
</thead>
<tbody id="table-for-slider-items">
    @foreach($sliderItems as $item)
    <tr data-id="{{ $item->id}}">
        <td>{{ $item->id }}</td>
        <td>{{ $item->title}}</td>
        <td>
            <img class="mr-3 user-avatar-lg rounded" src="{{ $item->getPhotoUrl()}}" alt="Generic placeholder image">
        </td>

        <td>{{ $item->url}}</td>
        <td>{{ $item->button_name}}</td>
        <td>
            <div class="switch-button switch-button-success">
                <div class="text-center">{{ $item->enable}}</div>
                <input type="checkbox"  @if($item->enable==1) checked=""  @endif name="enable" id="switch{{$item->id}}" value="{{ $item->enable}}">
                       <span>
                    <label for="switch{{ $item->id}}"></label>
                </span>
            </div>
        </td>
        <td>
            <div class="btn-group ml-auto">
                <a href="{{ route('admin.slider_items.edit',['sliderItem'=>$item->id])}}"><button class="btn btn-sm btn-outline-light">Edit</button></a>
                <button 
                    class="btn btn-sm btn-outline-light" 
                    data-toggle="modal" 
                    data-target="#modalDiscount" 
                    data-action="delete"
                    data-id="{{$item->id}}"
                    data-name="{{ $item->title}}"
                    >
                    <i class="far fa-trash-alt"></i>
                </button>

                <span class="btn btn-outline-secondary" 
                      style="display: none;" 
                      data-action="change-order-button"

                      >
                    <i class="fas fa-sort">Change order</i>
                </span>
            </div>
        </td>
    </tr>
    @endforeach

</tbody>
<tfoot>
    <tr>
        <th>#</th>

        <th>Title</th>
        <th>Image</th>
        <th>Url</th>
        <th>Name of button</th>
        <th>Enable</th>
        <th>Actions</th>
    </tr>
</tfoot>
</table>