<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title></title>
    <link rel="stylesheet" href="{{asset('huy')}}/css/layout.css" />
    <link rel="stylesheet"  href="{{asset('huy')}}/css/tabs.css" />
    <link rel="stylesheet" href="{{asset('huy')}}/css/bootstrap.css" />
</head>

<body>
<ul class="tabs">
    <li class="current">
        <a href="javascript:void(0)" id="#tab1">个人中心</a>
    </li>
</ul>
<div class="tabs_content">
    <div id="tab1" style="display:block">
        <div class="bd">
            <ul>
                <li>
                    <div class="dform">
                        <fieldset>
                            <legend></legend>
                            <div class="control-group">
                                <!-- Text input-->
                                <label class="control-label" for="input01">
                                    用户名</label>
                                <div class="controls">
                                    admin
                                </div>
                            </div>
                            <div class="control-group">

                                <!-- Text input-->
                                <label class="control-label" for="input01">
                                    原始密码</label>
                                <div class="controls">
                                    <input type="password" class="input-xlarge" />
                                </div>
                            </div>
                            <div class="control-group">

                                <!-- Text input-->
                                <label class="control-label" for="input01">
                                    新密码</label>
                                <div class="controls">
                                    <input type="password" class="input-xlarge" />

                                </div>
                            </div>
                            <input type="button" value="提交" class="btn  btn-primary" />

                        </fieldset>

                    </div>

                </li>
            </ul>
        </div>

    </div>

</div>

</body>

</html>