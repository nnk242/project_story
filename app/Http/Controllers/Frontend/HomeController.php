<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Post;
use App\Type;

class HomeController extends Controller
{
    //
    public function index() {
        $posts = Post::with('User')->orderBy('created_at', 'DESC')->get();
        $types = Type::all();
//        $tops =
        return view('frontend.index', compact('posts', 'types'));
    }
    public function story($title) {
        return view('');
    }
}
