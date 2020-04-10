<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;

class UsersController extends Controller {

    public function index() {

        $authors = User::all();
        return view('admin.authors.index', [
            'authors' => $authors
        ]);
    }

    public function add() {

        return view('admin.authors.add');
    }

    public function edit(User $author) {
       
        return view('admin.authors.edit', [
            'author' => $author
        ]);
    }

    public function insert(Request $request) {

        $formData = $request->validate([
            'name' => ['required', 'string', 'min:3', 'max:40'],
            'email' => ['required', 'string'],
            'phone_number' => ['nullable', 'string', 'max:30'],
            'image' => ['nullable', 'file', 'image', 'max:51200'],
        ]);

        $author = new User();
        
        $author->fill($formData);
        
        $author->password=\Hash::make('trenerka');
        $author->save();

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = $author->id . '_' . $file->getClientOriginalName();

            $file->move(public_path('/storage/authors/'), $fileName);

            $author->image = $fileName;

            $author->save();

            \Image::make(public_path('/storage/authors/' . $author->image))
                    ->fit(256, 256)
                    ->save(public_path('/storage/authors/thumbs' . $author->image));
        }
        session()->flash(
            'session_message','You have added new user successfully!'
        );
        return redirect()->route('admin.authors.index');
    }

    public function update(Request $request, User $author) {

        $formData = $request->validate([
            'name' => ['required', 'string', 'min:3', 'max:40'],
            'email' => ['required', 'string'],
            'phone_number' => ['nullable', 'string', 'max:30'],
            'image' => ['nullable', 'file', 'image', 'max:51200'],
        ]);



        $author->fill($formData);

        $author->save();

        if ($request->hasFile('image')) {
            $author->deletePhoto();
            $author->deleteThumbPhoto();
            $file = $request->file('image');
            $fileName = $author->id . '_' . $file->getClientOriginalName();

            $file->move(public_path('/storage/authors/'), $fileName);


            $author->image = $fileName;

            $author->save();

            \Image::make(public_path('/storage/authors/' . $author->image))
                    ->fit(256, 256)
                    ->save(public_path('/storage/authors/thumbs' . $author->image));
        }
        session()->flash(
            'session_message','You have updated user successfully!'
        );
        return redirect()->route('admin.authors.index');
    }

    public function delete(Request $request) {
        $formData = $request->validate([
            'author_id' => ['required', 'numeric', 'exists:users,id']
        ]);

        $author = User::findOrFail($formData['author_id']);

        if (\Auth::user()->role_id != 1) {
            return redirect()->route('admin.index.index');
        }
        $author->deletePhoto();
        $author->deleteThumbPhoto();
        $author->delete();

        return response()->json([
            'success_message'=>'You have deleted user successfully'
        ]);
    }

    public function tableContent() {

        $query = User::query();
        $dataTable = \DataTables::of($query);

        $dataTable->addColumn('image', function($author) {
                    return view('admin.authors.partials.user_image', [
                        'author' => $author
                    ]);
                })->addColumn('ban', function($author) {
                    return view('admin.authors.partials.ban_button', [
                        'author' => $author
                    ]);
                })->addColumn('actions', function($author) {
                    return view('admin.authors.partials.actions', [
                        'author' => $author
                    ]);
                })
                ->rawColumns(['image', 'actions', 'ban']);

        return $dataTable->make(true);
    }

    public function ban(Request $request) {

        $formData = $request->validate([
            'author_id' => ['required', 'numeric', 'exists:users,id']
        ]);

        $author = User::findOrFail($formData['author_id']);


        $author->ban = 0;
        $author->save();
        return response()->json([
                    'success_message' => 'The user is not banned anymore'
        ]);
    }

    public function notBan(Request $request) {

        $formData = $request->validate([
            'author_id' => ['required', 'numeric', 'exists:users,id']
        ]);

        $author = User::findOrFail($formData['author_id']);


        $author->ban = 1;
        $author->save();
        return response()->json([
                    'success_message' => 'The user has been banned'
        ]);
    }

}
