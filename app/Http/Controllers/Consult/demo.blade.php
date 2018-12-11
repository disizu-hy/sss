<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
 <?php header('Content-type:text/html;charset=utf8'); ?>
 <form action="{{url('consult_add')}}" method="get">
	    <script type="text/javascript" charset="utf-8" src="{{asset('ueditor')}}/ueditor.config.js"></script>
 }
    <script type="text/javascript" charset="utf-8" src="{{asset('ueditor')}}/ueditor.all.min.js"> </script>
    <script type="text/javascript" charset="utf-8" src="{{asset('ueditor')}}/lang/zh-cn/zh-cn.js"></script>
    <script id="editor" name="feiji" type="text/plain" style="width:800px;height:500px;">

    </script>
  
   
<script type="text/javascript">

    //实例化编辑器
    //建议使用工厂方法getEditor创建和引用编辑器实例，如果在某个闭包下引用该编辑器，直接调用UE.getEditor('editor')就能拿到相关的实例
    var ue = UE.getEditor('editor');
</script>
<input type="submit" value="提交">
</form>
</body>
</html>