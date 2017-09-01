@extends('layouts.app')

@section('content')
    <div class="col-md-3 col-sm-3">
        <a href="{{route('post.create')}}"><button class="btn btn-success"><span class="fa fa-plus"></span>&nbsp;&nbsp;Thêm truyện</button></a>
        <div class="form-group">
            <h5>Có tất cả &nbsp;</h5>
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
                        <th>Tác giả</th>
                        <th>Trạng thái</th>
                        <th>Ngày đăng</th>
                    </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection