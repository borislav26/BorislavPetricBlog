<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;

class UsersController extends Controller {

    public function index() {
        $authors = User::all();
        return view('admin.users.index', [
            'authors' => $authors
        ]);
    }

    public function tableContent() {
        $query = User::query();
        $dataTable = \DataTables::of($query);

        $dataTable->addColumn('image', function($user) {
                    return view('admin.users.partials.user_image', [
                        'author' => $user
                    ]);
                })->addColumn('ban', function($user) {
                    return view('admin.users.partials.ban_button', [
                        'author' => $user
                    ]);
                })->addColumn('actions', function($user) {
                    return view('admin.users.partials.actions', [
                        'author' => $user
                    ]);
                })
                ->rawColumns(['image', 'actions', 'ban']);

        return $dataTable->make(true);
    }

}
