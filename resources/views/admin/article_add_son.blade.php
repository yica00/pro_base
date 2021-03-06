@extends('admin.base')
@section('content')
    <script>
        $('#left-bar .nav>li:nth-child(4)>.menu').addClass('on');
    </script>

    <h3 style="float: right;margin-top: 2%"><a href="@if( $id == 0 )
                /admin/article
              @else
                /article/{{ $id }}/look
               @endif">返回上级</a></h3>

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

                        <h3>新增栏目</h3>
                        <form class="form-horizontal" role="form" method="POST" action="/article/add_son/{{ $id }}" enctype="multipart/form-data" >
                            {{csrf_field()}}
                            <input value="{{ $id }}" name="pid" style="display: none" >
                            <div class="form-group">
                                <label for="email" class="col-md-3 control-label">栏目名字</label>
                                <div class="col-md-8">
                                    <input id="email" class="form-control" name="title"   autofocus>
                                </div>
                            </div>

                            <div class="form-group"></label>
                                <label for="email" class="col-md-3 control-label">缩略图</label>
                                <div class="col-md-8">
                                    <input id="email" type="file"  class="form-control" name="thumbnail" autofocus>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="email" class="col-md-3 control-label">排序号</label>
                                <div class="col-md-8">
                                    <span>默认排序时，数字越大商品越靠前</span>
                                    <input id="email"  class="form-control" name="serial_number" value="0"  autofocus>
                                </div>
                            </div>

                            <div class="form-group"></label>
                                <label for="email" class="col-md-3 control-label">正文图片</label>
                                <div class="col-md-8">
                                    <input id="email" type="file"  class="form-control" name="imgs[]" multiple autofocus>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="email" class="col-md-3 control-label">正文文字</label>
                                <div class="col-md-8">
                                    {{--<span style="color: red">多个规格之间请用英文逗号隔开</span>--}}
                                    <textarea class="form-control" rows="10" name="text" ></textarea>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="email" class="col-md-3 control-label">是否导航</label>
                                <div class="col-md-8">
                                    <select name="is_nav" id="email">
                                        <option value ="0" >不</option>
                                        <option value ="1" >导航</option>
                                    </select>
                                </div>
                            </div>

                            {{--</div>--}}

                            <div class="form-group">
                                <div class="col-md-8 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        添加
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection