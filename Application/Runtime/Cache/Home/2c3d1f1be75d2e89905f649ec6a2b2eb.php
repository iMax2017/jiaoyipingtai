<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="keywords" content="二手滑板估价,个人二手滑板转让" />
    <meta name="description" content="民大二手滑板直卖网，汇集二手滑板买卖信息,私人二手滑板转让，是您买卖二手滑板的理想平台。" />
    <title>滑板车交易网</title>
    <link rel="icon" href="/huabanshe/Public/img/pic09.jpg">
    <link rel="stylesheet" href="/huabanshe\Application\Home\View\Index\semantic.min.css" media="screen" title="no title" charset="utf-8">
    <script type="text/javascript" src="/huabanshe\Application\Home\View\Index\jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="/huabanshe\Application\Home\View\Index\semantic.min.js"></script>
</head>

<body>
    <div class="ui menu">
        <a class="item"><i class="red home icon"></i>首页</a>
        <a class="item" href="<?php echo U('/list');?>"><i class="orange grid layout icon"></i>所有滑板车</a>
        <?php if($islogin != 1): ?><!-- 登录前显示    开始  -->
            <div class="right menu">
                <a class="item" onclick="$('.ui.large.modal').modal('show');"><i class="yellow user icon"></i>注册</a>
                <a class="item" onclick="$('#login').modal('show');">

                    <i class="olive sign in icon"></i>登录
                </a>
            </div><?php endif; ?>
        <!-- 登录前显示    结束  -->
        <!-- 登录后显示    开始  -->
        <?php if($islogin == 1): ?><div class="ui simple dropdown right yellow item">
                <i class="yellow user icon"></i>个人信息
                <i class="dropdown icon"></i>
                <div class="ui menu">
                    <a class="item" href="<?php echo U('/logout');?>"><i class="olive sign out icon"></i> 注销</a>
                    <a class="item" href="<?php echo U('/addgood');?>"><i class="green add icon"></i> 添加商品</a>
                    <a class="item" onclick="$('#changepass').modal('show');"><i class="teal settings icon"></i> 更改密码</a>
                </div>
            </div><?php endif; ?>
        <!-- 登录后显示    结束  -->
    </div>
    <div class="ui small modal" id="login">
        <div class="ui error message" id="error" hidden></div>
        <i class="close icon"></i>
        <form class="ui  form" action="">
            <div class="ui padded column aligned very relaxed stackable grid">
                <div class="column">
                    <div class="field">
                        <label>Username</label>
                        <div class="ui left icon input">
                            <input name="username" placeholder="用户名" type="text" id="username" onkeydown="key_login(event)">
                            <i class="user icon"></i>
                        </div>
                    </div>
                    <div class="field">
                        <label>Password</label>
                        <div class="ui left icon input">
                            <input name="" placeholder="密码" type="password" id="password" onkeydown="key_login(event)">
                            <i class="lock icon"></i>
                        </div>
                    </div>
                    <div class="ui blue submit button" id="login">Login</div>
                </div>
            </div>
            <!-- <div class="ui error message"></div> -->
        </form>
    </div>
    <script type="text/javascript">
        function key_login(event) {
            if (event.keyCode == 13) {
                login();
            }
        }

        function show_error(error) {
            $("#error").text(error);
            $("#error").show();
        }

        function success(session_id) {
            alert("登陆成功！");
            window.location.href = "";
        }

        function login() {
            $("#login").addClass("loading");
            $.ajax({
                url: "<?php echo U('Usermin/login');?>",
                type: 'POST',
                data: {
                    "username": $("#username").val(),
                    "password": $("#password").val(),
                    //"_csrf": document.head.getAttribute('data-csrf-token')
                },
                async: true,
                success: function(data) {
                    error_code = data.error_code;
                    switch (error_code) {
                        case 1001:
                            show_error("用户不存在");
                            break;
                        case 1002:
                            show_errors("密码错误");
                            break;
                        case 1:
                            success(data.session_id);
                            return;
                        default:
                            show_errors("未知错误");
                            break;
                    }
                    $("#login").text("登录");
                    $("#login").removeClass("loading");

                },
                error: function(XMLHttpRequest, textStatus, errorThrown) {
                    // alert(XMLHttpRequest.responseText);
                    show_error("未知错误");
                    $("#login").text("登录");
                    $('.ui.small.modal').modal('hide');
                }
            });
        }
        $(document).ready(function() {
            $("#login").click(function() {
                login();
            });
        });
    </script>
    <div class="ui large modal ">
        <i class="close icon"></i>
        <form class="ui form">
            <div class="ui padded  column middle aligned very relaxed stackable grid">
                <div class="column">
                    <div class="field">
                        <label for="username1">用户名</label>
                        <input type="text" placeholder="" id="username1" required>
                    </div>
                    <div class="field">
                        <label for="email">邮箱</label>
                        <input type="email" placeholder="" id="email">
                    </div>
                    <div class="two fields">
                        <div class="field">
                            <label class="ui header">密码</label>
                            <input type="password" placeholder="" id="password1" required>
                        </div>
                        <div class="field">
                            <label class="ui header">确认密码</label>
                            <input type="password" placeholder="" id="password2" required>
                        </div>
                    </div>
                    <div class="two fields">
                        <div class="field input">
                            <label class="ui header">验证码</label>
                            <input type="text" placeholder="" id="verify" required>
                            <img src="<?php echo U('Base/createVerify');?>" title="点击刷新验证码" onClick="changeVerify()" />
                        </div>
                        <div class="field">
                            <img class="ui small image " src="" alt="" />
                        </div>
                    </div>
                    <!--<a id="sign_up" class="ui button" href="javascript:(0);">注册</a>-->
                    <div id="sign_up" class="ui blue submit button">注册</div>
                </div>
            </div>
        </form>
        <script type="text/javascript">
            function show_error(error) {
                $("#error").text(error);
                $("#error").show();
            }

            function success1() {
                alert("注册成功！");
                window.location.href = "";
            }

            function submit() {
                if ($("#password1").val() != $("#password2").val()) {
                    show_error("两次输入的密码不一致");
                    return;
                }
                $("#sign_up").addClass("loading");
                $.ajax({
                    url: "<?php echo U('Usermin/register');?>",
                    type: 'POST',
                    async: true,
                    data: {
                        username: $("#username1").val(),
                        password1: $("#password1").val(),
                        password2: $("#password2").val(),
                        email: $("#email").val(),
                        verify: $("#verify").val(),
                        // _csrf: document.head.getAttribute('data-csrf-token')
                    },
                    success: function(data) {
                        // console.log(data);
                        alert(data.user);
                        error_code = data.error_code;
                        switch (error_code) {
                            case 2001:
                                show_error("服务器未收到数据");
                                break;
                            case 2005:
                            case 2002:
                                show_error("用户名为学号");
                                break;
                            case 2007:
                            case 2003:
                                show_error("密码不得为空");
                                break;
                            case 2008:
                                show_error("已经有人用过这个用户名了");
                                break;
                            case 2009:
                                show_error("验证码错误");
                                break
                            case 2009:
                                show_error(data.error);
                                break
                            case 1:
                                success1();
                                break;
                            default:
                                show_error("未知错误：" + JSON.stringify(data));
                                break;
                        }
                        $("#sign_up").removeClass("loading");
                    },
                    error: function(XMLHttpRequest, textStatus, errorThrown) {
                        alert(XMLHttpRequest.responseText);
                        show_error("未知错误");
                        $("#sign_up").removeClass("loading");
                    }
                });
            }
            $(document).ready(function() {
                $("#sign_up").click(function() {
                    submit();
                });
            });
        </script>
    </div>
    <div class="ui  very padded  container segment">
        <!--div class="ui right very close rail">
            <!--二维码 -->
        <!--div class="ui segment "-->
        <!--img src="pic01.jpg" width="50%" alt="二维码" />
      <div class="ui header">
        公告
      </div>
      2017纳新群660743417 <br/>
      遇到网站BUG请发邮件<br/>
      1191544503@qq.com</div>
  </div-->

        <div class="ui four stackable  cards">
            <?php if(is_array($list)): foreach($list as $key=>$vv): ?><div class="ui raised link card">
                    <div class="image"><img src="/huabanshe/Public/image/<?php echo ($vv["image"]); ?>" width="100%" height="30%"></div>
                    <div class="content">
                        <a class="header">类型 </a><?php echo ($vv["goodsname"]); ?>
                        <div class="description"><?php echo ($vv["introduce"]); ?>}</div>
                    </div>
                    <div class="content">
                        <span class="right floated">
                          <i class="heart outline like icon"></i>17 likes</span>
                        <i class="comment icon"></i><?php echo ($vv["phone"]); ?>
                    </div>
                    <div class="ui inverted red bottom attached button"><i class="yen icon"></i><?php echo ($vv["price"]); ?></div>
                </div><?php endforeach; endif; ?>
        </div>

        <?php echo ($page); ?>
    </div>

    <!--666666666666666666666666666666666666666666666666666666666666666666666-->
    <!--script type="text/javascript">
       /* function submit() {

            $("#sign_up").addClass("loading");
            $.ajax({
                url: "<?php echo U('Usermin/register');?>",
                type: 'POST',
                async: true,
                data: {
                    username: $("#username1").val(),
                    password1: $("#password1").val(),
                    password2: $("#password2").val(),
                    email: $("#email").val(),
                    verify: $("#verify").val(),
                    // _csrf: document.head.getAttribute('data-csrf-token')
                },
                success: function(data) {
                    // console.log(data);

                }
            }, );
        }
        $(document).ready(function() {
            $("#sign_up").click(function() {
                submit();
            });
       });
    </script-->

    <!--啊啊啊啊啊啊啊啊啊啊啊啊啊啊啊啊啊啊啊啊啊啊啊啊啊啊啊啊啊啊啊啊啊-->

    <div class="ui vertical footer" style="margin-top:3em;">
        <div class="ui center aligned container">
            <span style="color: #999;">滑板车交易网 Powered by
        <div class="ui red basic button" style="padding:1% 1%">I</div>
        <button class="ui orange basic button" style="padding:1% 1%">M</button>
        <button class="ui yellow basic button" style="padding:1% 1%">A</button>
        <button class="ui olive basic button" style="padding:1% 1%">X</button>
        <button class="ui green basic button" style="padding:1% 1%">2</button>
        <button class="ui teal basic button" style="padding:1% 1%">0</button>
        <button class="ui blue basic button" style="padding:1% 1%">1</button>
        <button class="ui violet basic button" style="padding:1% 1%">7</button>
        </a>
        工作室.
      </span>
        </div>
    </div>
    <!-- IMAX 2017再出发 -->


    <div class="ui small modal" id="changepass">
        <div class="ui error message" id="changeerror" hidden></div>
        <i class="close icon"></i>
        <form class="ui  form" action="">
            <div class="ui padded column aligned very relaxed stackable grid">
                <div class="column">
                    <div class="field">
                        <label>旧密码</label>
                        <div class="ui left icon input">
                            <input name="" placeholder="用户名" type="text" id="oldpass" onkeydown="key_login1(event)">
                            <i class="user icon"></i>
                        </div>
                    </div>
                    <div class="field">
                        <label>新密码</label>
                        <div class="ui left icon input">
                            <input name="" placeholder="密码" type="password" id="newpass1" onkeydown="key_login1(event)">
                            <i class="lock icon"></i>
                        </div>
                    </div>
                    <div class="field">
                        <label>重新输入新密码</label>
                        <div class="ui left icon input">
                            <input name="" placeholder="密码" type="password" id="newpass2" onkeydown="key_login1(event)">
                            <i class="lock icon"></i>
                        </div>
                    </div>
                    <div class="ui blue submit button" id="change">更改</div>
                </div>
            </div>
            <!-- <div class="ui error message"></div> -->
        </form>
    </div>
    <script type="text/javascript">
        function key_login1(event) {
            if (event.keyCode == 13) {
                change();
            }
        }

        function show_changeerror(error) {
            $("#changeerror").text(error);
            $("#changeerror").show();
        }

        function changesuccess(session_id) {
            alert("修改成功！");
            window.location.href = "";
            //    $('#changepass').modal('hide');
        }

        function change() {
            if ($("#newpass1").val() != $("#newpass2").val()) {
                show_changeerror("两次输入的密码不一致");
                return;
            }
            $("#change").addClass("loading");
            $.ajax({
                url: "<?php echo U('Usermin/alterpwd');?>",
                type: 'POST',
                data: {
                    "oldpass": $("#oldpass").val(),
                    "newpass1": $("#newpass1").val(),
                    "newpass2": $("#newpass2").val(),
                    //"_csrf": document.head.getAttribute('data-csrf-token')
                },
                async: true,
                success: function(data) {
                    error_code = data.error_code;
                    switch (error_code) {
                        case 1001:
                            show_changeerror("用户不存在");
                            break;
                        case 1002:
                            show_changeerror("旧密码错误");
                            break;
                        case 1003:
                            show_changeerror("两次输入的密码不一致");
                            break;
                        case 1:
                            changesuccess(data.session_id);
                            return;
                        default:
                            show_changeerror("未知错误");
                            break;
                    }
                    $("#change").text("更改");
                    $("#change").removeClass("loading");

                },
                error: function(XMLHttpRequest, textStatus, errorThrown) {
                    alert(XMLHttpRequest.responseText);
                    show_error("未知错误");
                    $("#change").text("登录");
                    $('#changepass').modal('hide');
                }
            });
        }
        $(document).ready(function() {
            $("#change").click(function() {
                change();
            });
        });
    </script>
</body>

</html>