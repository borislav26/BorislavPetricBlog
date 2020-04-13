<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\User;
use App\Models\PostTags;
use App\Models\PostCategory;
class IndexController extends Controller
{
    public function index(){
        $postsNumber=Post::query()->count('id');
        $authorsNumber=User::query()->count('id');
        $tagsNumber= PostTags::query()->count('id');
        $categoriesNumber=PostCategory::query()->count('id');
        return view('admin.index.index',[
            'postsNumber'=>$postsNumber,
            'authorsNumber'=>$authorsNumber,
            'tagsNumber'=>$tagsNumber,
            'categoriesNumber'=>$categoriesNumber
        ]);
    }
}
