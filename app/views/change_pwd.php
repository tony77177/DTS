
<?php require_once('common/header.php');?>

<div class="container">
    <div class="row">

        <?php require_once('common/menu.php');?>

        <div class="col-xs-10">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><span class="glyphicon glyphicon-cog"></span> 密码修改</h3>
                </div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form">
                        <div class="form-group">
                            <label for="curr_pwd" class="col-sm-2 control-label">当前密码</label>
                            <div class="col-sm-10">
                                <input type="password" class="form-control" id="curr_pwd" name="curr_pwd" placeholder="请输入当前密码">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="new_pwd" class="col-sm-2 control-label">新密码</label>
                            <div class="col-sm-10">
                                <input type="password" class="form-control" id="new_pwd" name="new_pwd" placeholder="请输入新密码">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="confirm_pwd" class="col-sm-2 control-label">确认密码</label>
                            <div class="col-sm-10">
                                <input type="password" class="form-control" id="confirm_pwd" name="confirm_pwd" placeholder="请再次输入确认密码">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="button" class="btn btn-primary" id="change_pwd">修改</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function(){
        $("#change_pwd").click(function(){
            var curr_pwd = $("#curr_pwd").val();
            var new_pwd = $("#new_pwd").val();
            var confirm_pwd = $("#confirm_pwd").val();
            if (curr_pwd == '' || new_pwd == '' || confirm_pwd == '') {
                art.dialog({
                    id: 'warning',
                    title: '提示',
                    content: '相关信息不能为空',
                    icon: 'error',
                    time: 2,
                    drag: false,
                    resize: false
                });
                return false;
            } else if (new_pwd != confirm_pwd) {
                art.dialog({
                    id: 'warning',
                    title: '提示',
                    content: '新密码两次输入不一致，请重新输入',
                    icon: 'error',
                    time: 2,
                    drag: false,
                    resize: false
                });
                return false;
            } else {
                $("#change_pwd").html('修改中...');
                $("#change_pwd").attr('disabled',true);
                $.ajax({
                    url:"<?php echo site_url('index/change_pwd') ?>",
                    type:"POST",
                    data:{curr_pwd: curr_pwd, new_pwd: new_pwd},
                    success:function(msg){
                        if (msg == 'fail') {
                            art.dialog({
                                id: 'warning',
                                title: '提示',
                                content: '当前密码错误，请重新输入',
                                icon: 'error',
                                time: 2,
                                drag: false,
                                resize: false
                            });
                            $("#change_pwd").html("修改");
                            $("#change_pwd").attr('disabled', false);
                            $("#curr_pwd").focus();
                            return false;
                        } else if (msg == 'ok'){
                            art.dialog({
                                id: 'success',
                                title: '提示',
                                content: '修改成功，2秒后自动跳转',
                                icon: 'succeed',
                                time: 2,
                                drag: false,
                                resize: false
                            });
                            $("#change_pwd").html("修改成功");
                            setTimeout("window.location.href='<?php echo site_url() ?>'",2000)
                        } else {
                            art.dialog({
                                id: 'warning',
                                title: '提示',
                                content: '修改失败，请稍后再试',
                                icon: 'error',
                                time: 2,
                                drag: false,
                                resize: false
                            });
                            $("#change_pwd").html("修改失败");
                        }
                    },
                    error:function(){
                        art.dialog({
                            id: 'warning',
                            title: '提示',
                            content: '数据库连接出错，请稍后再试',
                            icon: 'error',
                            time: 3,
                            drag: false,
                            resize: false
                        });
                        $("#change_pwd").html("修改失败");
                    }
                });
            }
        });
    });

    $(document).keyup(function (event) {
        if (event.keyCode == 13) {
            $("#change_pwd").click();
        }
    });
</script>

<?php require_once('common/footer.php');?>