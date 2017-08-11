<?php if (!defined('THINK_PATH')) exit();?><html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <style>
        * {
            /* Resetting the default styles of the page */
            margin: 0;
            padding: 0;
        }
        
        html {
            overflow: auto;
        }
        
        body {
            /* Setting default text color, background and a font stack */
            font-size: 0.825em;
            color: #eee;
            background: url("/book/Public/img/pic03.png") repeat-x #222222;
            font-family: Arial, Helvetica, sans-serif;
        }
        
        #carbonForm {
            /* The main form container */
            background-color: #1C1C1C;
            border: 1px solid #080808;
            margin: 20px auto;
            padding: 20px;
            width: 500px;
            -moz-box-shadow: 0 0 1px #444 inset;
            -webkit-box-shadow: 0 0 1px #444 inset;
            box-shadow: 0 0 1px #444 inset;
        }
        
        #carbonForm h1 {
            /* The form heading */
            font-family: Century Gothic, Myriad Pro, Arial, Helvetica, sans-serif;
            font-size: 60px;
            font-weight: normal;
            padding: 0 0 30px 10px;
            text-align: left;
        }
        
        .fieldContainer {
            /* The light rounded section, which contans the fields */
            background-color: #1E1E1E;
            border: 1px solid #0E0E0E;
            padding: 30px 10px;
            /* CSS3 box shadow, used as an inner glow */
            -moz-box-shadow: 0 0 20px #292929 inset;
            -webkit-box-shadow: 0 0 20px #292929 inset;
            box-shadow: 0 0 20px #292929 inset;
        }
        
        #carbonForm,
        .fieldContainer,
        .errorTip {
            /* Rounding the divs at once */
            -moz-border-radius: 12px;
            -webkit-border-radius: 12px;
            border-radius: 12px;
        }
        
        .formRow {
            height: 35px;
            padding: 10px;
            position: relative;
        }
        
        .label {
            float: left;
            padding: 0 20px 0 0;
            text-align: right;
            width: 70px;
        }
        
        label {
            font-family: Century Gothic, Myriad Pro, Arial, Helvetica, sans-serif;
            font-size: 11px;
            letter-spacing: 1px;
            line-height: 35px;
        }
        
        .field {
            float: left;
        }
        
        .field input {
            /* The text boxes */
            border: 1px solid white;
            color: #666666;
            font-family: Arial, Helvetica, sans-serif;
            font-size: 22px;
            padding: 4px 5px;
            background: url("/book/Public/img/box_bg.png") repeat-x scroll left top #FFFFFF;
            outline: none;
            /* Preventing the default Safari and Chrome text box highlight */
        }
        
        .signupButton {
            /* The submit button container */
            text-align: center;
            padding: 30px 0 10px;
        }
        
        #submit {
            /* The submit button */
            border: 1px solid #f4f4f4;
            cursor: pointer;
            height: 40px;
            text-indent: -9999px;
            _text-indent: 0;
            text-transform: uppercase;
            width: 110px;
            background: url("/book/Public/img/submit.png") no-repeat center center #d0ecfd;
            -moz-border-radius: 6px;
            -webkit-border-radius: 6px;
            border-radius: 6px;
        }
        
        #submit.active {
            /* Marking the submit button as active adds the preloader gif as background */
            background-image: url("/book/Public/img/preloader.gif");
        }
        
        #submit:hover {
            background-color: #dcf2ff;
            border: 1px solid white;
        }
        
        input:hover,
        input:focus {
            -moz-box-shadow: 0 0 8px lightblue;
            -webkit-box-shadow: 0 0 8px lightblue;
            box-shadow: 0 0 8px lightblue;
        }
        
        .errorTip {
            /* The error divs */
            background-color: #970F08;
            color: white;
            font-size: 10px;
            height: 26px;
            letter-spacing: 0.4px;
            margin-left: 20px;
            padding: 5px 0 5px 10px;
            position: absolute;
            text-shadow: 1px 1px 0 #555555;
            width: 200px;
            right: -130px;
        }
        /* The styles below are only necessary for the styling of the demo page: */
        
        #footer {
            position: fixed;
            bottom: 0;
            width: 100%;
            padding: 10px;
            color: #eee;
            text-align: center;
            font-weight: normal;
            font-style: italic;
        }
        
        a,
        a:visited {
            color: #0196e3;
            text-decoration: none;
            outline: none;
        }
        
        a:hover {
            text-decoration: underline;
        }
        
        a img {
            border: none;
        }
    </style>
</head>

<body>
    <div id="carbonForm">
        <h1>Register</h1>
        <p style="text-align:center;color:red;"><?php echo ($error["zidong"]); ?>&nbsp<?php echo ($error["user"]); ?>&nbsp&nbsp<?php echo ($error["verify"]); ?></p>
        <form action="<?php echo U('/resi');?>" method="post" id="signupForm">
            <div class="fieldContainer">
                <div class="formRow">
                    <div class="label">
                        <label for="name">学号:</label>
                    </div>
                    <div class="field">
                        <input type="text" name="id" value="<?php echo ($data['user']); ?>">
                    </div>
                </div>
                <div class="formRow">
                    <div class="label">
                        <label for="name">密码:</label>
                    </div>
                    <div class="field">
                        <input type="password" name="pwd" value="<?php echo ($data['password']); ?>">
                    </div>
                </div>
                <div class="formRow">
                    <div class="label">
                        <label for="name">确认密码:</label>
                    </div>
                    <div class="field">
                        <input type="password" name="twopwd" value="<?php echo ($data['password1']); ?>">
                    </div>
                </div>
                <div class="formRow">
                    <div class="label">
                        <label for="name">邮箱:</label>
                    </div>
                    <div class="field">
                        <input type="text" name="email" value="<?php echo ($data['email']); ?>">
                    </div>
                </div>
                <div class="formRow">
                </div>
                <div class="formRow">
                    <div class="label">
                        <label for="pass">验证码:</label>
                    </div>
                    <div class="field">
                        <input name="verify" type="text" size="8" />
                    </div>
                    <img src="<?php echo U('Base/createVerify');?>" title="点击刷新验证码" onClick="changeVerify()" />
                </div>
            </div>
            <div class="signupButton">
                <input type="submit" name="submit" id="submit" value="submit" />
            </div>
        </form>
    </div>
</body>

</html>