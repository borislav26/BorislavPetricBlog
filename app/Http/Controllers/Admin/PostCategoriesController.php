<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PostCategory;

class PostCategoriesController extends Controller {

    public function index() {

        $postCategories = PostCategory::all();
        return view('admin.post_categories.index', [
            'postCategories' => $postCategories
        ]);
    }

    public function add() {

        return view('admin.post_categories.add');
    }

    public function edit(PostCategory $category) {
        return view('admin.post_categories.edit', [
            'category' => $category
        ]);
    }

    public function insert(Request $request) {

        $formData = $request->validate([
            'name' => ['required', 'string', 'min:3'],
            'description' => ['required', 'string', 'min:5'],
        ]);

        $category = new PostCategory();

        $category->fill($formData);


        $category->save();

        return redirect()->route('admin.post_categories.index');
    }

    public function update(Request $request, PostCategory $category) {
        $formData = $request->validate([
            'name' => ['required', 'string', 'min:3'],
            'description' => ['required', 'string', 'min:5'],
        ]);

        

        $category->fill($formData);

        $category->save();


        return redirect()->route('admin.post_categories.index');
    }
    public function delete(Request $request){
        $formData=$request->validate([
           'category_id'=>['required','numeric','exists:post_categories,id'] 
        ]);
        
        $category= PostCategory::findOrFail($formData['category_id']);
        
        
        $category->delete();
        
        return redirect()->route('admin.post_categories.index');
    }
    public function changePriority(Request $request){
        $formData=$request->validate([
            'priorities'=>['required','string']
        ]);
        $priorities= explode(',', $formData['priorities']);
        foreach ($priorities as $key=>$priority){
            $postCategory= PostCategory::findOrFail($priority);
            $postCategory->priority=$key+1;
            $postCategory->save();
        }
        
        return redirect()->back();
    }
    public function tableContent(){
        
        $postCategories= PostCategory::all();
        return view('admin.post_categories.partials.table_content',[
            'postCategories'=>$postCategories
        ]);
    }
}
