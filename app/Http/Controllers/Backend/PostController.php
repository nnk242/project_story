<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Post;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    //
    public $role_admin = 1;
    public $role_leader = 2;
    public $role_bus = 3;


    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index() {
        $user_id = Auth::id();
        $role = User::where('id', $user_id)->pluck('role');

        if ($role[0] == $this->role_admin || $role[0] == $this->role_leader) {
            $posts = Post::with('Type')->orderBy('id','DESC')->paginate(10);
        } else {
            $posts = Post::with('Type')->orderBy('id','DESC')->where('user_id', $user_id)->paginate(10);
        }

        return view('backend.post.index', compact('posts'));
    }

    public function create() {
        return view('backend.post.create');
    }
    public function postCreate(Request $request) {
        return $request->all();
    }
}
