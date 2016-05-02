<?php $this->load->view('common/header.php');?>

<div class="container">
    <div class="row">

        <?php $this->load->view('common/menu.php');?>

        <div class="col-xs-10">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><span class="glyphicon glyphicon-comment"></span> 留言管理列表</h3>
                </div>
                <div class="panel-body">
                    <table class="table table-bordered table-striped table-hover">
                        <thead>
                        <tr>
                            <th>姓名</th>
                            <th>内容</th>
                            <th>电话</th>
                            <th>时间</th>
                            <th>操作</th>
                        </tr>
                        </thead>
                        <tbody>
                            <?php
                            for ($i = 0; $i < count($message_list); $i++) {
                                ?>
                                <tr>
                                    <td id="user_name_<?=$i;?>"><?php echo $message_list[$i]["name"];?></td>
                                    <td id="content_<?=$i;?>">
                                        <a class="show_all" data-toggle="tooltip" title="<?php echo $message_list[$i]["content"];?>" >
                                            <?php echo $this->common_class->SubContents($message_list[$i]["content"]);?>
                                        </a>
                                    </td>
                                    <td id="phone_number_<?=$i;?>"><?php echo $message_list[$i]["phone_number"];?></td>
                                    <td id="add_time_<?=$i;?>"><?php echo $message_list[$i]["create_dt"];?></td>
                                    <td>
                                        <a href="javascript:send_email(<?=$i;?>);"><span class="glyphicon glyphicon-cloud-upload"></span> 发送到邮箱</a>
                                    </td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>

                    <?php
                    if (count($message_list) == 0) {
                        echo "<p align=\"center\" style=\"color:red\">没有数据！</p>";
                    }
                    ?>

                    <div>
                        <?php echo $pagination;?>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function(){
        $("#message_list").attr('class','active');
    });

    function send_email(_id) {

        var user_name = 'user_name_' + _id;
        var user_name = $("#" + user_name).text()

        var phone_number = 'phone_number_' + _id;
        var phone_number = $("#" + phone_number).text()

        var add_time = 'add_time_' + _id;
        var add_time = $("#" + add_time).text()

        var content = 'content_' + _id;
        var content = $("#" + content).text()

        art.dialog({
            title: '提示',
            content: '确定要发送吗？',
            icon: 'question',
            drag: false,
            resize: false,
            ok: function () {
                art.dialog({
                    id: 'send_mail',
                    cancel: false,
                    drag: false,
                    resize: false
                });
                art.dialog.get('send_mail').title('发送中...').lock();

                $.ajax({
                    url: "<?php echo site_url('message_list/send_mail') ?>",
                    type: "POST",
                    data: {user_name: user_name, phone_number: phone_number, add_time: add_time, content: content},
                    success: function (msg) {
                        art.dialog.get('send_mail').close();
                        if (msg == 'fail') {
                            art.dialog({
                                id: 'warning',
                                title: '提示',
                                content: '发送失败，请稍后再试',
                                icon: 'error',
                                time: 2,
                                drag: false,
                                resize: false
                            });
                            return false;
                        } else {
                            art.dialog({
                                id: 'succeed',
                                title: '提示',
                                content: '发送成功，请查收',
                                icon: 'succeed',
                                time: 2,
                                drag: false,
                                resize: false
                            });
                            return false;
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
                    }
                });
            },
            cancelVal: '关闭',
            cancel: true
        });
    }

    $(".show_all").tooltip({
        placement:'auto bottom',
        html:'true'
    });

</script>

<?php $this->load->view('common/footer.php');?>