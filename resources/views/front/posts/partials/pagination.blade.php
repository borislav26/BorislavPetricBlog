@if ($paginator->lastPage() > 1)
<ul class="pagination pagination-template d-flex justify-content-center">
    <li class="{{ ($paginator->currentPage() == 1) ? ' disabled page-item' : '' }}">
        <a href="{{ $paginator->url(1) }}" class="page-link"><i class="fa fa-angle-left"></i></a>
    </li>
    @for ($i = 1; $i <= $paginator->lastPage(); $i++)
    <li class="{{ ($paginator->currentPage() == $i) ? ' active page-item' : '' }}">
        <a href="{{ $paginator->url($i) }}" class="page-link">{{ $i }}</a>
    </li>
    @endfor
    <li class="{{ ($paginator->currentPage() == $paginator->lastPage()) ? ' disabled page-item' : '' }}">
        <a href="{{ $paginator->url($paginator->currentPage()+1) }}" class="page-link" ><i class="fa fa-angle-right"></i></a>
    </li>
</ul>
@endif

