<!DOCTYPE html>
<html>

	<head>
		<meta charset="UTF-8">
		<title></title>
	</head>
   <link href="{{asset('admin')}}/css/icheck_skins/all.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{asset('admin')}}/css/bootstrap-fileupload.css" />
    
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
					<a href="javascript:void(0)" id="#tab1">直播分类管理</a>
				</li>
				<li>
					<a href="javascript:void(0)" id="#tab2">添加直播分类</a>
				</li>
			</ul>
			<div class="tabs_content" style="">
				<div id="tab1" style="display: block;">
					<table id="tbRecord">
						<thead>
						<form action="{{url('videoshow')}}" method="post">

						<tr>
                           <td colspan="5">
                               <input type="submit" value="查询" class="btn" >
                               <input type="text" placeholder="请输入类名称" name="video_name" style="margin-top:13px;">
                           </td>
						</tr>
						</form>
							<tr>
							<th>选择</th>
								<th>id</th>
<!-- 								<th style="display: none;">是否警用</th> -->
								<th>分类名称</th>
								<th>直播图片</th>
								<th>父级id</th>
								<th>添加时间</th>
								<th>连接地址</th>
								<th>排序id</th>
								<th>操作</th>
								
							</tr>
						</thead>
						<tbody>
							@foreach($data as $v)
							<tr>
							    <td><input type="checkbox" value="{{$v->id}}" name="box"></td>
								<td>{{$v->id}}</td>
                                <td>@if(isset($v->level)){{{str_repeat('&nbsp;-',$v->level)}}}@endif
								{{$v->video_name}}</td>
								<td><img src="uploadss/{{$v->video_image}}" width="100" height="60px" alt=""></td>
								<td>{{$v->pid}}</td>
								<td>{{$v->video_date}}</td>
								<td>{{$v->video_link}}</td>
								<td>{{$v->sort}}</td>
								<td><a href="video_del?id={{$v->id}}" class="btn btn-danger"><i class="icon-trash" style="margin-right:3px">&nbsp;&nbsp;删除</i></a></td>
							</tr>
							@endforeach
						</tbody>
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
							<form action="{{url('video_add')}}" method="post" enctype="multipart/form-data">
								<fieldset style="">
									<legend></legend>
									<div class="control-group">
										<!-- Text input-->
										<label class="control-label" for="input01">
                                分类名称</label>
										<div class="controls">
											<input class="input-xlarge" data-val="true" data-val-required="分类名称不能为空" id="ArticleName" name="video_name" placeholder="分类名称" type="text" value="" autocomplete="Off">
											<span class="field-validation-valid" data-valmsg-for="ArticleName" data-valmsg-replace="true"></span>

										</div>
									</div>
									<div class="control-group">
										<!-- Text input-->
										<label class="control-label" for="input01">
                                直播图片</label>
										<div class="controls">
											<input type="file" name="video_image">
											<span class="field-validation-valid" data-valmsg-for="ArticleName" data-valmsg-replace="true"></span>

										</div>
									</div>
											<div class="control-group">
										<!-- Text input-->
										<label class="control-label" for="input01">
                                分类</label>
										<div class="controls">
										<select name="pid" id="">
                                         <option value="0">顶级分类</option>
                                         @foreach($data as $k => $v)
                                    <option value="{{$v->id}}"> @if(isset($v->level)){{{str_repeat('&nbsp;-',$v->level)}}}@endif{{$v->video_name}}</option>
                      @endforeach
										</select>
										</div>
									</div>
									<div class="control-group">
										<!-- Text input-->
										<label class="control-label" for="input01">
                                导航链接地址</label>
										<div class="controls">
											<input class="input-xlarge" data-val="true" data-val-required="链接地址不能为空" id="ArticleName" name="video_link" placeholder="链接地址" type="text" value="" autocomplete="Off">
											<span class="field-validation-valid" data-valmsg-for="ArticleName" data-valmsg-replace="true"></span>

										</div>
									</div>
									<div class="control-group">
										<!-- Text input-->
										<label class="control-label" for="input01">
                                排序</label>
										<div class="controls">
											<input class="input-xlarge" data-val="true" data-val-required="排序不能为空" id="ArticleName" name="sort" placeholder="排序" type="text" value="" autocomplete="Off">
											<span class="field-validation-valid" data-valmsg-for="ArticleName" data-valmsg-replace="true"></span>

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
 <script type="text/javascript" charset="utf-8" src="{{asset('admin')}}/js/kindeditor.js"></script>
  <script type="text/javascript">
    KE.show({
        id : 'content',
		resizeMode : 1,
        cssPath : './index.css',
        items : [
        'fontname', 'fontsize', 'textcolor', 'bgcolor', 'bold', 'italic', 'underline',
        'removeformat', 'justifyleft', 'justifycenter', 'justifyright', 'insertorderedlist',
        'insertunorderedlist', 'emoticons', 'image', 'link']
    });
  </script>
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
		<script>
$(function(){
  // 全选
  $("#all").click(function(){
    $("table input:checkbox").prop('checked',true);
  })
  // 取消全选
  $('#notall').click(function(){
    $('table input:checkbox').prop('checked',false);
  })
  // 反选
  $('#fan').click(function(){
    $('table input').each(function(){
      this.checked=!this.checked;
    })
  })
//批量删除
            $("#del").click(function(){
                var  box = $("input[name='box']");
                length =box.length;
//                alert(length);
                var str ="";
                for(var i=0;i<length;i++){
                    if(box[i].checked==true){
                        str =str+","+box[i].value;
                    }
                }
                str= str.substr(1);
//                alert(str)
                location.href="videodeletes?id="+str;
            })
          })

				</script>
		</div> 
	</body>

</html>