<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <title>后台登录</title>
    <base href="<?php echo base_url() ?>">
    <meta charset="utf-8">

    <!-- Bootstrap -->
    <link href="res/bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->

    <!-- Jquery -->
    <script src="res/common/js/jquery-1.10.2.min.js"></script>

    <!-- artDialog -->
    <script src="res/artDialog/artDialog.js?skin=idialog"></script>

    <style>
        body {
            padding-top: 40px;
            padding-bottom: 40px;
            background-color: #eee;
        }

        .form-signin {
            max-width: 330px;
            padding: 15px;
            margin: 0 auto;
        }

        .form-signin .form-signin-heading,
        .form-signin {
            margin-bottom: 10px;
        }

        .form-signin .form-control {
            position: relative;
            font-size: 16px;
            height: auto;
            padding: 10px;
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
            box-sizing: border-box;
        }

        .form-signin .form-control:focus {
            z-index: 2;
        }

        .form-signin input[type="text"] {
            margin-bottom: -1px;
            border-bottom-left-radius: 0;
            border-bottom-right-radius: 0;
        }

        .form-signin input[type="password"] {
            margin-bottom: 10px;
            border-top-left-radius: 0;
            border-top-right-radius: 0;
        }

        #info {
            display: none;;
        }

        .form-signin-heading{
            text-align: center;
        }
    </style>
</head>

<body>

<div class="container">

    <form class="form-signin" role="form">
        <h2 class="form-signin-heading">后台管理登录</h2>
        <input type="text" class="form-control" id="user_name" name="user_name" placeholder="用户名"><br>
        <input type="password" class="form-control" id="password" name="password" placeholder="密码">
        <button class="btn btn-lg btn-primary btn-block" id="login_btn" type="button">登录</button>
        <div id="info"></div>
    </form>

</div>

</body>

<script>
    $(document).ready(function () {
        $("#user_name").focus();

        $("#login_btn").click(function () {
            var user = $("#user_name").val();
            var pwd = $("#password").val();
            if (user == "" || pwd == "") {
                art.dialog({
                    id: 'warning',
                    title: '提示',
                    content: '用户名或密码不能为空',
                    icon: 'error',
                    time: 2,
                    drag: false,
                    resize: false
                });
                return false;
            } else {
                $("#login_btn").html("登录中，请稍后...");
                $("#login_btn").attr('disabled', true);
                $.ajax({
                    url: "<?php echo site_url('login/check_login') ?>",
                    type: "POST",
                    data: {user_name: user, pass_word: pwd},
                    success: function (msg) {
                        if (msg == 'fail') {
                            art.dialog({
                                id: 'warning',
                                title: '提示',
                                content: '用户名或密码错误',
                                icon: 'error',
                                time: 2,
                                drag: false,
                                resize: false
                            });
                            $("#login_btn").html("登录");
                            $("#login_btn").attr('disabled', false);
                            return false;
                        } else {
                            $("#info").html(msg);
                        }
                    },
                    error: function () {
                        art.dialog({
                            id: 'warning',
                            title: '提示',
                            content: '数据库连接出错，请稍后再试',
                            icon: 'error',
                            time: 3,
                            drag: false,
                            resize: false
                        });
                        $("#login_btn").html("登录失败");
                    }
                });
            }
        });

        $(document).keyup(function (event) {
            if (event.keyCode == 13) {
                $("#login_btn").click();
            }
        });
    });
</script>
</html>