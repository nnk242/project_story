<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PostController extends Controller
{
    //
    public function index() {
        return view('backend.post.index');
    }

    public function create() {
        return view('backend.post.create');
    }
    public function postCreate(Request $request) {
        return $request->all();
    }
}
