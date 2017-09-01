@extends('layouts.app')
<?php
$role_admin = 1;
$role_leader = 2;
$role_bus = 3;
?>

@section('content')
    <div class="col-md-3 col-sm-3">
        <a href="{{route('post.create')}}">
            <button class="btn btn-success"><span class="fa fa-plus"></span>&nbsp;&nbsp;Thêm truyện</button>
        </a>
        <div class="form-group">
            <h5>@if(\Illuminate\Support\Facades\Auth::id() == $role_admin || \Illuminate\Support\Facades\Auth::id() == $role_leader)
                    Bạn có @else Có @endif tất cả &nbsp; <span style="color: pink">{{count($posts)}}</span></h5>
        </div>
    </div>
    <div class="col-md-9 col-sm-9 col-xs-12">
        <div class="x_panel tile fixed_height_320 widget-custom-padding">
            <div class="content">
                <h4>Tất cả các bài viết.</h4>
            </div>
            <div class="content">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th>STT</th>
                        <th>Tiêu đề</th>
                        <th>Thể loại</th>
                        <th>Nội dung</th>
                        <th>Nội dung ngắn</th>
                        @if(\Illuminate\Support\Facades\Auth::id() == $role_admin || \Illuminate\Support\Facades\Auth::id() == $role_leader)
                            <th>Tác giả</th>
                        @endif
                        <th>Trạng thái</th>
                        <th>Ngày đăng</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($posts as $key=>$post)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>{{$post->title}}</td>
                            <td>{!! $post->type !!}</td>
                            <td>{!! $post->content !!}</td>
                            <td>{!! $post->short_content !!}</td>
                            @if(\Illuminate\Support\Facades\Auth::id() == $role_admin || \Illuminate\Support\Facades\Auth::id() == $role_leader)
                                <td>@foreach(App\User::select('name')->where('id', \Illuminate\Support\Facades\Auth::id())->get() as $val) {{$val->name}} @endforeach</td>
                            @endif
                            <td>{{ $post->status }}</td>
                            <td>{{ $post->created_at }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection