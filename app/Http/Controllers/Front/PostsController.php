<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\PostTags;
use App\Models\PostCategory;
use App\Models\Comment;
use App\User;

class PostsController extends Controller {

    public function index() {
        $posts = Post::query()
                ->withCount(['author', 'category', 'tags', 'comments'])
                ->where('enable', 1)
                ->paginate(6);
        $postTags = PostTags::all();
        $postCategories = PostCategory::query()
                ->withCount(['posts'])
                ->orderBy('priority', 'desc')
                ->get();

        $newestPosts = Post::query()
                ->orderBy('created_at', 'desc')
                ->take(3)
                ->get();
        $categoriesWithHighestPriority = PostCategory::query()
                ->orderBy('priority', 'desc')
                ->take(4)
                ->get();
        $postWithTheMostViews = Post::query()
                ->where('created_at', '>=', date('Y-m-d H:i:s', strtotime('-1 month')))
                ->orderBy('reviews', 'desc')
                ->limit(3)
                ->get();
        return view('front.posts.index', [
            'posts' => $posts,
            'postTags' => $postTags,
            'postCategories' => $postCategories,
            'newestPosts' => $newestPosts,
            'categoriesWithHighestPriority' => $categoriesWithHighestPriority,
            'postWithTheMostViews' => $postWithTheMostViews
        ]);
    }

    public function single(Post $post, $name) {
        if ($post->enable == 0) {
            abort(404);
        }
        if ($name != \Str::slug($post->title)) {
            return redirect()->away($post->getFrontUrl());
        }
        $postTags = PostTags::all();
        $postCategories = PostCategory::query()
                ->withCount(['posts'])
                ->orderBy('priority', 'desc')
                ->get();
        $lastPost = Post::query()
                ->orderBy('id', 'desc')
                ->first();
        $newestPosts = Post::query()
                ->orderBy('created_at', 'desc')
                ->take(3)
                ->get();
        $categoriesWithHighestPriority = PostCategory::query()
                ->orderBy('priority', 'desc')
                ->take(4)
                ->get();
        $postWithTheMostViews = Post::query()
                ->where('created_at', '>=', date('Y-m-d H:i:s', strtotime('-1 month')))
                ->orderBy('reviews', 'desc')
                ->limit(3);

        return view('front.posts.single', [
            'post' => $post,
            'postTags' => $postTags,
            'postCategories' => $postCategories,
            'lastPost' => $lastPost,
            'newestPosts' => $newestPosts,
            'categoriesWithHighestPriority' => $categoriesWithHighestPriority,
            'postWithTheMostViews' => $postWithTheMostViews
        ]);
    }

    public function comments(Request $request, Post $post) {

        return view('front.posts.partials.comments_partial', [
            'post' => $post
        ]);
    }

    public function category(PostCategory $category, $name, $description) {
        if ($description != \Str::slug($category->description) || $name != \Str::slug($category->name)) {
            return redirect()->away($category->getFrontUrl());
        }
        $categoriesWithHighestPriority = PostCategory::query()
                ->orderBy('priority', 'desc')
                ->take(4)
                ->get();
        $postCategories = PostCategory::query()
                ->withCount(['posts'])
                ->orderBy('priority', 'desc')
                ->get();
        $postTags = PostTags::all();
        $newestPosts = Post::query()
                ->orderBy('created_at', 'desc')
                ->take(3)
                ->get();
        $postWithTheMostViews = Post::query()
                ->where('created_at', '>=', date('Y-m-d H:i:s', strtotime('-1 month')))
                ->orderBy('reviews', 'desc')
                ->limit(3)
                ->get();
        $posts = $category->posts()->with(['author', 'category', 'tags', 'comments'])->where('enable', 1)->paginate(6);

        return view('front.posts.category', [
            'categoriesWithHighestPriority' => $categoriesWithHighestPriority,
            'postCategories' => $postCategories,
            'postTags' => $postTags,
            'newestPosts' => $newestPosts,
            'category' => $category,
            'posts' => $posts,
            'postWithTheMostViews' => $postWithTheMostViews
        ]);
    }

    public function tag(PostTags $tag, $name) {
        if ($name != \Str::slug($tag->name)) {
            return redirect()->away($tag->getFrontUrl());
        }
        $categoriesWithHighestPriority = PostCategory::query()
                ->orderBy('priority', 'desc')
                ->take(4)
                ->get();
        $postCategories = PostCategory::query()
                ->withCount(['posts'])
                ->orderBy('priority', 'desc')
                ->get();
        $postTags = PostTags::all();
        $newestPosts = Post::query()
                ->orderBy('created_at', 'desc')
                ->take(3)
                ->get();
        $postWithTheMostViews = Post::query()
                ->where('created_at', '>=', date('Y-m-d H:i:s', strtotime('-1 month')))
                ->orderBy('reviews', 'desc')
                ->limit(3)
                ->get();
        $posts = $tag->posts()->with(['author', 'category', 'tags', 'comments'])->where('enable', 1)->paginate(6);

        return view('front.posts.tag', [
            'categoriesWithHighestPriority' => $categoriesWithHighestPriority,
            'postCategories' => $postCategories,
            'postTags' => $postTags,
            'newestPosts' => $newestPosts,
            'tag' => $tag,
            'posts' => $posts,
            'postWithTheMostViews' => $postWithTheMostViews
        ]);
    }

    public function author(User $author, $name) {
        if ($name != \Str::slug($author->name)) {
            return redirect()->away($author->getFrontUrl());
        }
        $categoriesWithHighestPriority = PostCategory::query()
                ->orderBy('priority', 'desc')
                ->take(4)
                ->get();
        $postCategories = PostCategory::query()
                ->withCount(['posts'])
                ->orderBy('priority', 'desc')
                ->get();
        $postTags = PostTags::all();
        $newestPosts = Post::query()
                ->orderBy('created_at', 'desc')
                ->take(3)
                ->get();
        $postWithTheMostViews = Post::query()
                ->where('created_at', '>=', date('Y-m-d H:i:s', strtotime('-1 month')))
                ->orderBy('reviews', 'desc')
                ->limit(3)
                ->get();
        $posts = $author->posts()->with(['author', 'category', 'tags', 'comments'])->where('enable', 1)->paginate(6);

        return view('front.posts.author', [
            'categoriesWithHighestPriority' => $categoriesWithHighestPriority,
            'postCategories' => $postCategories,
            'postTags' => $postTags,
            'newestPosts' => $newestPosts,
            'author' => $author,
            'posts' => $posts,
            'postWithTheMostViews' => $postWithTheMostViews
        ]);
    }

    public function search(Request $request) {

        $formData = $request->validate([
            'value' => ['required', 'string', 'min:1']
        ]);

        $posts = Post::query()
                ->withCount('author', 'category', 'tags', 'comments')
                ->where('title', 'LIKE', '%' . $formData['value'] . '%')
                ->orWhere('shortDescription', 'LIKE', '%' . $formData['value'] . '%')
                ->orWhere('mainContent', 'LIKE', '%' . $formData['value'] . '%')
                ->paginate(6);



        $posts->appends($formData);

        $categoriesWithHighestPriority = PostCategory::query()
                ->orderBy('priority', 'desc')
                ->take(4)
                ->get();
        $postCategories = PostCategory::query()
                ->withCount(['posts'])
                ->orderBy('priority', 'desc')
                ->get();
        $postTags = PostTags::all();
        $postWithTheMostViews = Post::query()
                ->where('created_at', '>=', date('Y-m-d H:i:s', strtotime('-1 month')))
                ->orderBy('reviews', 'desc')
                ->limit(3)
                ->get();
        $newestPosts = Post::query()
                ->orderBy('created_at', 'desc')
                ->take(3)
                ->get();



        return view('front.posts.search', [
            'categoriesWithHighestPriority' => $categoriesWithHighestPriority,
            'postCategories' => $postCategories,
            'postTags' => $postTags,
            'newestPosts' => $newestPosts,
            'value' => $formData['value'],
            'posts' => $posts,
            'postWithTheMostViews' => $postWithTheMostViews
        ]);
    }

    public function leaveComment(Request $request) {
        $formData = $request->validate([
            'name_of_visitor' => ['nullable', 'string', 'min:3'],
            'email_of_visitor' => ['nullable', 'email'],
            'content' => ['required', 'string', 'min:2'],
            'post_id' => ['required', 'numeric', 'exists:posts,id']
        ]);

        $comment = new Comment();


        $comment->fill($formData);

        $comment->save();



        return response()->json([
                    'success_message' => 'You added comment successfully!'
        ]);
    }

    public function incrementViews(Request $request) {
        $formData = $request->validate([
            'post_id' => ['required', 'numeric', 'exists:posts,id']
        ]);

        $post = Post::findOrFail($formData['post_id']);

        $post->reviews++;

        $post->save();
        return response()->json([
                    'success_message' => 'sve je odradjeno'
        ]);
    }

}
