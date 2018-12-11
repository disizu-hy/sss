<!DOCTYPE html>
<html>

    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
   <link href="{{asset('admin')}}/css/icheck_skins/all.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{asset('admin')}}/css/bootstrap-fileupload.css" />
        <link href="{{asset('fenye')}}/add.css" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="{{asset('admin')}}/css/tabs.css" />
        <link rel="stylesheet" href="{{asset('admin')}}/css/layout.css" />
        <link rel="stylesheet" href="{{asset('admin')}}/css/bootstrap.css" />
        <link rel="stylesheet" href="{{asset('admin')}}/css/table.css"  />
                <link rel="stylesheet" href="{{asset('admin')}}/css/font-awesome.css" />
    <style>
        .item_content ul {
            list-style: none;
        }

            .item_content ul li {
                width: 370px;
                height: 430px;
                float: left;
                margin-right: 30px;
            }
    </style>
    <body>
            <ul class="tabs" style="background-color: #faf3f3">
                <li class="current">
                    <a href="javascript:void(0)" id="#tab1">咨询管理</a>
                </li>
                <li>
                    <a href="javascript:void(0)" id="#tab2">添加咨询</a>
                </li>
            </ul>
            <div class="tabs_content" style="">
                <div id="tab1" style="display: block;">
                    <table id="tbRecord">
                        <thead>
                        <form action="{{url('consultshow')}}" method="post">
    <tr>
                           <td colspan="5">
                               <input type="submit" value="查询" class="btn" >
                               <input type="text" placeholder="请输入标题" name="con_titil" style="margin-top:13px;">
                           </td>
                        </tr>
                        </form>
                            <tr>
                            <th>选择</th>
                                <th>id</th>
<!--                                <th style="display: none;">是否警用</th> -->
                                <th>分类</th>
                                <th>标题</th>
                                <th>添加时间</th>
                                <th>状态</th>
                                <th>内容</th>
                                <th>操作</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                         @if(isset($data))
                            @foreach($data as $v)
                            <tr>
                                <td><input type="checkbox" value="{{$v->id}}" name="box"></td>
                                <td>{{$v->id}}</td>
                                <td>@if($v->type_status==1)新闻@elseif($v->type_status==2)公告@else产品 @endif</td>
                                <td>{{$v->con_titil}}</td>
                                <td>{{$v->con_date}}</td>
                                <td>@if($v->con_status==1)显示@else不现实@endif</td>
                                <td>{{$v->con_text}}</td>

                                <td><a href="consult_del?id={{$v->id}}" class="btn btn-danger"><i class="icon-trash" style="margin-right:3px">&nbsp;&nbsp;删除</i></a></td>
                            </tr>
                            @endforeach
                        @endif

                        @if(isset($info))
                            @foreach($info as $v)
                            <tr>
                                <td><input type="checkbox" value="{{$v->id}}" name="box"></td>
                                <td>{{$v->id}}</td>
                                <td>@if($v->type_status==1)新闻@elseif($v->type_status==2)公告@else产品 @endif</td>
                                <td>{{$v->con_titil}}</td>
                                <td>{{$v->con_date}}</td>
                                <td>@if($v->con_status==1)显示@else不现实@endif</td>
                                <td>{{$v->con_text}}</td>

                                <td><a href="consult_del?id={{$v->id}}" class="btn btn-danger"><i class="icon-trash" style="margin-right:3px">&nbsp;&nbsp;删除</i></a></td>
                            </tr>
                            @endforeach
                        @endif
                

                        </tbody>
                        <tr>
                        @if(!isset($info))
                        <td id="pull_right"colspan="8">{{$data->render('page')}}</td>
                        @endif
                              </tr>
                               <tr>
          <td align="left" colspan="9"><input type="button" class="btn" value="全选" id="all">  
         <input type="button" class="btn" value="反选" id="fan">
         <a href="" name="checkall" id="notall" class="btn">取消</a>
          <a href="#" name="del" id="del" class="btn">批量删除</a></td>
     </tr>
                    </table>
                </div>
                
                <div id="tab2" style="display: none; ">
                    <div class="item_container" style="">
                        <div class="item_content" style="overflow: auto; padding: 0px;">
                            <form action="{{url('consult_add')}}" method="post">
                                <fieldset style="">
                                    <legend></legend>
                                    <div class="control-group">
                                        <!-- Text input-->
                                        <label class="control-label" for="input01">
                                分类</label>
                                        <div class="controls">
                                            <input type="radio" name="type_status" value="1">新闻
                                            <input type="radio" name="type_status" value="2">公告
                                            <input type="radio" name="type_status"  value="3">产品
                                           

                                        </div>
                                    </div>
                                    <br>
                                    <div class="control-group">
                                        <!-- Text input-->
                                        <label class="control-label" for="input01">
                                标题</label>
                                        <div class="controls">
                                            <input class="input-xlarge" data-val="true" data-val-required="标题名称不能为空" id="ArticleName" name="con_titil" placeholder="标题名称" type="text" value="" autocomplete="Off">
                                            <span class="field-validation-valid" data-valmsg-for="ArticleName" data-valmsg-replace="true"></span>

                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <!-- Text input-->
                                        <label class="control-label" for="input01">

                                状态</label>
                                    <input type="radio" name="con_status" value="1">显示
                                    <input type="radio" name="con_status" value="2">不显示 
                                        </div>
                                    </div>
                                        <div class="control-group">
                                        <!-- Text input-->
                                        <label class="control-label" for="input01">
                                文章内容</label>
                <div class="controls">
        <script type="text/javascript" charset="utf-8" src="{{asset('ueditor')}}/ueditor.config.js"></script>
    <script type="text/javascript" charset="utf-8" src="{{asset('ueditor')}}/ueditor.all.min.js"> </script>
    <script type="text/javascript" charset="utf-8" src="{{asset('ueditor')}}/lang/zh-cn/zh-cn.js"></script>
    <textarea name="con_text" id="editor" cols="30" rows="10" id="editor"  type="text/plain" style="width:800px;height:300px;"></textarea>
<script type="text/javascript">
    var ue = UE.getEditor('editor');
</script>
                                        </div>
                                    </div>
                                        <input type="submit" value="提交" class="btn btn-primary">
                                    </div>
                                </fieldset>
                            </form>
                        </div>
                    </div>
                </div>
    <script type="text/javascript" src="{{asset('admin')}}/js/jquery-1.8.3.min.js"></script>
        <script src="{{asset('admin')}}/js/bootstrap/bootstrap-fileupload.js"></script>
\
        <script>
            $(function() {
                /*菜单设置*/
                /*选项卡设置*/
                $('.tabs a').click(function(e) {
                    e.preventDefault();
                    if($(this).closest("li").attr("class") == "current") {
                        return;
                    } else {
                        $(".tabs_content").find("[id^='tab']").hide();
                        $(".tabs li").attr("class", "");
                        $(this).parent().attr("class", "current");
                        $($(this).attr('id')).fadeIn();
                        if(tabSelect) {
                            tabSelect($(this));
                        }
                    }
                });

            })
        </script>
    
        </div> 
    </body>

</html>