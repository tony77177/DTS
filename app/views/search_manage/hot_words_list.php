
<?php $this->load->view('common/header.php');?>

<div class="container">
    <div class="row">

        <?php $this->load->view('common/menu.php');?>

        <div class="col-xs-10">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><span class="glyphicon glyphicon-expand"></span> 搜索热词列表</h3>
                </div>
                <div class="panel-body">
                    <table class="table table-bordered table-striped table-hover">
                        <thead>
                        <tr>
                            <th>关键词</th>
                            <th>次数</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
//                        for ($i = 0; $i < count($log_list); $i++) {
//                            ?>
                            <tr>
                                <td><a>贵阳银行</a></td>
                                <td>10</td>
                            </tr>
                            <tr>
                                <td><a>公务员</a></td>
                                <td>5</td>
                            </tr>
                        <?php
//                        }
                        ?>
                        </tbody>
                    </table>

                    <?php
//                    if (count($log_list) == 0) {
//                        echo "<p align=\"center\" style=\"color:red\">没有数据！</p>";
//                    }
                    ?>

                    <div>
<!--                        --><?php //echo $pagination; ?>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function(){
        $("#hot_words_list").attr('class','active');
    });
</script>

<?php $this->load->view('common/footer.php');?>