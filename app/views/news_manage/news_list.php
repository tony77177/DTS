<?php $this->load->view('common/header.php');?>

<div class="container">
    <div class="row">

        <?php $this->load->view('common/menu.php');?>

        <div class="col-xs-10">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><span class="glyphicon glyphicon-book"></span> 文章管理列表</h3>
                </div>
                <div class="panel-body">
                    <div style="margin-bottom: 10px;">
                        <a href="<?php echo site_url('news_list/add'); ?>" class="btn btn-primary" role="button"><span class="glyphicon glyphicon-plus"></span> 添加文章</a>
                    </div>
                    <table class="table table-bordered table-striped table-hover">
                        <thead>
                            <tr>
                                <th>标题</th>
                                <th>作者</th>
                                <th>时间</th>
                                <th>操作</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            for ($i = 0; $i < count($news_list); $i++) {
                                ?>
                                <tr id="news_list_<?=$news_list[$i]["id"];?>">
                                    <td>
                                        <a>
                                            <?php echo $this->common_class->SubContents($news_list[$i]["title"],30);?>
                                        </a>
                                    </td>
                                    <td><?php echo $news_list[$i]["author"];?></td>
                                    <td><?php echo $news_list[$i]["create_dt"];?></td>
                                    <td id="news_list_operate_<?=$news_list[$i]["id"];?>">
                                        <a href="<?php echo site_url('news_list/edit'); ?>/<?=$news_list[$i]["id"];?>"><span class="glyphicon glyphicon-edit"></span> 编辑</a> &emsp;
                                        <a href="javascript:del('<?=$news_list[$i]["id"];?>');"><span class="glyphicon glyphicon-remove"></span> 删除</a>
                                    </td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>

                    <?php
                    if (count($news_list) == 0) {
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
       $("#news_list").attr('class','active');
    });

    function del(_id) {
        var news_list = 'news_list_' + _id;
        var news_operate = 'news_list_operate_' + _id;

        art.dialog({
            title: '提示',
            content: '确定要删除吗？',
            icon: 'question',
            drag: false,
            resize: false,
            ok: function () {

                art.dialog({
                    id: 'del_news',
                    cancel: false,
                    drag: false,
                    resize: false
                });
                art.dialog.get('del_news').title('操作中...').lock();

                $.post("<?php echo site_url('news_list/del') ?>",{_uuid: _id},function(msg){
                    art.dialog.get('del_news').close();
                    if (msg == 'fail') {
                        art.dialog({
                            id: 'warning',
                            title: '提示',
                            content: '删除失败，请稍后再试',
                            icon: 'error',
                            time: 2,
                            drag: false,
                            resize: false
                        });
                    } else {
                        art.dialog({
                            id: 'success',
                            title: '提示',
                            content: '删除成功',
                            icon: 'succeed',
                            time: 2,
                            drag: false,
                            resize: false
                        });
                        $("#" + news_list).attr('class', 'removed');
                        $("#" + news_operate).hide();
                    }
                });
            },
            cancelVal: '关闭',
            cancel: true
        });
    }

</script>

<style>
    tr.removed {
        color: #c0c0c0;
        text-decoration: line-through;
    }
</style>

<?php $this->load->view('common/footer.php');?>