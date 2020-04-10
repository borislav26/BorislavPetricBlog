<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Comment;

class CommentsController extends Controller {

    public function index() {

        $comments = Comment::query()
                ->with(['post'])
                ->orderBy('created_at', 'desc')
                ->get();
        return view('admin.comments.index', [
            'comments' => $comments
        ]);
    }

    public function disable(Request $request) {

        $formData = $request->validate([
            'comment_id' => ['required', 'numeric', 'exists:comments,id']
        ]);

        $comment = Comment::findOrFail($formData['comment_id']);


        $comment->enable = 0;
        $comment->save();
        return response()->json([
                    'success_message' => 'The comment has been disabled'
        ]);
    }

    public function enable(Request $request) {

        $formData = $request->validate([
            'comment_id' => ['required', 'numeric', 'exists:comments,id']
        ]);

        $comment = Comment::findOrFail($formData['comment_id']);


        $comment->enable = 1;
        $comment->save();
        return response()->json([
                    'success_message' => 'The comment has been enabled'
        ]);
    }

    public function tableContent() {

        $query = Comment::query();
        $dataTable = \DataTables::of($query);

        $dataTable->addColumn('author', function($comment) {
                    return $comment->name_of_visitor;
                })->addColumn('email', function($comment) {
                    return $comment->email_of_visitor;
                })->addColumn('content', function($comment) {
                    return $comment->content;
                })->addColumn('post_info', function($comment) {
                    return view('admin.comments.partials.post_info', [
                        'comment' => $comment
                    ]);
                })->addColumn('actions', function($comment) {
                    return view('admin.comments.partials.actions', [
                        'comment' => $comment
                    ]);
                })
                ->rawColumns(['post_info', 'actions']);

        return $dataTable->make(true);
    }

}
