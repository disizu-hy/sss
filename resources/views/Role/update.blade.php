<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title></title>
</head>
<link href="{{asset('huy')}}/css/icheck_skins/all.css" rel="stylesheet" />
<link rel="stylesheet" href="{{asset('huy')}}/css/bootstrap-fileupload.css" />

<link rel="stylesheet" href="{{asset('huy')}}/css/tabs.css" />
<link rel="stylesheet" href="{{asset('huy')}}/css/layout.css" />
<link rel="stylesheet" href="{{asset('huy')}}/css/bootstrap.css" />
<link rel="stylesheet" href="{{asset('huy')}}/css/table.css" />
<link rel="stylesheet" href="{{asset('huy')}}/css/font-awesome.css" />
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

    <li>
        <a href="javascript:void(0)" id="#tab2">修改用户</a>
    </li>
</ul>
<div class="tabs_content" style="">

    <div id="tab2" style="display: none; ">
        <div class="item_container" style="">
            <div class="item_content" style="overflow: auto; padding: 0px;">
                <div class="bd">
                    <ul>
                        <li>
                            <div class="dform">
                                <fieldset>
                                    <legend>修改用户</legend>
                                    <form action="{{url('/roleupdatee')}}" method="post">
                                        {{csrf_field()}}
                                        <input type="hidden" name="id" value="{{$list['id']}}">
                                        <div class="control-group">

                                            <!-- Text input-->
                                            <label class="control-label" for="input01">
                                                姓名</label>
                                            <div class="controls">
                                                <input type="text" name="name" class="input-xlarge" value="{{$list['name']}}" />
                                            </div>
                                        </div>

                                            <input type="submit" value="修改" class="btn  btn-primary" />

                                    </form>

                                </fieldset>

                            </div>

                        </li>
                    </ul>
                </div>

            </div>
        </div>
    </div>
    <script type="text/javascript" src="{{asset('huy')}}/js/jquery-1.8.3.min.js"></script>
    <script src="js/bootstrap/bootstrap-fileupload.js"></script>
    <script type="text/javascript" charset="utf-8" src="{{asset('huy')}}/js/kindeditor.js"></script>
    <script type="text/javascript">
        KE.show({
            id: 'content',
            resizeMode: 1,
            cssPath: './index.css',
            items: [
                'fontname', 'fontsize', 'textcolor', 'bgcolor', 'bold', 'italic', 'underline',
                'removeformat', 'justifyleft', 'justifycenter', 'justifyright', 'insertorderedlist',
                'insertunorderedlist', 'emoticons', 'image', 'link'
            ]
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
</div>
</body>

</html>