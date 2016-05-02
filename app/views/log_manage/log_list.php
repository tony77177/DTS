
<?php $this->load->view('common/header.php');?>

<div class="container">
    <div class="row">

        <?php $this->load->view('common/menu.php');?>

        <div class="col-xs-10">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><span class="glyphicon glyphicon-list-alt"></span> 登陆日志列表</h3>
                </div>
                <div class="panel-body">
                    <table class="table table-bordered table-striped table-hover">
                        <thead>
                        <tr>
                            <th>用户名</th>
                            <th>IP</th>
                            <th>时间</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        for ($i = 0; $i < count($log_list); $i++) {
                            ?>
                            <tr>
                                <td><a><?php echo $log_list[$i]["admin_name"];?></a></td>
                                <td><?php echo $log_list[$i]["ip_addr"];?></td>
                                <td><?php echo $log_list[$i]["log_dt"];?></td>
                            </tr>
                        <?php
                        }
                        ?>
                        </tbody>
                    </table>

                    <?php
                    if (count($log_list) == 0) {
                        echo "<p align=\"center\" style=\"color:red\">没有数据！</p>";
                    }
                    ?>

                    <div>
                        <?php echo $pagination; ?>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function(){
        $("#log_list").attr('class','active');
    });
</script>

<?php $this->load->view('common/footer.php');?>