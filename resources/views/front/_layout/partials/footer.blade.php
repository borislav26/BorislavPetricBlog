<!-- Page Footer-->
<footer class="main-footer">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="logo">
                    <h6 class="text-white">Borislav Petric Blog</h6>
                </div>
                <div class="contact-details">
                    <p>53 Broadway, Broklyn, NY 11249</p>
                    <p>Phone: (020) 123 456 789</p>
                    <p>Email: <a href="mailto:borislavpetric66@gmail.com">borislavpetric66@gmail.com</a></p>
                    <ul class="social-menu">
                        <li class="list-inline-item"><a href="#"><i class="fa fa-facebook"></i></a></li>
                        <li class="list-inline-item"><a href="#"><i class="fa fa-twitter"></i></a></li>
                        <li class="list-inline-item"><a href="#"><i class="fa fa-instagram"></i></a></li>
                        <li class="list-inline-item"><a href="#"><i class="fa fa-behance"></i></a></li>
                        <li class="list-inline-item"><a href="#"><i class="fa fa-pinterest"></i></a></li>
                    </ul>
                </div>
            </div>
            <div class="col-md-4">
                <div class="menus d-flex">
                    <ul class="list-unstyled">
                        <li> <a href="{{ route('front.index.index')}}">@lang('Home')</a></li>
                        <li> <a href="{{ route('front.posts.index')}}">@lang('Blog')</a></li>
                        <li> <a href="{{ route('front.contact.index')}}">@lang('Contact')</a></li>
                        <li> <a href="{{ route('login')}}">@lang('Login')</a></li>
                    </ul>
                    <ul class="list-unstyled">
                        @foreach($categoriesWithHighestPriority as $category)
                        <li> <a href="{{ $category->getFrontUrl()}}">{{ $category->name}}</a></li>
                        @endforeach

                    </ul>
                </div>
            </div>
            <div class="col-md-4">
                <div class="latest-posts">
                    @foreach($newestPosts as $newestPost)
                    <a href="{{ $newestPost->getFrontUrl()}}">
                        <div class="post d-flex align-items-center">
                            <div class="image"><img src="{{url('/themes/front/img/small-thumbnail-1.jpg')}}" alt="..." class="img-fluid"></div>
                            <div class="title"><strong>{{ $newestPost->title}}</strong><span class="date last-meta">{{ $newestPost->giveMeHumanFriendlyDate()}}</span></div>
                        </div>
                    </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <div class="copyrights">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <p>&copy; 2020.Borislav Petric. All rights reserved. </p>
                </div>
                <div class="col-md-6 text-right">
                    <p>Blog by <a href="#" class="text-white">Borislav Petric</a>
                        <!-- Please do not remove the backlink to Bootstrap Temple unless you purchase an attribution-free license @ Bootstrap Temple or support us at http://bootstrapious.com/donate. It is part of the license conditions. Thanks for understanding :)                         -->
                    </p>
                </div>
            </div>
        </div>
    </div>
</footer>