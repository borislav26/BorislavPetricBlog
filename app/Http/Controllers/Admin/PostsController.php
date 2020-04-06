<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\PostCategory;
use App\Models\PostTags;
use Illuminate\Validation\Rule;
class PostsController extends Controller
{
    public function index(){
        $posts= Post::query()
                ->withCount(['category','author','comments'])
                ->get();
        return view('admin.posts.index',[
            'posts'=>$posts
        ]);
    }
    public function add(){
        $postCategories= PostCategory::all();
        
        $tags= PostTags::all();
         return view('admin.posts.add',[
             'postCategories'=>$postCategories,
             'tags'=>$tags
         ]);
    }
    public function edit(Post $post){
        $postCategories= PostCategory::all();
        
        $tags= PostTags::all();
         return view('admin.posts.add',[
             'postCategories'=>$postCategories,
             'tags'=>$tags,
             'post'=>$post
         ]);
    }
    public function insert(Request $request){
        $formData=$request->validate([
            'title'=>['required','string','min:5','max:30'],
            'shortDescription'=>['required','string','max:255'],
            'post_category_id'=>['required','numeric','exists:post_categories,id'],
            'status_important'=>['required','numeric','in:0,1'],
            'enable'=>['required','numeric','in:0,1'],
        ]);
        
        $post=new Post();
         dd($post);
        $post->fill($formData);
        
       
        return redirect()->route('admin.posts.index');
    }
}
