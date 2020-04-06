<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SliderItem;
use App\Models\PostTags;
use App\Models\Post;
use App\Models\PostCategory;
class IndexController extends Controller
{
    public function index(){
        $sliderItems=SliderItem::query()
                ->orderBy('order')
                ->get();
        $postTags= PostTags::all();
        $latestPosts= Post::query()
                ->with(['category'])
                ->orderBy('created_at')
                ->limit(12)
                ->get();
        $introBlogPosts=Post::query()
                ->withCount(['author','category','comments'])
                ->where('status_important',1)
                ->orderBy('created_at','desc')
                ->limit(3)
                ->get();
        $categoriesWithHighestPriority= PostCategory::query()
                ->orderBy('priority','desc')
                ->take(4)
                ->get();
        $newestPosts= Post::query()
                ->withCount(['comments'])
                ->orderBy('created_at','desc')
                ->take(3)
                ->get();
        return view('front.index.index',[
            'sliderItems'=>$sliderItems,
            'postTags'=>$postTags,
            'latestPosts'=>$latestPosts,
            'introBlogPosts'=>$introBlogPosts,
            'categoriesWithHighestPriority'=>$categoriesWithHighestPriority,
            'newestPosts'=>$newestPosts
        ]);
    }
}
