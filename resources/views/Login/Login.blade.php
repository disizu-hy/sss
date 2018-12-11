<!DOCTYPE html>
<html>

<!-- Head -->
<head>
    <title>登录表单</title>
    <!-- Meta-Tags -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">

    <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
    <!-- //Meta-Tags -->

    <!-- Style --> <link rel="stylesheet" href="{{asset('login')}}/css/style.css" type="text/css" media="all">
</head>
<!-- //Head -->
<!-- Body -->
<body>

<h1>登录表单</h1>

<div class="container w3layouts agileits">

    <div class="login w3layouts agileits">
        <h2>登 录</h2>
        <form action="{{url('land')}}" method="post">
            {{csrf_field()}}
            <input type="text" Name="tel" placeholder="手机号" required="required">
            <input type="password" Name="Password" placeholder="密码" required="required">

        <ul class="tick w3layouts agileits">
            <li>
                <input type="checkbox" id="brand1" value="">
                <label for="brand1"><span></span>记住我</label>
            </li>
        </ul>
        <div class="send-button w3layouts agileits">
            <form>
                <input type="submit" value="登 录">
            </form>
        </div>
        <a href="#">记住密码?</a>
        <div class="social-icons w3layouts agileits">
            <p>- 其他方式登录 -</p>
            <ul>
                <li class="qq"><a href="#">
                        <span class="icons w3layouts agileits"></span>
                        <span class="text w3layouts agileits">QQ</span></a></li>
                <li class="weixin w3ls"><a href="#">
                        <span class="icons w3layouts"></span>
                        <span class="text w3layouts agileits">微信</span></a></li>
                <li class="weibo aits"><a href="#">
                        <span class="icons agileits"></span>
                        <span class="text w3layouts agileits">微博</span></a></li>
                <div class="clear"> </div>
            </ul>
        </div>
        </form>
        <div class="clear"></div>
    </div>


    <div class="register w3layouts agileits">
        <h2>注 册</h2>
        <form action="{{url('register')}}" method="post">
            {{csrf_field()}}
            <input type="text" Name="tel" placeholder="手机号" required="required">
            <input type="text" Name="Email" placeholder="邮箱" required="required">
            <input type="password" Name="Password" placeholder="密码" required="required">
            <div class="send-button w3layouts agileits">
                <input type="submit" value="免费注册">
            </div>
        </form>

        <div class="clear"></div>
    </div>

    <div class="clear"></div>

</div>

<div class="footer w3layouts agileits">
    <p>Copyright &copy; More Templates</p>
</div>

</body>
<!-- //Body -->

</html>
