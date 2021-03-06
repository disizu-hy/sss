<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title></title>
    <link rel="stylesheet" href="{{asset('huy')}}/css/tabs.css" />
    <link rel="stylesheet" href="{{asset('huy')}}/css/layout.css" />
    <link rel="stylesheet" href="{{asset('huy')}}/css/bootstrap.css" />
    <link rel="stylesheet" href="{{asset('huy')}}/css/bootstrap-fileupload.css" />
    <link rel="stylesheet" href="{{asset('huy')}}/css/font-awesome.css" />
    <link rel="stylesheet" href="{{asset('huy')}}/css/bootstrap-switch.css" />
    <script type="text/javascript" src="{{asset('huy')}}/js/jquery-1.8.3.min.js"></script>

    <script src="{{asset('huy')}}/js/icheck.min.js"></script>
    <script src="{{asset('huy')}}/js/bootstrap/bootstrap-fileupload.js"></script>
    <script src="{{asset('huy')}}/js/jquery.ui.totop.js"></script>
    <script src="{{asset('huy')}}/js/bootstrap/bootstrap-switch.js"></script>
    <script src="{{asset('huy')}}/js/jquery.lazyload.js"></script>
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
            $.fn.bootstrapSwitch.defaults.onColor = 'primary';
            $.fn.bootstrapSwitch.defaults.onText = "启用";
            $.fn.bootstrapSwitch.defaults.offText = "禁用";
            $("[name='IsOpen']").bootstrapSwitch();
            tabSelect();
        })

        var isfirst = false;

        var tabSelect = function(e) {
            if(!isfirst) {
                if($(e).text() == "模块顺序切换") {
                    function Pointer(x, y) {
                        this.x = x;
                        this.y = y;
                    }

                    function Position(left, top) {
                        this.left = left;
                        this.top = top;
                    }
                    $(".item_content .item").each(function(i) {
                        this.init = function() { // 初始化
                            this.box = $(this).parent();
                            $(this).attr("index", i).css({
                                position: "absolute",
                                left: this.box.offset().left - 285,
                                top: this.box.offset().top - 137
                            }).appendTo(".item_content");
                            this.drag();
                        },
                            this.move = function(callback) { // 移动
                                $(this).stop(true).animate({
                                    left: this.box.offset().left - 285,
                                    top: this.box.offset().top - 137
                                }, 500, function() {
                                    if(callback) {
                                        callback.call(this);
                                    }
                                });
                            },
                            this.collisionCheck = function() {
                                var currentItem = this;
                                var direction = null;
                                $(this).siblings(".item").each(function() {
                                    if(
                                        currentItem.pointer.x > this.box.offset().left &&
                                        currentItem.pointer.y + $(window).scrollTop() > this.box.offset().top &&
                                        (currentItem.pointer.x < this.box.offset().left + this.box.width()) &&
                                        (currentItem.pointer.y + $(window).scrollTop() < this.box.offset().top + this.box.height())
                                    ) {
                                        // 返回对象和方向
                                        if(currentItem.box.offset().top < this.box.offset().top) {
                                            direction = "down";
                                        } else if(currentItem.box.offset().top > this.box.offset().top) {
                                            direction = "up";
                                        } else {
                                            direction = "normal";
                                        }
                                        this.swap(currentItem, direction);
                                    }
                                });
                            },
                            this.swap = function(currentItem, direction) { // 交换位置
                                if(this.moveing) return false;
                                var directions = {
                                    normal: function() {
                                        var saveBox = this.box;
                                        this.box = currentItem.box;
                                        currentItem.box = saveBox;
                                        this.move();
                                        $(this).attr("index", this.box.index());
                                        $(currentItem).attr("index", currentItem.box.index());
                                    },
                                    down: function() {
                                        // 移到上方
                                        var box = this.box;
                                        var node = this;
                                        var startIndex = currentItem.box.index();
                                        var endIndex = node.box.index();;
                                        for(var i = endIndex; i > startIndex; i--) {
                                            var prevNode = $(".item_content .item[index=" + (i - 1) + "]")[0];
                                            node.box = prevNode.box;
                                            $(node).attr("index", node.box.index());
                                            node.move();
                                            node = prevNode;
                                        }
                                        currentItem.box = box;
                                        $(currentItem).attr("index", box.index());
                                    },
                                    up: function() {
                                        // 移到上方
                                        var box = this.box;
                                        var node = this;
                                        var startIndex = node.box.index();
                                        var endIndex = currentItem.box.index();;
                                        for(var i = startIndex; i < endIndex; i++) {
                                            var nextNode = $(".item_content .item[index=" + (i + 1) + "]")[0];
                                            node.box = nextNode.box;
                                            $(node).attr("index", node.box.index());
                                            node.move();
                                            node = nextNode;
                                        }
                                        currentItem.box = box;
                                        $(currentItem).attr("index", box.index());
                                    }
                                }
                                directions[direction].call(this);
                            },
                            this.drag = function() { // 拖拽
                                var oldPosition = new Position();
                                var oldPointer = new Pointer();
                                var isDrag = false;
                                var currentItem = null;
                                $(this).mousedown(function(e) {
                                    oldPosition.left = $(this).position().left;
                                    oldPosition.top = $(this).position().top;
                                    oldPointer.x = e.clientX;
                                    oldPointer.y = e.clientY;
                                    isDrag = true;

                                    currentItem = this;

                                });
                                $(document).mousemove(function(e) {
                                    var currentPointer = new Pointer(e.clientX, e.clientY);
                                    if(!isDrag) return false;
                                    $(currentItem).css({
                                        "opacity": "0.8",
                                        "z-index": 999
                                    });
                                    var left = currentPointer.x - oldPointer.x + oldPosition.left;
                                    var top = currentPointer.y - oldPointer.y + oldPosition.top;
                                    $(currentItem).css({
                                        left: left,
                                        top: top
                                    });
                                    currentItem.pointer = currentPointer;
                                    // 开始交换位置

                                    currentItem.collisionCheck();

                                });
                                $(document).mouseup(function() {
                                    if(!isDrag) return false;
                                    isDrag = false;
                                    currentItem.move(function() {
                                        $(this).css({
                                            "opacity": "1",
                                            "z-index": 0
                                        });
                                    });
                                });
                            }
                        this.init();
                    });
                    isfirst = true;
                }

            }
        }
    </script>
</head>

<body style="height: 1500px;">

<ul class="tabs" style="background-color: #faf3f3">
    <li class="current">
        <a href="javascript:void(0)" id="#tab1">模块设置</a>
    </li>

</ul>
<div class="tabs_content">
    <div id="tab1" style="display: block;">
        <div>
            <form action="/Home/machineSectionSet" enctype="multipart/form-data" method="post" novalidate="novalidate">
                <ul style="float: left;">

                    <li style="width: 228px; height: 350px; float: left; margin-right: 60px;" class="dvSection">

                        <input type="hidden" value="1" name="sectionId">
                        <p style="float: left; width: 200px; height: 25px">
                            <input type="checkbox" name="IsOpen" value="1" id="1" checked="'checked'" style="float:left;line-height:50px; margin-bottom:-10px;">


                        </p>

                        <div class="fileupload fileupload-new" data-provides="fileupload">
                            <div class="fileupload-new thumbnail  mod_imgLight" style="width: 200px; height: 152px;">
                                <a>
                                    <img src="{{asset('huy')}}/images/noimg.gif"></a>
                            </div>
                            <div class="fileupload-preview fileupload-exists thumbnail" style="width: 200px; height: 150px; line-height: 20px; cursor: pointer"></div>
                            <div>
                                <span class="btn btn-file"><span class="fileupload-new">选择图片</span><span class="fileupload-exists"><i class="icon-edit"></i>&nbsp;更改</span><input type="file" name="uploadface" id="file1"></span>
                                <a href="#" style="text-decoration: none;" class="btn fileupload-exists" data-dismiss="fileupload"><i class="icon-trash"></i>&nbsp;删除</a>
                            </div>
                        </div>

                        <p style="margin-top: 5px; text-align: center; margin-left: -15px;">
                            <input type="text" value="商家信息" name="sectionName" style="font-size:20px; height:30px; color:black;" autocomplete="Off">

                        </p>

                    </li>
                    <li style="width: 228px; height: 350px; float: left; margin-right: 60px;" class="dvSection">

                        <input type="hidden" value="2" name="sectionId">
                        <p style="float: left; width: 200px; height: 25px">
                            <input type="checkbox" name="IsOpen" value="2" id="2" checked="'checked'" style="float:left;line-height:50px; margin-bottom:-10px;">

                        </p>

                        <div class="fileupload fileupload-new" data-provides="fileupload"><input type="hidden">
                            <div class="fileupload-new thumbnail  mod_imgLight" style="width: 200px; height: 152px;">
                                <a>
                                    <img src="{{asset('huy')}}/images/noimg.gif"></a>
                            </div>
                            <div class="fileupload-preview fileupload-exists thumbnail" style="width: 200px; height: 150px; line-height: 150px; cursor: pointer;"></div>
                            <div>
                                <span class="btn btn-file"><span class="fileupload-new">选择图片</span><span class="fileupload-exists"><i class="icon-edit"></i>&nbsp;更改</span><input type="file" name="uploadface" id="file1"></span>
                                <a href="#" style="text-decoration: none;" class="btn fileupload-exists" data-dismiss="fileupload"><i class="icon-trash"></i>&nbsp;删除</a>
                            </div>
                        </div>

                        <p style="margin-top: 5px; text-align: center; margin-left: -15px;">
                            <input type="text" value="新闻娱乐" name="sectionName" style="font-size:20px; height:30px; color:black;" autocomplete="Off">

                        </p>

                    </li>
                    <li style="width: 228px; height: 350px; float: left; margin-right: 60px;" class="dvSection">

                        <input type="hidden" value="3" name="sectionId">
                        <p style="float: left; width: 200px; height: 25px">
                            <input type="checkbox" name="IsOpen" value="3" id="3" checked="'checked'" style="float:left;line-height:50px; margin-bottom:-10px;">


                        </p>

                        <div class="fileupload fileupload-new" data-provides="fileupload">
                            <div class="fileupload-new thumbnail  mod_imgLight" style="width: 200px; height: 152px;">
                                <a>
                                    <img src="{{asset('huy')}}/images/noimg.gif"></a>
                            </div>
                            <div class="fileupload-preview fileupload-exists thumbnail" style="width: 200px; height: 150px; line-height: 20px; cursor: pointer"></div>
                            <div>
                                <span class="btn btn-file"><span class="fileupload-new">选择图片</span><span class="fileupload-exists"><i class="icon-edit"></i>&nbsp;更改</span><input type="file" name="uploadface" id="file1"></span>
                                <a href="#" style="text-decoration: none;" class="btn fileupload-exists" data-dismiss="fileupload"><i class="icon-trash"></i>&nbsp;删除</a>
                            </div>
                        </div>

                        <p style="margin-top: 5px; text-align: center; margin-left: -15px;">
                            <input type="text" value="吃喝玩乐" name="sectionName" style="font-size:20px; height:30px; color:black;" autocomplete="Off">

                        </p>

                    </li>
                    <li style="width: 228px; height: 350px; float: left; margin-right: 60px;" class="dvSection">

                        <input type="hidden" value="4" name="sectionId">
                        <p style="float: left; width: 200px; height: 25px">
                            <input type="checkbox" name="IsOpen" value="4" id="4" checked="'checked'" style="float:left;line-height:50px; margin-bottom:-10px;">

                        </p>

                        <div class="fileupload fileupload-new" data-provides="fileupload">
                            <div class="fileupload-new thumbnail  mod_imgLight" style="width: 200px; height: 152px;">
                                <a>
                                    <img src="{{asset('huy')}}/images/noimg.gif"></a>
                            </div>
                            <div class="fileupload-preview fileupload-exists thumbnail" style="width: 200px; height: 150px; line-height: 20px; cursor: pointer"></div>
                            <div>
                                <span class="btn btn-file"><span class="fileupload-new">选择图片</span><span class="fileupload-exists"><i class="icon-edit"></i>&nbsp;更改</span><input type="file" name="uploadface" id="file1"></span>
                                <a href="#" style="text-decoration: none;" class="btn fileupload-exists" data-dismiss="fileupload"><i class="icon-trash"></i>&nbsp;删除</a>
                            </div>
                        </div>

                        <p style="margin-top: 5px; text-align: center; margin-left: -15px;">
                            <input type="text" value="便民服务" name="sectionName" style="font-size:20px; height:30px; color:black;" autocomplete="Off">

                        </p>

                    </li>
                    <li style="width: 228px; height: 350px; float: left; margin-right: 60px;" class="dvSection">

                        <input type="hidden" value="5" name="sectionId">
                        <p style="float: left; width: 200px; height: 25px">
                            <input type="checkbox" name="IsOpen" value="5" id="5" checked="'checked'" style="float:left;line-height:50px; margin-bottom:-10px;">
                        </p>

                        <div class="fileupload fileupload-new" data-provides="fileupload">
                            <div class="fileupload-new thumbnail  mod_imgLight" style="width: 200px; height: 152px;">
                                <a>
                                    <img src="{{asset('huy')}}/images/noimg.gif"></a>
                            </div>
                            <div class="fileupload-preview fileupload-exists thumbnail" style="width: 200px; height: 150px; line-height: 20px; cursor: pointer"></div>
                            <div>
                                <span class="btn btn-file"><span class="fileupload-new">选择图片</span><span class="fileupload-exists"><i class="icon-edit"></i>&nbsp;更改</span><input type="file" name="uploadface" id="file1"></span>
                                <a href="#" style="text-decoration: none;" class="btn fileupload-exists" data-dismiss="fileupload"><i class="icon-trash"></i>&nbsp;删除</a>
                            </div>
                        </div>

                        <p style="margin-top: 5px; text-align: center; margin-left: -15px;">
                            <input type="text" value="优惠信息" name="sectionName" style="font-size:20px; height:30px; color:black;" autocomplete="Off">

                        </p>

                    </li>
                    <li style="width: 228px; height: 350px; float: left; margin-right: 60px;" class="dvSection">

                        <input type="hidden" value="6" name="sectionId">
                        <p style="float: left; width: 200px; height: 25px">
                            <input type="checkbox" name="IsOpen" value="6" id="6" checked="'checked'" style="float:left;line-height:50px; margin-bottom:-10px;">

                        </p>

                        <div class="fileupload fileupload-new" data-provides="fileupload">
                            <div class="fileupload-new thumbnail  mod_imgLight" style="width: 200px; height: 152px;">
                                <a>
                                    <img src="{{asset('huy')}}/images/noimg.gif"></a>
                            </div>
                            <div class="fileupload-preview fileupload-exists thumbnail" style="width: 200px; height: 150px; line-height: 20px; cursor: pointer"></div>
                            <div>
                                <span class="btn btn-file"><span class="fileupload-new">选择图片</span><span class="fileupload-exists"><i class="icon-edit"></i>&nbsp;更改</span><input type="file" name="uploadface" id="file1"></span>
                                <a href="#" style="text-decoration: none;" class="btn fileupload-exists" data-dismiss="fileupload"><i class="icon-trash"></i>&nbsp;删除</a>
                            </div>
                        </div>

                        <p style="margin-top: 5px; text-align: center; margin-left: -15px;">
                            <input type="text" value="在线游戏" name="sectionName" style="font-size:20px; height:30px; color:black;" autocomplete="Off">

                        </p>

                    </li>
                    <li style="width: 228px; height: 350px; float: left; margin-right: 60px;" class="dvSection">

                        <input type="hidden" value="7" name="sectionId">
                        <p style="float: left; width: 200px; height: 25px">
                            <input type="checkbox" name="IsOpen" value="7" id="7" checked="'checked'" style="float:left;line-height:50px; margin-bottom:-10px;">
                        </p>

                        <div class="fileupload fileupload-new" data-provides="fileupload">
                            <div class="fileupload-new thumbnail  mod_imgLight" style="width: 200px; height: 152px;">
                                <a>
                                    <img src="{{asset('huy')}}/images/noimg.gif"></a>
                            </div>
                            <div class="fileupload-preview fileupload-exists thumbnail" style="width: 200px; height: 150px; line-height: 20px; cursor: pointer"></div>
                            <div>
                                <span class="btn btn-file"><span class="fileupload-new">选择图片</span><span class="fileupload-exists"><i class="icon-edit"></i>&nbsp;更改</span><input type="file" name="uploadface" id="file1"></span>
                                <a href="#" style="text-decoration: none;" class="btn fileupload-exists" data-dismiss="fileupload"><i class="icon-trash"></i>&nbsp;删除</a>
                            </div>
                        </div>

                        <p style="margin-top: 5px; text-align: center; margin-left: -15px;">
                            <input type="text" value="热门活动" name="sectionName" style="font-size:20px; height:30px; color:black;" autocomplete="Off">

                        </p>

                    </li>
                    <li style="width: 228px; height: 350px; float: left; margin-right: 60px;" class="dvSection">

                        <input type="hidden" value="8" name="sectionId">
                        <p style="float: left; width: 200px; height: 25px">
                            <input type="checkbox" name="IsOpen" value="8" id="8" checked="'checked'" style="float:left;line-height:50px; margin-bottom:-10px;">

                        </p>

                        <div class="fileupload fileupload-new" data-provides="fileupload">
                            <div class="fileupload-new thumbnail  mod_imgLight" style="width: 200px; height: 152px;">
                                <a>
                                    <img src="{{asset('huy')}}/images/noimg.gif"></a>
                            </div>
                            <div class="fileupload-preview fileupload-exists thumbnail" style="width: 200px; height: 150px; line-height: 20px; cursor: pointer"></div>
                            <div>
                                <span class="btn btn-file"><span class="fileupload-new">选择图片</span><span class="fileupload-exists"><i class="icon-edit"></i>&nbsp;更改</span><input type="file" name="uploadface" id="file1"></span>
                                <a href="#" style="text-decoration: none;" class="btn fileupload-exists" data-dismiss="fileupload"><i class="icon-trash"></i>&nbsp;删除</a>
                            </div>
                        </div>

                        <p style="margin-top: 5px; text-align: center; margin-left: -15px;">
                            <input type="text" value="酒店预订" name="sectionName" style="font-size:20px; height:30px; color:black;" autocomplete="Off">

                        </p>

                    </li>
                    <li style="width: 228px; height: 350px; float: left; margin-right: 60px;" class="dvSection">

                        <input type="hidden" value="9" name="sectionId">
                        <p style="float: left; width: 200px; height: 25px">
                            <input type="checkbox" name="IsOpen" value="9" id="9" checked="'checked'" style="float:left;line-height:50px; margin-bottom:-10px;">
                        </p>

                        <div class="fileupload fileupload-new" data-provides="fileupload">
                            <div class="fileupload-new thumbnail  mod_imgLight" style="width: 200px; height: 152px;">
                                <a>
                                    <img src="{{asset('huy')}}/images/noimg.gif"></a>
                            </div>
                            <div class="fileupload-preview fileupload-exists thumbnail" style="width: 200px; height: 150px; line-height: 20px; cursor: pointer"></div>
                            <div>
                                <span class="btn btn-file"><span class="fileupload-new">选择图片</span><span class="fileupload-exists"><i class="icon-edit"></i>&nbsp;更改</span><input type="file" name="uploadface" id="file1"></span>
                                <a href="#" style="text-decoration: none;" class="btn fileupload-exists" data-dismiss="fileupload"><i class="icon-trash"></i>&nbsp;删除</a>
                            </div>
                        </div>

                        <p style="margin-top: 5px; text-align: center; margin-left: -15px;">
                            <input type="text" value="联系我们" name="sectionName" style="font-size:20px; height:30px; color:black;" autocomplete="Off">

                        </p>

                    </li>
                    <li style="width: 228px; height: 350px; float: left; margin-right: 60px;" class="dvSection">

                        <input type="hidden" value="10" name="sectionId">
                        <p style="float: left; width: 200px; height: 25px">
                            <input type="checkbox" name="IsOpen" value="10" id="10" checked="'checked'" style="float:left;line-height:50px; margin-bottom:-10px;">

                        </p>

                        <div class="fileupload fileupload-new" data-provides="fileupload">
                            <div class="fileupload-new thumbnail  mod_imgLight" style="width: 200px; height: 152px;">
                                <a>
                                    <img src="{{asset('huy')}}/images/noimg.gif"></a>
                            </div>
                            <div class="fileupload-preview fileupload-exists thumbnail" style="width: 200px; height: 150px; line-height: 20px; cursor: pointer"></div>
                            <div>
                                <span class="btn btn-file"><span class="fileupload-new">选择图片</span><span class="fileupload-exists"><i class="icon-edit"></i>&nbsp;更改</span><input type="file" name="uploadface" id="file1"></span>
                                <a href="#" style="text-decoration: none;" class="btn fileupload-exists" data-dismiss="fileupload"><i class="icon-trash"></i>&nbsp;删除</a>
                            </div>
                        </div>

                        <p style="margin-top: 5px; text-align: center; margin-left: -15px;">
                            <input type="text" value="本月院线" name="sectionName" style="font-size:20px; height:30px; color:black;" autocomplete="Off">

                        </p>

                    </li>
                    <li style="width: 228px; height: 350px; float: left; margin-right: 60px;" class="dvSection">

                        <input type="hidden" value="11" name="sectionId">
                        <p style="float: left; width: 200px; height: 25px">
                            <input type="checkbox" name="IsOpen" value="11" id="11" checked="'checked'" style="float:left;line-height:50px; margin-bottom:-10px;">

                        </p>

                        <div class="fileupload fileupload-new" data-provides="fileupload">
                            <div class="fileupload-new thumbnail  mod_imgLight" style="width: 200px; height: 152px;">
                                <a>
                                    <img src="{{asset('huy')}}/images/noimg.gif"></a>
                            </div>
                            <div class="fileupload-preview fileupload-exists thumbnail" style="width: 200px; height: 150px; line-height: 20px; cursor: pointer"></div>
                            <div>
                                <span class="btn btn-file"><span class="fileupload-new">选择图片</span><span class="fileupload-exists"><i class="icon-edit"></i>&nbsp;更改</span><input type="file" name="uploadface" id="file1"></span>
                                <a href="#" style="text-decoration: none;" class="btn fileupload-exists" data-dismiss="fileupload"><i class="icon-trash"></i>&nbsp;删除</a>
                            </div>
                        </div>

                        <p style="margin-top: 5px; text-align: center; margin-left: -15px;">
                            <input type="text" value="房产" name="sectionName" style="font-size:20px; height:30px; color:black;" autocomplete="Off">

                        </p>

                    </li>
                    <li style="width: 228px; height: 350px; float: left; margin-right: 60px;" class="dvSection">

                        <input type="hidden" value="12" name="sectionId">
                        <p style="float: left; width: 200px; height: 25px">
                            <input type="checkbox" name="IsOpen" value="12" id="12" checked="'checked'" style="float:left;line-height:50px; margin-bottom:-10px;">

                        </p>

                        <div class="fileupload fileupload-new" data-provides="fileupload">
                            <div class="fileupload-new thumbnail  mod_imgLight" style="width: 200px; height: 152px;">
                                <a>
                                    <img src="{{asset('huy')}}/images/noimg.gif"></a>
                            </div>
                            <div class="fileupload-preview fileupload-exists thumbnail" style="width: 200px; height: 150px; line-height: 20px; cursor: pointer"></div>
                            <div>
                                <span class="btn btn-file"><span class="fileupload-new">选择图片</span><span class="fileupload-exists"><i class="icon-edit"></i>&nbsp;更改</span><input type="file" name="uploadface" id="file1"></span>
                                <a href="#" style="text-decoration: none;" class="btn fileupload-exists" data-dismiss="fileupload"><i class="icon-trash"></i>&nbsp;删除</a>
                            </div>
                        </div>

                        <p style="margin-top: 5px; text-align: center; margin-left: -15px;">
                            <input type="text" value="车市" name="sectionName" style="font-size:20px; height:30px; color:black;" autocomplete="Off">

                        </p>

                    </li>
                    <li style="width: 228px; height: 350px; float: left; margin-right: 60px;" class="dvSection">

                        <input type="hidden" value="13" name="sectionId">
                        <p style="float: left; width: 200px; height: 25px">
                            <input type="checkbox" name="IsOpen" value="13" id="13" checked="'checked'" style="float:left;line-height:50px; margin-bottom:-10px;">

                        </p>

                        <div class="fileupload fileupload-new" data-provides="fileupload">
                            <div class="fileupload-new thumbnail  mod_imgLight" style="width: 200px; height: 152px;">
                                <a>
                                    <img src="{{asset('huy')}}/images/noimg.gif"></a>
                            </div>
                            <div class="fileupload-preview fileupload-exists thumbnail" style="width: 200px; height: 150px; line-height: 20px; cursor: pointer"></div>
                            <div>
                                <span class="btn btn-file"><span class="fileupload-new">选择图片</span><span class="fileupload-exists"><i class="icon-edit"></i>&nbsp;更改</span><input type="file" name="uploadface" id="file1"></span>
                                <a href="#" style="text-decoration: none;" class="btn fileupload-exists" data-dismiss="fileupload"><i class="icon-trash"></i>&nbsp;删除</a>
                            </div>
                        </div>

                        <p style="margin-top: 5px; text-align: center; margin-left: -15px;">
                            <input type="text" value="在线商城" name="sectionName" style="font-size:20px; height:30px; color:black;" autocomplete="Off">

                        </p>

                    </li>
                    <li style="width: 228px; height: 350px; float: left; margin-right: 60px;" class="dvSection">

                        <input type="hidden" value="14" name="sectionId">
                        <p style="float: left; width: 200px; height: 25px">
                            <input type="checkbox" name="IsOpen" value="14" id="14" checked="'checked'" style="float:left;line-height:50px; margin-bottom:-10px;">
                        </p>

                        <div class="fileupload fileupload-new" data-provides="fileupload">
                            <div class="fileupload-new thumbnail  mod_imgLight" style="width: 200px; height: 152px;">
                                <a>
                                    <img src="{{asset('huy')}}/images/noimg.gif"></a>
                            </div>
                            <div class="fileupload-preview fileupload-exists thumbnail" style="width: 200px; height: 150px; line-height: 20px; cursor: pointer"></div>
                            <div>
                                <span class="btn btn-file"><span class="fileupload-new">选择图片</span><span class="fileupload-exists"><i class="icon-edit"></i>&nbsp;更改</span><input type="file" name="uploadface" id="file1"></span>
                                <a href="#" style="text-decoration: none;" class="btn fileupload-exists" data-dismiss="fileupload"><i class="icon-trash"></i>&nbsp;删除</a>
                            </div>
                        </div>

                        <p style="margin-top: 5px; text-align: center; margin-left: -15px;">
                            <input type="text" value="在线留言" name="sectionName" style="font-size:20px; height:30px; color:black;" autocomplete="Off">

                        </p>

                    </li>
                    <li style="width: 228px; height: 350px; float: left; margin-right: 60px;" class="dvSection">

                        <input type="hidden" value="15" name="sectionId">
                        <p style="float: left; width: 200px; height: 25px">
                            <input type="checkbox" name="IsOpen" value="15" id="15" checked="'checked'" style="float:left;line-height:50px; margin-bottom:-10px;">

                        </p>

                        <div class="fileupload fileupload-new" data-provides="fileupload">
                            <div class="fileupload-new thumbnail  mod_imgLight" style="width: 200px; height: 152px;">
                                <a>
                                    <img src="{{asset('huy')}}/images/noimg.gif"></a>
                            </div>
                            <div class="fileupload-preview fileupload-exists thumbnail" style="width: 200px; height: 150px; line-height: 20px; cursor: pointer"></div>
                            <div>
                                <span class="btn btn-file"><span class="fileupload-new">选择图片</span><span class="fileupload-exists"><i class="icon-edit"></i>&nbsp;更改</span><input type="file" name="uploadface" id="file1"></span>
                                <a href="#" style="text-decoration: none;" class="btn fileupload-exists" data-dismiss="fileupload"><i class="icon-trash"></i>&nbsp;删除</a>
                            </div>
                        </div>

                        <p style="margin-top: 5px; text-align: center; margin-left: -15px;">
                            <input type="text" value="在线投票" name="sectionName" style="font-size:20px; height:30px; color:black;" autocomplete="Off">

                        </p>

                    </li>

                </ul>
                <div style="clear: both;">
                    <input type="button" value="模块设置" id="" class="btn  btn-primary">
                </div>
            </form>
        </div>
    </div>

</div>
</div>
</div>
</body>
</html>