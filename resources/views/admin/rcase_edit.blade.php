@extends('admin.base')
@section('content')
    <script>
        $('#left-bar .nav>li:nth-child(4)>.menu').addClass('on');
    </script>


    <div class="main-wrap fadeInRight">
        <div class="row">
            <div class="col-md-10 col-md-offset-0">
                <div class="panel panel-default">
                    <div class="panel-body">
                        @if (count($errors) > 0)
                            <div style="color: red">
                                <ul>
                                    @if( is_object($errors) )
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    @else
                                        {{ $errors }}
                                    @endif
                                </ul>
                            </div>
                        @endif

                        <h3>新增案例</h3>
                        <form class="form-horizontal" role="form" method="POST" action="/admin/rcase/{{  $rcase->id }}" enctype="multipart/form-data"  >
                            {{csrf_field()}}
                            <input type="hidden" name="_method" value="PUT">
                            <div class="form-group">
                                <label for="email" class="col-md-2 control-label">案例名</label>
                                <div class="col-md-10">
                                    <input id="email" class="form-control" name="title" value="{{$rcase->title}}"  autofocus>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="email" class="col-md-2 control-label">缩略图</label>
                                <div class="col-md-10">
                                    <input id="email" type="file"  class="form-control" name="thumbnail" autofocus>
                                    <img src="{{$rcase->thumbnail}}" width="200px" />
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="email" class="col-md-2 control-label">类型</label>
                                <div class="col-md-10">
                                    <select name="cate" id="email" style="width:200px;" >
                                        <option value ="1"  @if($rcase->cate == 1  ) selected @endif  >老师作品</option>
                                        <option value ="2"  @if($rcase->cate == 2  ) selected @endif   >学生作品</option>
                                    </select>
                                    <p style="color:red;">如果是学生作品就不用选择老师，正文部分必须填写，且必须选择案例类型</p>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="email" class="col-md-2 control-label">作者</label>
                                <div class="col-md-10">
                                    <select name="team_id" id="email" style="width:200px;" >
                                        @foreach( $teams as $stor )
                                            <option value ="{{ $stor->id }}" @if($stor->id == $rcase->team_id  ) selected @endif >{{ $stor->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <p></p>
                            </div>


                            {{--<div class="form-group">--}}
                                {{--<label for="email" class="col-md-2 control-label">房间类型</label>--}}
                                {{--<div class="col-md-10">--}}
                                    {{--<select name="house_id" id="email" style="width:200px;" >--}}
                                        {{--@foreach( $houses as $stor )--}}
                                            {{--<option value ="{{ $stor->id }}" @if($stor->id == $rcase->house_id  ) selected @endif >{{ $stor->title }}</option>--}}
                                        {{--@endforeach--}}
                                    {{--</select>--}}
                                {{--</div>--}}
                            {{--</div>--}}

                            <div class="form-group">
                                <label for="email" class="col-md-2 control-label">案例类型</label>
                                <div class="col-md-10">
                                    <select name="style_id" id="email"  style="width:200px;">
                                        @foreach( $styles as $stor )
                                            <option value ="{{ $stor->id }}" @if($stor->id == $rcase->style_id  ) selected @endif >{{ $stor->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div id="comtent" style="display:none;" ><?php echo  html_entity_decode($rcase->comtent) ?></div>
                            <div class="form-group" >
                                <label for="email" class="col-md-2 control-label">详情</label>
                                <!-- 加载编辑器的容器 -->
                                <div class="col-md-10">
                                <script id="container" name="comtent" type="text/plain">
                                </script>
                                <!-- 配置文件 -->
                                <script type="text/javascript" src="/akl/Ueditor/ueditor.config.js"></script>
                                <!-- 编辑器源码文件 -->
                                <script type="text/javascript" src="/akl/Ueditor/ueditor.all.js"></script>
                                <!-- 实例化编辑器 -->
                                <script type="text/javascript">
                                    var ue = UE.getEditor('container', {
                                        autoHeightEnabled: true,
                                        autoFloatEnabled: true,
                                        initialFrameWidth : 900,
                                        initialFrameHeight: 400
                                    });
                                    ue.ready(function() {
                                        ue.setContent($('#comtent').html());
                                    });
                                </script>
                                </div>
                            </div>


                            <div class="form-group">
                                <div class="col-md-8 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        修改
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>

@endsection