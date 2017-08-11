<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="/huabanshe\Application\Home\View\Index\semantic.min.css">
    <script src="/huabanshe\Application\Home\View\Index\jquery-3.2.1.min.js"></script>
    <script src="/huabanshe\Application\Home\View\Index\semantic.min.js"></script>

</head>

<body>
    <div class="ui blue raised very  text container segment">
        <h1 class="ui center aligned header">上架滑板</h1>
    </div>
    <div class="ui blue text container compact">
        <div class="ui breadcrumb">
            <a class="section">主页</a>
            <span class="divider">/</span>
            <div class="section">上架商品</div>
        </div>
    </div>
    <div class="ui green raised very  text container segment" style="margin-top:0;">
        <div class="ui form">
            <form class="" action="<?php echo U('/add');?>" method="post" onsubmit="return validate_form(this);" enctype="multipart/form-data">
                <p><?php echo ($error); ?></p>
                <div class="fields">
                    <div class="field">
                        <label>类型</label>
                        <input placeholder="类型" type="text" name="storename">
                    </div>
                    <div class="field">
                        <label>联系方式</label>
                        <input type="text" id="fun" hidden name="phonetype">
                        <div class="ui left labeled input">
                            <div class="ui dropdown label" id="conn">
                                <div class="text" id="select">QQ:</div>
                                <i class="dropdown icon"></i>
                                <div class="menu">
                                    <div class="item" title="qq">QQ:</div>
                                    <div class="item" title="wx">VX:</div>
                                    <div class="item" title="tel">Tel:</div>
                                </div>
                            </div>
                            <input placeholder="QQ/微信/电话" type="text" name="phone">
                        </div>
                    </div>
                </div>
                <div class="field">
                    <label>详情</label>
                    <textarea name="introduce"></textarea>
                </div>
                <div class="fields">
                    <div class="field">
                        <input class="ui input" placeholder="定价" type="text" name="price">
                    </div>
                    <div class="field ">
                        <input name="fname" type="file" id="file" />
                    </div>
                    <div class="field ">
                        <input type="submit" class="ui positive button" value="上架" name="submit"></button>
                    </div>
                </div>
            </form>
            <script type="text/javascript">
                function validate_form() {
                    var f = document.getElementById("file").value;
                    if (f == "") {
                        alert("请上传图片");
                        return false;
                    } else {
                        if (!/\.(jpg|jpeg|JPG)$/.test(f)) {
                            alert("图片类型必须是jpg")
                            return false;
                        }
                    }
                    var s = document.getElementById("select");
                    var i = document.getElementById("fun");
                    if (s.innerHTML == "QQ:")
                        i.value = "qq";
                    else if (s.innerHTML == "VX:")
                        i.value = "vx";
                    else
                        i.value = "tel";
                }
            </script>
        </div>
    </div>

    <script type="text/javascript">
        $('.ui.dropdown')
            .dropdown();
    </script>

</body>

</html>