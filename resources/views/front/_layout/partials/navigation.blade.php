<header class="header">
    <!-- Main Navbar-->
    <nav class="navbar navbar-expand-lg">
        <div class="search-area">
            <div class="search-area-inner d-flex align-items-center justify-content-center">
                <div class="close-btn"><i class="icon-close"></i></div>
                <div class="row d-flex justify-content-center">
                    <div class="col-md-8">
                        <!--Search bar here try to use ajax -->
                        <form action="{{route('front.posts.search')}}" method="get">
                            <div class="form-group">
                                <input type="search" id="search" placeholder="What are you looking for?" name="value" value="{{ old('value')}}">
                                @include('front._layout.partials.form_errors',['fieldName'=>'value'])
                                <button type="submit" class="submit"><i class="icon-search-1"></i></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <!-- Navbar Brand -->
            <div class="navbar-header d-flex align-items-center justify-content-between">
                <!-- Navbar Brand --><a href="{{ route('front.index.index')}}" class="navbar-brand">@lang('Bootstrap Blog')</a>
                <!-- Toggle Button-->
                <button type="button" data-toggle="collapse" data-target="#navbarcollapse" aria-controls="navbarcollapse" aria-expanded="false" aria-label="Toggle navigation" class="navbar-toggler"><span></span><span></span><span></span></button>
            </div>
            <!-- Navbar Menu -->
            <div id="navbarcollapse" class="collapse navbar-collapse">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item"><a href="{{ route('front.index.index')}}" class="nav-link active">@lang('Home')</a>
                    </li>
                    <li class="nav-item"><a href="{{route('front.posts.index')}}" class="nav-link">@lang('Blog')</a>
                    </li>
                    <li class="nav-item"><a href="{{ route('front.contact.index')}}" class="nav-link">@lang('Contact')</a>
                    </li>
                </ul>
                <div class="navbar-text"><a href="{{ route('front.posts.search')}}" class="search-btn"><i class="icon-search-1"></i></a></div>
            </div>
        </div>
    </nav>
</header>
