<!-- left sidebar -->
<!-- ============================================================== -->
<div class="nav-left-sidebar sidebar-dark">
    <div class="menu-list">
        <nav class="navbar navbar-expand-lg navbar-light">
            <a class="d-xl-none d-lg-none" href="#">Dashboard</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav flex-column">
                    <li class="nav-divider">
                        @lang('Menu')
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link active" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-1" aria-controls="submenu-1"><i class="fas fa-boxes"></i>@lang('Posts') <span class="badge badge-success">6</span></a>
                        <div id="submenu-1" class="collapse submenu" style="">
                            <ul class="nav flex-column">

                                <li class="nav-item">
                                    <a class="nav-link" href="{{route('admin.posts.index')}}">@lang('Posts list')</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('admin.posts.add')}}">@lang('Add new post')</a>
                                </li>

                            </ul>
                        </div>
                    </li>
                    @if(\Auth::user()->role_id==1)

                    <li class="nav-item">
                        <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-2" aria-controls="submenu-2"><i class="far fa-comments"></i>@lang('Comments')</a>
                        <div id="submenu-2" class="collapse submenu" style="">
                            <ul class="nav flex-column">

                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('admin.comments.index')}}">@lang('Comments list')</a>
                                </li>

                            </ul>
                        </div>
                    </li>


                    <li class="nav-item">
                        <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-3" aria-controls="submenu-3"><i class="fas fa-fw fa-chart-pie"></i>@lang('Post Categories')</a>
                        <div id="submenu-3" class="collapse submenu" style="">
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('admin.post_categories.index')}}">@lang('List of categories')</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('admin.post_categories.add')}}">@lang('Add new category')</a>
                                </li>

                            </ul>
                        </div>
                    </li>
                    @endif
                    <li class="nav-item ">
                        <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-4" aria-controls="submenu-4"><i class="fas fa-hashtag"></i>@lang('Post tags')</a>
                        <div id="submenu-4" class="collapse submenu" style="">
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a class="nav-link" href="{{route('admin.post_tags.index')}}">@lang('List of tags')</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('admin.post_tags.add')}}">@lang('Add new tag')</a>
                                </li>

                            </ul>
                        </div>
                    </li>
                    @if(\Auth::user()->role_id==1 || \Auth::user()->role_id==2)
                    <li class="nav-item">
                        <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-5" aria-controls="submenu-5"><i class="fas fa-fw fa-table"></i>@lang('Slider items')</a>
                        <div id="submenu-5" class="collapse submenu" style="">
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('admin.slider_items.index')}}">@lang('List of slider items')</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('admin.slider_items.add')}}">@lang('Add new item for slider')</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    @endif
                    @if(\Auth::user()->role_id==1)

                    <li class="nav-item">
                        <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-6" aria-controls="submenu-6"><i class="far fa-user"></i>@lang('Authors')</a>
                        <div id="submenu-6" class="collapse submenu" style="">
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('admin.authors.index')}}">@lang('Authors list')</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('admin.authors.add')}}">@lang('Add new author')</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    @endif
                </ul>
            </div>
        </nav>
    </div>
</div>
<!-- ============================================================== -->
<!-- end left sidebar -->
<!-- ============================================================== -->