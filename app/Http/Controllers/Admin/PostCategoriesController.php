<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PostCategory;
use App\Models\Post;
use Illuminate\Validation\Rule;
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
            'name' => ['required', 'string', 'min:3','unique:post_categories,name'],
            'description' => ['required', 'string', 'min:5'],
        ]);

        $category = new PostCategory();

        $category->fill($formData);


        $category->save();
        session()->flash(
            'session_message','You have added new category successfully!'
        );
        return redirect()->route('admin.post_categories.index');
    }

    public function update(Request $request, PostCategory $category) {

        $formData = $request->validate([
            'name' => ['required', 'string', 'min:3',Rule::unique('post_categories')->ignore($category->id)],
            'description' => ['required', 'string', 'min:5'],
        ]);



        $category->fill($formData);

        $category->save();

        session()->flash(
            'session_message' ,'You have updated category successfully!'
        );
        return redirect()->route('admin.post_categories.index');
    }

    public function delete(Request $request) {

        $formData = $request->validate([
            'category_id' => ['required', 'numeric', 'exists:post_categories,id']
        ]);

        $category = PostCategory::findOrFail($formData['category_id']);

        Post::query()
                ->where('post_category_id', $category->id)
                ->update([
                    'post_category_id' => 1
        ]);

        PostCategory::query()
                ->where('priority', '>', $category->priority)
                ->decrement('priority');
        $category->delete();

        return response()->json([
                    'success_message' => 'You have deleted category successfully!'
        ]);
    }

    public function changePriority(Request $request) {

        $formData = $request->validate([
            'priorities' => ['required', 'string']
        ]);
        $priorities = explode(',', $formData['priorities']);
        foreach ($priorities as $key => $priority) {
            $postCategory = PostCategory::findOrFail($priority);
            $postCategory->priority = $key + 1;
            $postCategory->save();
        }

        return redirect()->back();
    }

    public function tableContent() {

        $postCategories = PostCategory::all();
        return view('admin.post_categories.partials.table_content', [
            'postCategories' => $postCategories
        ]);
    }

}
