<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title></title>

    <head>

        <title>智旅通管理系统</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link href="{{asset('huy')}}/css/bootstrap-responsive.css" rel="stylesheet">
        <link href="{{asset('huy')}}/css/bootstrap.css" rel="stylesheet">
        <link href="{{asset('huy')}}/css/layout.css" rel="stylesheet">
        <link href="{{asset('huy')}}/css/menu.css" rel="stylesheet">
        <link href="{{asset('huy')}}/css/tabs.css" rel="stylesheet">
        <link rel="shortcut icon" href="images/favicon.png">
        <link href="{{asset('huy')}}/css/zy.all.css" rel="stylesheet">
        <link href="{{asset('huy')}}/css/pagerecord.css" rel="stylesheet">
        <link href="{{asset('huy')}}/css/table.css" rel="stylesheet">
        <link href="{{asset('huy')}}/css/font-awesome.css" rel="stylesheet">
        <link href="{{asset('huy')}}/css/jquery-ui-1.10.0.custom.css" rel="stylesheet" type="text/css">
        <link href="{{asset('huy')}}/css/images.css" rel="stylesheet">
        <link href="{{asset('huy')}}/css/csshake.min.css" rel="stylesheet">
        <style>
            .clock {
                margin-left: 280px;
                font-family: "Lato", sans-serif;
            }

            .clock div {
                margin-top: 100px;
                float: left;
                background: #ffe8e8;
                border-radius: 6px;
                width: 96px;
                height: 80px;
                line-height: 80px;
                text-align: center;
                font-size: 60px;
                margin: 0px 5px;
                color: #d96457;
            }
        </style>

        <link href="css/icheck_skins/all.css" rel="stylesheet">
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
        <script src="{{asset('huy')}}/js/jquery-1.8.3.min.js"></script>

        <script src="{{asset('huy')}}/js/bootstrap/bootstrap.min.js"></script>
        <script src="{{asset('huy')}}/js/jquery-ui-1.8.11.min.js" type="text/javascript"></script>
        <script src="{{asset('huy')}}/js/jquery.configuration.js" type="text/javascript"></script>
        <script type="text/javascript" src="{{asset('huy')}}/js/plugs/Jqueryplugs.js"></script>

        <script src="js/time.js"></script>
        <script>
            $(function() {
                /*菜单设置*/
                /*选项卡设置*/
                $(".tabs_content").find("[id^='tab']").hide();
                $(".tabs li:first").attr("class", "current");
                $(".tabs_content div:first").fadeIn();
            });
        </script>


    </head>
</head>

<body oncontextmenu="return false" onselectstart="return false" style="-moz-user-select: none; -webkit-user-select: none;">
<!--页面头部        开始-->
<div class="dvheader">
    <ul id="nav">
        <li id="user-panel" style="color: white;font-size: 22px;margin-top: 30px;">
             直播后台管理系统
        </li>

    </ul>
</div>
<!--页面头部        结束-->

<!---页面内容       开始-->
<div class="wrapper">

    <div class="sidebar">
        <!--动态加载页面对应菜单      开始-->
        <div class="menuItem menugrid">
            <div class="menu-head menuselect">
                <h2>商家信息设置</h2>
            </div>
            <ul class="menu-content" style="display: block;">
                <li>
                    <a href="{{url('/setup')}}" target="right">模块设置</a>
                </li>
                <li>
                    <a href="{{url('/css_setup')}}" target="right">样式模板设置</a>
                </li>
                <li>
                    <a href="{{url('/user_manager')}}" target="right">用户管理</a>
                </li>
                <li>
                    <a href="{{url('/adpicture')}}" target="right">轮播图管理</a>
                </li>
                <li>
                    <a href="{{url('/link')}}" target="right">友情链接</a>
                </li>

                <li>
                    <a  href="{{url('/updatepwd')}}"  target="right" >帮助中心</a>
                </li>

               <li>
                    <a href="{{url('navindex')}}" target="right">导航管理</a>
                </li>
                <li>
                    <a href="{{url('consultindex')}}" target="right">咨询管理</a>
                </li>
                <li>
                    <a href="{{url('videoindex')}}" target="right">直播分类管理</a>
                </li>
                <li>
                    <a  href="{{url('contactindex')}}"  target="right" >联系我们管理</a>
                </li>
                <li>
                    <a  href="login.html"  >退出</a>
                </li>
            </ul>
        </div>

        <!--动态加载页面对应菜单      结束-->
    </div>

    <div class="body" >
        <iframe src="{{asset('huy')}}/moduleSetting.html" border="none" width="100%" name="right" scrolling="no" height="1200px"></iframe>
    </div>
</div>
<!--页面内容        结束-->


</body>

</html>