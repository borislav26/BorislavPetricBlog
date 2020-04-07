<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\PostCategory;
use App\Models\PostTags;
use Illuminate\Validation\Rule;

class PostsController extends Controller {

    public function index() {
        $posts = Post::query()
                ->withCount(['category', 'author', 'comments']);
        if (\Auth::user()->role_id != 1) {
            $posts->where('post_author_id', \Auth::user()->id);
        }
        $posts->get();
        return view('admin.posts.index', [
            'posts' => $posts
        ]);
    }

    public function add() {
        $postCategories = PostCategory::all();

        $tags = PostTags::all();
        return view('admin.posts.add', [
            'postCategories' => $postCategories,
            'tags' => $tags
        ]);
    }

    public function edit(Post $post) {
        if (\Auth::user()->id != $post->post_author_id && \Auth::user()->role_id != 1) {
            return redirect()->route('admin.index.index');
        }
        $postCategories = PostCategory::all();

        $tags = PostTags::all();
        return view('admin.posts.edit', [
            'postCategories' => $postCategories,
            'tags' => $tags,
            'post' => $post
        ]);
    }

    public function insert(Request $request) {

        $formData = $request->validate([
            'title' => ['required', 'string', 'min:5', 'max:30'],
            'shortDescription' => ['required', 'string', 'max:255'],
            'post_category_id' => ['nullable', 'numeric', 'exists:post_categories,id'],
            'tag_id' => ['required', 'array', 'min:2'],
            'status_important' => ['required', 'numeric', 'in:0,1'],
            'enable' => ['required', 'numeric', 'in:0,1'],
            'image' => ['nullable', 'file', 'image', 'max:51200'],
            'mainContent' => ['required', 'string'],
        ]);

        $post = new Post();
        if (empty($formData['post_category_id'])) {
            $post->post_category_id = 0;
        }
        $post->post_author_id = \Auth::id();
        $post->fill($formData);

        $post->save();
        
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = $post->id . '_' . $file->getClientOriginalName();

            $file->move(public_path('/storage/posts/', $fileName));


            $post->image = $fileName;

            $post->save();

            \Image::make(public_path('/storage/posts/', $post->image))
                    ->fit(640, 426)
                    ->save();
            \Image::make(public_path('/storage/posts/thumbs/', $post->image))
                    ->fit(256, 256)
                    ->save();
        }

        return redirect()->route('admin.posts.index');
    }

    public function update(Request $request, Post $post) {
        if (\Auth::user()->id != $post->post_author_id && \Auth::user()->role_id != 1) {
            return redirect()->route('admin.index.index');
        }
        $formData = $request->validate([
            'title' => ['required', 'string', 'min:5', 'max:30'],
            'shortDescription' => ['required', 'string', 'max:255'],
            'post_category_id' => ['nullable', 'numeric', 'exists:post_categories,id'],
            'tag_id' => ['required', 'array', 'min:2'],
            'status_important' => ['required', 'numeric', 'in:0,1'],
            'enable' => ['required', 'numeric', 'in:0,1'],
            'image' => ['nullable', 'file', 'image', 'max:51200'],
            'mainContent' => ['required', 'string']
        ]);


        if (empty($formData['post_category_id'])) {
            $post->post_category_id = 0;
        }
        $post->post_author_id = \Auth::id();

        $post->fill($formData);
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = $post->id . '_' . $file->getClientOriginalName();

            $file->move(public_path('/storage/posts/', $fileName));


            $post->image = $fileName;

            $post->save();

            \Image::make(public_path('/storage/posts/', $post->image))
                    ->fit(640, 426)
                    ->save();

            \Image::make(public_path('/storage/posts/thumbs/', $post->image))
                    ->fit(256, 256)
                    ->save();
        }

        $post->save();

        return redirect()->route('admin.posts.index');
    }

    public function delete(Request $request) {
        $formData = $request->validate([
            'post_id' => ['required', 'numeric', 'exists:posts,id']
        ]);

        $post = Post::findOrFail($formData['post_id']);

        if (\Auth::user()->id != $post->post_author_id) {
            return redirect()->route('admin.index.index');
        }
        $post->delete();

        return redirect()->route('admin.posts.index');
    }

    public function tableContent() {
        $query = Post::query();
        if (\Auth::user()->role_id != 1) {
            $query->where('post_author_id', \Auth::user()->id);
        }
        $dataTable = \DataTables::of($query);
        $dataTable->addColumn('image', function($post) {
                    return view('admin.posts.partials.post_image', [
                        'post' => $post
                    ]);
                })->addColumn('enable', function($post) {
                    return view('admin.posts.partials.enable_button', [
                        'post' => $post
                    ]);
                })->addColumn('important', function($post) {
                    return view('admin.posts.partials.important_button', [
                        'post' => $post
                    ]);
                })->addColumn('author', function($post) {
                    return $post->author->name;
                })->addColumn('category', function($post) {
                    return view('admin.posts.partials.post_category', [
                        'post' => $post
                    ]);
                })->addColumn('comments_number', function($post) {
                    return $post->comments()->count();
                })->addColumn('created_at', function($post) {
                    return $post->giveMeHumanFriendlyDate();
                })->addColumn('actions', function($post) {
                    return view('admin.posts.partials.actions', [
                        'post' => $post
                    ]);
                })
                ->rawColumns(['image', 'actions', 'enable', 'important', 'category']);

        return $dataTable->make(true);
    }

}
