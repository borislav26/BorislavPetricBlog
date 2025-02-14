<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\PostCategory;
use App\Models\PostTags;
use Illuminate\Validation\Rule;
use App\User;
use App\Models\Comment;

define('ADMINISTRATOR', 1);

class PostsController extends Controller {

    public function index() {
        $posts = Post::query()
                ->withCount(['category', 'author', 'comments']);
        if (\Auth::user()->role_id != ADMINISTRATOR) {
            $posts->where('post_author_id', \Auth::user()->id);
        }
        $posts->get();
        $tags = PostTags::all();
        $categories = PostCategory::all();
        $authors = User::all();
        return view('admin.posts.index', [
            'posts' => $posts,
            'tags' => $tags,
            'categories' => $categories,
            'authors' => $authors
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
        if (\Auth::user()->id != $post->post_author_id && \Auth::user()->role_id != ADMINISTRATOR) {
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
            'title' => ['required', 'string', 'min:5', 'max:30', 'unique:posts,title'],
            'shortDescription' => ['required', 'string', 'max:255'],
            'post_category_id' => ['nullable', 'numeric', 'exists:post_categories,id'],
            'tag_id' => ['required', 'array', 'min:1'],
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

        $post->tags()->sync($formData['tag_id']);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = $post->id . '_' . $file->getClientOriginalName();

            $file->move(public_path('/storage/posts/'), $fileName);


            $post->image = $fileName;

            $post->save();

            \Image::make(public_path('/storage/posts/' . $post->image))
                    ->fit(640, 426)
                    ->save(public_path('/storage/posts/thumbs/' . $post->image));
        }
        session()->flash(
                'session_message', 'You have added new post successfully!'
        );
        return redirect()->route('admin.posts.index');
    }

    public function update(Request $request, Post $post) {
        if (\Auth::user()->id != $post->post_author_id && \Auth::user()->role_id != ADMINISTRATOR) {
            return redirect()->route('admin.index.index');
        }
        $formData = $request->validate([
            'title' => ['required', 'string', 'min:5', 'max:30', Rule::unique('posts')->ignore($post->id)],
            'shortDescription' => ['required', 'string', 'max:255'],
            'post_category_id' => ['nullable', 'numeric', 'exists:post_categories,id'],
            'tag_id' => ['required', 'array', 'min:1'],
            'status_important' => ['required', 'numeric', 'in:0,1'],
            'enable' => ['required', 'numeric', 'in:0,1'],
            'image' => ['nullable', 'file', 'image', 'max:51200'],
            'mainContent' => ['required', 'string']
        ]);


        if (empty($formData['post_category_id'])) {
            $post->post_category_id = 0;
        }else{
            $post->post_category_id=$formData['post_category_id'];
        }
        $post->post_author_id = \Auth::id();

        $post->fill($formData);
        if ($request->hasFile('image')) {
            $post->deletePhoto();
            $post->deleteThumbPhoto();
            $file = $request->file('image');
            $fileName = $post->id . '_' . $file->getClientOriginalName();

            $file->move(public_path('/storage/posts/'), $fileName);


            $post->image = $fileName;

            $post->save();

            \Image::make(public_path('/storage/posts/' . $post->image))
                    ->fit(640, 426)
                    ->save(public_path('/storage/posts/thumbs/' . $post->image));
        }

        $post->save();
        $post->tags()->sync($formData['tag_id']);
        session()->flash(
                'session_message', 'You have updated post successfully!'
        );
        return redirect()->route('admin.posts.index');
    }

    public function delete(Request $request) {
        $formData = $request->validate([
            'post_id' => ['required', 'numeric', 'exists:posts,id']
        ]);

        $post = Post::findOrFail($formData['post_id']);

        if (\Auth::user()->id != $post->post_author_id && \Auth::user()->role_id != ADMINISTRATOR) {
            return redirect()->route('admin.index.index');
        }
        $post->deletePhoto();
        $post->deleteThumbPhoto();
        $post->delete();
        Comment::query()
                ->where('post_id', $post->id)
                ->delete();
         $post->tags()->sync([]);
        return response()->json([
                    'success_message' => 'You have deleted post successfully'
        ]);
    }

    public function tableContent(Request $request) {
        $formData = $request->validate([
            'title' => ['nullable', 'string'],
            'post_category' => ['nullable', 'string'],
            'post_autor' => ['nullable', 'string'],
            'enable' => ['nullable', 'numeric', 'in:0,1'],
            'important' => ['nullable', 'numeric', 'in:0,1'],
            'tag_id' => ['nullable', 'array']
        ]);
        $query = Post::query()
                ->with(['author', 'category', 'tags'])
                ->leftJoin('post_categories', 'posts.post_category_id', '=', 'post_categories.id')
                ->join('users', 'posts.post_author_id', '=', 'users.id')
                ->select(['posts.*', 'post_categories.name AS category_name', 'users.name AS author_name'])
                ->orderBy('id','desc');
        if (\Auth::user()->role_id != ADMINISTRATOR) {
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
                ->rawColumns(['image', 'actions', 'enable', 'important', 'category'])
                ->filter(function($query) use ($request) {
                    if ($request->has('search') && is_array($request->get('search')) && isset($request->get('search')['value'])) {
                        $valueFromSearchInput = $request->get('search')['value'];
                        $query->where(function($query) use ($valueFromSearchInput) {
                            $query->orWhere('enable', $valueFromSearchInput)
                            ->orWhere('status_important', $valueFromSearchInput)
                            ->orWhere('posts.title', 'LIKE', '%' . $valueFromSearchInput . '%')
                            ->orWhere('post_categories.name', 'LIKE', '%' . $valueFromSearchInput . '%')
                            ->orWhere('users.name', 'LIKE', '%' . $valueFromSearchInput . '%');
                        });
                    }
                });

        return $dataTable->make(true);
    }

    public function disable(Request $request) {
        if (\Auth::user()->role_id != ADMINISTRATOR) {
            return redirect()->route('admin.index.index');
        }
        $formData = $request->validate([
            'post_id' => ['required', 'numeric', 'exists:posts,id']
        ]);

        $post = Post::findOrFail($formData['post_id']);


        $post->enable = 0;
        $post->save();
        return response()->json([
                    'success_message' => 'The post has been disabled'
        ]);
    }

    public function enable(Request $request) {
        if (\Auth::user()->role_id != ADMINISTRATOR) {
            return redirect()->route('admin.index.index');
        }
        $formData = $request->validate([
            'post_id' => ['required', 'numeric', 'exists:posts,id']
        ]);

        $post = Post::findOrFail($formData['post_id']);


        $post->enable = 1;
        $post->save();
        return response()->json([
                    'success_message' => 'The post has been enabled'
        ]);
    }

    public function notImportant(Request $request) {
        if (\Auth::user()->role_id != ADMINISTRATOR) {
            return redirect()->route('admin.index.index');
        }
        $formData = $request->validate([
            'post_id' => ['required', 'numeric', 'exists:posts,id']
        ]);

        $post = Post::findOrFail($formData['post_id']);


        $post->status_important = 0;
        $post->save();
        return response()->json([
                    'success_message' => 'The post put as not important'
        ]);
    }

    public function important(Request $request) {
        if (\Auth::user()->role_id != ADMINISTRATOR) {
            return redirect()->route('admin.index.index');
        }
        $formData = $request->validate([
            'post_id' => ['required', 'numeric', 'exists:posts,id']
        ]);

        $post = Post::findOrFail($formData['post_id']);


        $post->status_important = 1;
        $post->save();
        return response()->json([
                    'success_message' => 'The post put as important'
        ]);
    }

}
