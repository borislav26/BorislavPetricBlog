<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PostTags;

class PostTagsController extends Controller {

    public function index() {
        $postTags = PostTags::all();
        return view('admin.post_tags.index', [
            'postTags' => $postTags
        ]);
    }

    public function add() {

        return view('admin.post_tags.add');
    }

    public function insert(Request $request) {

        $formData = $request->validate([
            'name' => ['required', 'string', 'min:3'],
        ]);

        $tag = new PostTags();

        $tag->fill($formData);


        $tag->save();

        return redirect()->route('admin.post_tags.index');
    }

    public function edit(PostTags $tag) {
        return view('admin.post_tags.edit', [
            'tag' => $tag
        ]);
    }

    public function update(Request $request, PostTags $tag) {
        $formData = $request->validate([
            'name' => ['required', 'string', 'min:3'],
        ]);



        $tag->fill($formData);

        $tag->save();


        return redirect()->route('admin.post_tags.index');
    }

    public function delete(Request $request) {
        $formData = $request->validate([
            'tag_id' => ['required', 'numeric', 'exists:post_tags,id']
        ]);

        $tag = PostTags::findOrFail($formData['tag_id']);

        $tag->posts()->sync([]);
        $tag->delete();

        return redirect()->route('admin.post_tags.index');
    }

    public function tableContent() {
        $query = PostTags::query();
        $dataTable = \DataTables::of($query);

        $dataTable->addColumn('actions', function($tag) {
            return view('admin.post_tags.partials.actions',[
                'tag'=>$tag
            ]);
        })
        ->rawColumns(['actions']);

        return $dataTable->make(true);
    }

}
