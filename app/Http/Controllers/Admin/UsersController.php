<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;

class UsersController extends Controller {

    public function index() {
        if (\Auth::user()->role_id != 1) {
            return redirect()->route('admin.index.index');
        }
        $authors = User::all();
        return view('admin.authors.index', [
            'authors' => $authors
        ]);
    }

    public function add() {
        if (\Auth::user()->role_id != 1) {
            return redirect()->route('admin.index.index');
        }
        return view('admin.authors.add');
    }

    public function edit(User $autor) {
        if (\Auth::user()->role_id != 1) {
            return redirect()->route('admin.index.index');
        }
        return view('admin.authors.edit', [
            'author' => $autor
        ]);
    }

    public function insert(Request $request) {
        if (\Auth::user()->role_id != 1) {
            return redirect()->route('admin.index.index');
        }
        $formData = $request->validate([
            'name' => ['required', 'string', 'min:3', 'max:40'],
            'email' => ['required', 'string', 'max:20'],
            'phone_number' => ['required', 'string', 'max:30'],
            'image' => ['nullable', 'file', 'image', 'max:51200'],
        ]);

        $author = new User();

        $author->fill($formData);

        $author->save();

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = $author->id . '_' . $file->getClientOriginalName();

            $file->move(public_path('/storage/authors/', $fileName));

            $author->image = $fileName;

            $author->save();

            \Image::make(public_path('/storage/authors/', $author->image))
                    ->fit(200, 200)
                    ->save();
            \Image::make(public_path('/storage/authors/thumbs/', $author->image))
                    ->fit(256, 256)
                    ->save();
        }

        return redirect()->route('admin.authors.index');
    }

    public function update(Request $request, User $author) {
        if (\Auth::user()->role_id != 1) {
            return redirect()->route('admin.index.index');
        }
        $formData = $request->validate([
            'name' => ['required', 'string', 'min:3', 'max:40'],
            'email' => ['required', 'string', 'max:20'],
            'phone_number' => ['required', 'string', 'max:30'],
            'image' => ['nullable', 'file', 'image', 'max:51200'],
        ]);



        $author->fill($formData);

        $author->save();

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = $author->id . '_' . $file->getClientOriginalName();

            $file->move(public_path('/storage/authors/', $fileName));


            $author->image = $fileName;

            $author->save();

            \Image::make(public_path('/storage/authors/thumbs/', $author->image))
                    ->fit(256, 256)
                    ->save();
            \Image::make(public_path('/storage/authors/', $author->image))
                    ->fit(300, 300)
                    ->save();
        }

        return redirect()->route('admin.authors.index');
    }

    public function tableContent() {
        if (\Auth::user()->role_id != 1) {
            return redirect()->route('admin.index.index');
        }
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

}
