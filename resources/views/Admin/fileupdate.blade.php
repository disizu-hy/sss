<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title></title>

    <link rel="stylesheet" href="{{asset('huy')}}/css/tabs.css" />
    <link rel="stylesheet" href="{{asset('huy')}}/css/layout.css" />
    <link rel="stylesheet" href="{{asset('huy')}}/css/bootstrap.css" />
    <link rel="stylesheet" href="{{asset('huy')}}/css/bootstrap-fileupload.css" />
    <link rel="stylesheet" href="{{asset('huy')}}/css/bootstrap-fileupload.css" />
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

        a:hover {
            text-decoration: none;
        }
    </style>
</head>
<body>
<ul class="tabs" style="background-color: #faf3f3">
    <li>
        <a href="javascript:void(0)" id="#tab2">添加广告图片</a>
    </li>
</ul>
    <div id="tab2" style="display: none;">
        <div class="item_container">
            <div class="item_content" style="overflow: auto; padding: 0px;">

                <fieldset>
                    <legend>轮播图片</legend>
                    <form action="{{url('/fileupdatee')}}" method="post" enctype="multipart/form-data">
                        {{csrf_field()}}
                        <input type="hidden" name="id" value="{{$id}}">
                        图片:<input type="file" name="file"><br>
                        <input type="submit" value="修改图片" >

                    </form>

                    <div class="control-group">

                        <!-- Text input-->

                    </div>

                    <div style="text-align: center; color: black; text-align: center; text-align: right; text-align: left; text-align: center; text-align: left; text-align: center;">
                    </div>

                    <div class="control-group" id="machine" style="margin-top: 30px; margin-bottom: 20px; width: 800px; display: none; overflow: auto; margin-left: 30px;">
                        <div style="float: left; width: 180px; margin-bottom: 18px; overflow: auto;">
                            <div style="float: left; margin-right: 5px;">
                                <div class="icheckbox_flat-blue checked" style="position: relative;"><input type="checkbox" checked="checked" class="chk1" value="1" name="machineId" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins></div>
                            </div>
                            <label>dssd</label>
                        </div>
                    </div>
                    <div style="clear: both; margin-top: 30px;">

                    </div>
                </fieldset>
                </form>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="{{asset('huy')}}/js/jquery-1.8.3.min.js"></script>
<script src="{{asset('huy')}}/js/bootstrap/bootstrap-fileupload.js"></script>
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
</body>

</html>