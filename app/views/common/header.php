<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <title>域名批量解析系统 V1.0</title>
    <base href="<?php echo base_url() ?>">
    <meta charset="utf-8">

    <!-- Bootstrap CSS -->
    <link href="res/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">


    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->

    <!-- Jquery -->
    <script src="res/common/js/jquery-1.10.2.min.js"></script>

    <!-- artDialog -->
    <link href="res/artDialog/css/ui-dialog.css" rel="stylesheet" type="text/css">
    <script src="res/artDialog/dist/dialog-min.js"></script>

    <!-- Bootstrap JS -->
    <script src="res/bootstrap/js/bootstrap.min.js"></script>

</head>

<body>

<!-- Fixed navbar -->
<div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/">域名批量解析系统</a>
        </div>
        <div class="navbar-collapse collapse">

            <!--<ul class="nav navbar-nav">
                <li class="active"><a href="<?php echo site_url(); ?>"><span class="glyphicon glyphicon-home"></span>
                        首页</a></li>
            </ul>

            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown active">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span
                            class="glyphicon glyphicon-user"></span> <?php echo $this->session->userdata('admin_info'); ?> <b
                            class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="<?php echo site_url('index/change_pwd');?>"><span class="glyphicon glyphicon-cog"></span> 修改密码</a></li>
                        <li class="divider"></li>
                        <li><a href="<?php echo site_url('login/login_out');?>"><span class="glyphicon glyphicon-off"></span> 退出</a></li>
                    </ul>
                </li>
            </ul>-->

        </div>
        <!--/.nav-collapse -->
    </div>
</div>

<div style="height:70px;"></div>