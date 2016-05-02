<?php $this->load->view('common/header.php');?>

    <script charset="utf-8" src="res/kindeditor/kindeditor.js"></script>
    <script charset="utf-8" src="res/kindeditor/lang/zh_CN.js"></script>

    <script>
        $(document).ready(function(){
            $("#health_list").attr('class','active');

            var editor;
            KindEditor.ready(function(K) {
                KindEditor.options.filterMode = false;
                var options = {
                    items:[
                        'source', '|', 'undo', 'redo', '|', 'preview', 'template', 'cut', 'copy', 'paste',
                        'plainpaste', 'wordpaste', '|', 'justifyleft', 'justifycenter', 'justifyright',
                        'justifyfull', 'insertorderedlist', 'insertunorderedlist', 'indent', 'outdent', 'subscript',
                        'superscript', 'clearhtml', 'quickformat', '|', 'fullscreen', '/',
                        'formatblock', 'fontname', 'fontsize', '|', 'forecolor', 'hilitecolor', 'bold',
                        'italic', 'underline', 'strikethrough', 'lineheight', 'removeformat', '|', 'image',
                        'insertfile', 'table', 'hr', 'baidumap', 'pagebreak',
                        'link', 'unlink'
                    ]
                };
                editor = K.create('textarea[name="content"]',options);
            });

            $("#_edit").click(function(){
                var title = $("#title").val();
                var content = editor.html();
                var uuid = $("#uuid").val();

                if (title == '' || content == '') {
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
                }else{
                    $("#_edit").html('修改中...');
                    $("#_edit").attr('disabled',true);
                    art.dialog({
                        id: 'edit_news',
                        cancel: false,
                        drag: false,
                        resize: false
                    });
                    art.dialog.get('edit_news').title('修改中...').lock();
                    $.post("<?php echo site_url() ?>/health_list/edit/"+uuid, {_title: title, _content: content}, function (msg) {
                        art.dialog.get('edit_news').close();
                        if (msg == 'ok') {
                            art.dialog({
                                id: 'success',
                                title: '提示',
                                content: '修改成功，2秒后自动跳转',
                                icon: 'succeed',
                                time: 2,
                                drag: false,
                                resize: false
                            });
                            $("#_edit").html('修改成功.');
                            setTimeout("window.location.href='<?php echo site_url() ?>/health_list'",2000)
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
                            $("#_edit").html('修改失败.');
                        }
                    });
                }
            });
        });
    </script>

    <div class="container">
        <div class="row">

            <?php $this->load->view('common/menu.php');?>

            <div class="col-xs-10">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title"><span class="glyphicon glyphicon-plus-sign"></span> 修改文章</h3>
                    </div>
                    <div class="panel-body">

                        <form class="form-horizontal" role="form">
                            <div class="form-group">
                                <label for="title" class="col-sm-2 control-label">标题</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="title" name="title" placeholder="请输入文章标题" value="<?=$news_info[0]['title'];?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">标题</label>
                                <div class="col-sm-10">
                                    <textarea id="editor_content" name="content" style="height:300px;"><?=$news_info[0]['content'];?></textarea>
                                </div>

                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <button type="button" class="btn btn-primary" id="_edit">修改</button>&emsp;
                                    <a href="<?php echo site_url('health_list'); ?>" class="btn btn-default" role="button">返回列表</a>
                                    <input type="hidden" value="<?php echo $uuid;?>" id="uuid">
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

<?php $this->load->view('common/footer.php');?>