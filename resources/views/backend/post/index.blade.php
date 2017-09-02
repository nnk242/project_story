@extends('layouts.app')
<?php
$role_admin = 1;
$role_leader = 2;
$role_bus = 3;
?>

@section('css')
    <style>
        .onoffswitch {
            position: relative; width: 50px;
            -webkit-user-select:none; -moz-user-select:none; -ms-user-select: none;
        }
        .onoffswitch-checkbox {
            display: none;
        }
        .onoffswitch-label {
            display: block; overflow: hidden; cursor: pointer;
            border: 2px solid #E3E3E3; border-radius: 19px;
        }
        .onoffswitch-inner {
            display: block; width: 200%; margin-left: -100%;
            transition: margin 0.3s ease-in 0s;
        }
        .onoffswitch-inner:before, .onoffswitch-inner:after {
            display: block; float: left; width: 50%; height: 26px; padding: 0; line-height: 26px;
            font-size: 10px; color: white; font-family: Trebuchet, Arial, sans-serif; font-weight: bold;
            box-sizing: border-box;
        }
        .onoffswitch-inner:before {
            content: "";
            padding-left: 5px;
            background-color: #FFFFFF; color: #FFFFFF;
        }
        .onoffswitch-inner:after {
            content: "";
            padding-right: 5px;
            background-color: #FFFFFF; color: #666666;
            text-align: right;
        }
        .onoffswitch-switch {
            display: block; width: 21px; margin: 2.5px;
            background: #A1A1A1;
            position: absolute; top: 0; bottom: 0;
            right: 20px;
            border: 2px solid #E3E3E3; border-radius: 19px;
            transition: all 0.3s ease-in 0s;
        }
        .onoffswitch-checkbox:checked + .onoffswitch-label .onoffswitch-inner {
            margin-left: 0;
        }
        .onoffswitch-checkbox:checked + .onoffswitch-label .onoffswitch-switch {
            right: 0px;
            background-color: #27A1CA;
        }
    </style>
@endsection

@section('content')
    <div class="col-md-2 col-sm-2">
        <a href="{{route('post.create')}}">
            <button class="btn btn-success"><span class="fa fa-plus"></span>&nbsp;&nbsp;Thêm truyện</button>
        </a>
        <div class="form-group">
            <h5>@if(\Illuminate\Support\Facades\Auth::id() == $role_admin || \Illuminate\Support\Facades\Auth::id() == $role_leader) Có tất cả: <span style="color: pink"> {{$posts->total()}}</span></h5>
            <h5>Bạn có tất cả:<span style="color: pink"> {{(\App\Post::where('user_id', \Illuminate\Support\Facades\Auth::id())->count())}}</span></h5>@endif
        </div>
    </div>
    <div class="col-md-10 col-sm-10 col-xs-12">
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
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($posts as $key=>$post)
                        <tr id="{{$post->id}}" class="selected-page">
                            <td>{{$key+1}}</td>
                            <td>{{ str_limit($post->title, $limit = 100, $end='...') }}</td>
                            <td>{!! $post->Type()->first()->name !!}</td>
                            <td id="content-after-create-{{$post->id}}" data-toggle="modal" data-target="#myModal-content-{{$key}}" title="Ấn để sửa..." style="cursor: pointer;">{!! str_limit($post->content, $limit = 100, $end = '...') !!}</td>
                            <td id="short-content-after-create-{{$post->id}}" data-toggle="modal" data-target="#myModal-short-content-{{$key}}" title="Ấn để sửa..." style="cursor: pointer;">{!! str_limit($post->short_content, $limit=100, $end = '...') !!}</td>
                            @if(\Illuminate\Support\Facades\Auth::id() == $role_admin || \Illuminate\Support\Facades\Auth::id() == $role_leader)
                                <td>@foreach(App\User::select('name')->where('id', \Illuminate\Support\Facades\Auth::id())->get() as $val) {{$val->name}} @endforeach</td>
                            @endif
                            <td>
                                <div class="onoffswitch">
                                    <input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" id="myonoffswitch-{{$key}}" {{$post->status == 1? 'checked':''}}>
                                    <label class="onoffswitch-label" for="myonoffswitch-{{$key}}">
                                        <span class="onoffswitch-inner"></span>
                                        <span class="onoffswitch-switch"></span>
                                    </label>
                                </div>
                            </td>
                            <td>{{ $post->created_at }}</td>
                        </tr>
                        <!-- Modal content-->
                        <div class="modal fade" id="myModal-content-{{$key}}" role="dialog">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content aj-form-page">
                                    <form>
                                        {{csrf_field()}}
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            <h4 class="modal-title">Sửa Nội dung</h4>
                                        </div>
                                        <div class="modal-body">
                                            <textarea class="aj-text-page" name="content" id="content-{{$key}}">{!! ($post->content) !!}</textarea>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" data-id="{{$post->id}}" class="btn btn-default sm-content-page">Thay đổi</button>
                                            <button type="button" class="btn btn-success" data-dismiss="modal">Quay lại</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- Modal short content-->
                        <div class="modal fade" id="myModal-short-content-{{$key}}" role="dialog">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content aj-form-page">
                                    <form>
                                        {{csrf_field()}}
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            <h4 class="modal-title">Sửa Nội dung ngắn</h4>
                                        </div>
                                        <div class="modal-body">
                                            <textarea class="aj-text-page" name="short-content" id="short-content-{{$key}}">{!! ($post->short_content) !!}</textarea>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit"  data-id="{{$post->id}}" class="btn btn-default sm-short-content-page">Thay đổi</button>
                                            <button type="button" class="btn btn-success" data-dismiss="modal">Quay lại</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>


@endsection

@section('js')
    <script type="text/javascript">
        for(var i= 0; i < $('.selected-page').length; i++) {
            CKEDITOR.replace('content-' + i);
            CKEDITOR.replace('short-content-' + i);
        }
//short text
        function TruncateText(text)
        {
            if(text.length > 100)
            {
                text = text.substring(0, 100) + "...";
            }
            return text;
        }
//short content
        $(document).ready(function () {
            $('.sm-short-content-page').click(function () {
                var get_id_ckeditor = $(this).closest('.aj-form-page').find('.aj-text-page').attr('id');
                var id = $(this).data('id');
                var short_content = CKEDITOR.instances[get_id_ckeditor].getData();
                $.ajax({
                    type:'POST',
                    url: '{{ route('ajax.createShortContent') }}',
                    data: {"_token": "{{ csrf_token() }}",
                        'id':id,
                        'short_content':short_content},
                    dataType:'JSON',
                    success: function (rsp) {
                        alert('Cập nhật truyện thành công!');
                        $('#short-content-after-create-'+ rsp.id).empty();
                        $('#short-content-after-create-'+ rsp.id).append(TruncateText(rsp.short_content));
                    }
                })
            })
        });

        //content
        $(document).ready(function () {
            $('.sm-content-page').click(function () {
                var get_id_ckeditor = $(this).closest('.aj-form-page').find('.aj-text-page').attr('id');
                var id = $(this).data('id');
                var content = CKEDITOR.instances[get_id_ckeditor].getData();
                $.ajax({
                    type:'POST',
                    url: '{{ route('ajax.createContent') }}',
                    data: {"_token": "{{ csrf_token() }}",
                        'id':id,
                        'content_':content},
                    dataType:'JSON',
                    success: function (rsp) {
                        alert('Cập nhật truyện thành công!');
                        $('#content-after-create-'+ rsp.id).empty();
                        $('#content-after-create-'+ rsp.id).append(TruncateText(rsp.content));
                    }
                })
            })
        });
    </script>
@endsection