<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Post;
use App\Type;
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
    //Thêm truyện
    public function create() {
        $types = Type::all();
        return view('backend.post.create', compact('types'));
    }

    public function postCreate(Request $request) {
        $post = new Post();
        $post->title = $request->title;
        $post->short_content = $request->short_content;
        $post->content = $request->content_;
        $post->type = $request->type;
        $post->user_id = Auth::id();
        $request->status == '1' || $request->status == 1 ? $post->status = 1 : $post->status = 0;
        $post->save();
        return redirect(route('post'))->with('mes', 'Đã thêm truyện...');
    }

    //Sửa truyện
    public function edit($id) {
        $types = Type::all();
        $post = Post::find($id);
        return view('backend.post.edit', compact('types', 'post'));
    }

    public function postEdit($id, Request $request) {
        $post = Post::find($id);
        $post->title = $request->title;
        $post->short_content = $request->short_content;
        $post->content = $request->content_;
        $post->type = $request->type;
        $post->user_id = Auth::id();
        $request->status == '1' || $request->status == 1 ? $post->status = 1 : $post->status = 0;
        $post->save();
        return redirect(route('post'))->with('mes', 'Đã sửa truyện...');
    }

    //xóa truyện
    public function delete($id) {
        $post = Post::find($id);
        $post->delete();
        return redirect(route('post'))->with('mes', 'Đã xóa truyện...');
    }

    public function ajaxEditShortContent(Request $request) {
        $id = $request->id;
        $short_content = $request->short_content;
        $post = Post::find($id);
        $post->short_content = $short_content;
        $post->save();
        return $post;
    }

    public function ajaxEditContent(Request $request) {
        $id = $request->id;
        $content = $request->content_;
        $post = Post::find($id);
        $post->content = $content;
        $post->save();
        return $post;
    }

    public function ajaxEditStatus(Request $request) {
        $id = $request->id;
        $status = $request->status;
        $post = Post::find($id);
        $post->status = $status;
        $post->save();
        return $post;
    }
}
