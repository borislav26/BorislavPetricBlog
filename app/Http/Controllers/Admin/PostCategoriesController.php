<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PostCategory;
use App\Models\Post;

class PostCategoriesController extends Controller {

    public function index() {
        if (\Auth::user()->role_id != 1) {
            return redirect()->route('admin.index.index');
        }
        $postCategories = PostCategory::all();
        return view('admin.post_categories.index', [
            'postCategories' => $postCategories
        ]);
    }

    public function add() {
        if (\Auth::user()->role_id != 1) {
            return redirect()->route('admin.index.index');
        }
        return view('admin.post_categories.add');
    }

    public function edit(PostCategory $category) {
        if (\Auth::user()->role_id != 1) {
            return redirect()->route('admin.index.index');
        }
        return view('admin.post_categories.edit', [
            'category' => $category
        ]);
    }

    public function insert(Request $request) {
        if (\Auth::user()->role_id != 1) {
            return redirect()->route('admin.index.index');
        }
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
        if (\Auth::user()->role_id != 1) {
            return redirect()->route('admin.index.index');
        }
        $formData = $request->validate([
            'name' => ['required', 'string', 'min:3'],
            'description' => ['required', 'string', 'min:5'],
        ]);



        $category->fill($formData);

        $category->save();


        return redirect()->route('admin.post_categories.index');
    }

    public function delete(Request $request) {
        if (\Auth::user()->role_id != 1) {
            return redirect()->route('admin.index.index');
        }
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

        return redirect()->route('admin.post_categories.index');
    }

    public function changePriority(Request $request) {
        if (\Auth::user()->role_id != 1) {
            return redirect()->route('admin.index.index');
        }
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
        if (\Auth::user()->role_id != 1) {
            return redirect()->route('admin.index.index');
        }
        $postCategories = PostCategory::all();
        return view('admin.post_categories.partials.table_content', [
            'postCategories' => $postCategories
        ]);
    }

}
