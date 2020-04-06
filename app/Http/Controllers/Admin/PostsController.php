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
         return view('admin.posts.edit',[
             'postCategories'=>$postCategories,
             'tags'=>$tags,
             'post'=>$post
         ]);
    }
    public function insert(Request $request){
        $formData=$request->validate([
            'title'=>['required','string','min:5','max:30'],
            'shortDescription'=>['required','string','max:255'],
            'post_category_id'=>['nullable','numeric','exists:post_categories,id'],
            'tag_id'=>['required','array','min:2'],
            'status_important'=>['required','numeric','in:0,1'],
            'enable'=>['required','numeric','in:0,1'],
        ]);
        
        $post=new Post();
        if(empty($formData['post_category_id'])){
            $post->post_category_id=0;
        }
        $post->post_author_id=\Auth::id();
        $post->fill($formData);
        
        
        $post->save();
       
        return redirect()->route('admin.posts.index');
    }
    public function update(Request $request,Post $post){
        $formData=$request->validate([
            'title'=>['required','string','min:5','max:30'],
            'shortDescription'=>['required','string','max:255'],
            'post_category_id'=>['nullable','numeric','exists:post_categories,id'],
            'tag_id'=>['required','array','min:2'],
            'status_important'=>['required','numeric','in:0,1'],
            'enable'=>['required','numeric','in:0,1'],
        ]);
        
        
        if(empty($formData['post_category_id'])){
            $post->post_category_id=0;
        }
        $post->post_author_id=\Auth::id();
        $post->fill($formData);
        
        
        $post->save();
       
        return redirect()->route('admin.posts.index');
    }
    
    public function tableContent() {
        $query = Post::query();
        $dataTable = \DataTables::of($query);

        $dataTable->addColumn('image', function($post) {
            return view('admin.posts.partials.post_image',[
                'post'=>$post
            ]);
        })->addColumn('enable', function($post) {
            return view('admin.posts.partials.enable_button',[
                'post'=>$post
            ]);
        })->addColumn('important', function($post) {
            return view('admin.posts.partials.important_button',[
                'post'=>$post
            ]);
        })->addColumn('author', function($post) {
            return $post->author->name;
            
        })->addColumn('category', function($post) {
            return view('admin.posts.partials.post_category',[
                'post'=>$post
            ]);
            
        })->addColumn('comments_number', function($post) {
            return $post->comments()->count();
            
        })->addColumn('created_at', function($post) {
            return $post->giveMeHumanFriendlyDate();
        })->addColumn('actions', function($post) {
            return view('admin.posts.partials.actions',[
                'post'=>$post
            ]);
        })
        ->rawColumns(['image','actions','enable','important','category']);

        return $dataTable->make(true);
    }
    
}
