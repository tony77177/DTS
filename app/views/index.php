
<?php require_once('common/header.php');?>

<div class="container">

    <div class="row" style="margin: 0;min-height:300px;margin-top: 50px;">

        <!-- Nav tabs -->
        <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">单个查询</a></li>
            <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">批量查询</a></li>
        </ul>

        <!-- Tab panes -->
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="home">
                <div class="jumbotron search-box" id="single_search_box">
                    <p>请输入查询域名：</p>
                    <div class="input-group">
                        <input placeholder="比如：www.baidu.com"
                               type="text" id="search_info" class="form-control" value="">
                    <span class="input-group-btn scan-but-span">
                        <button class="btn btn-info" id="btn_search" type="button">查询</button>
                    </span>
                    </div>

                </div>
            </div>
            <div role="tabpanel" class="tab-pane" id="profile">
                <div class="form-group">
                    <input id="file-1" type="file" multiple class="file">
                    <div id="errorBlock" class="help-block"></div>
                </div>
            </div>
        </div>

    </div>

<!--    <div class="row" style="margin: 0;min-height:300px;margin-top: 100px;">-->
<!--        <ul class="nav nav-tabs">-->
<!--            <li role="presentation" class="active"><a href="#">Home</a></li>-->
<!--            <li role="presentation"><a href="javascript:" onclick="switch_btn(1)">Profile</a></li>-->
<!--            <li role="presentation"><a href="#">Messages</a></li>-->
<!--        </ul>-->
<!---->
<!--    </div>-->
</div>

<script>

    $("#file-1").fileinput({
        uploadUrl: '<?php echo site_url('index/get_info_by_file') ?>', // you must set a valid URL here else you will get an error
        allowedFileExtensions : ['xls', 'xlsx'],
        //overwriteInitial: false,
        maxFileSize: 2000,
        maxFilesNum: 1,
        showCancel: true,
        maxFileCount: 1,
        uploadAsync: true,
        //allowedFileTypes: ['image', 'video', 'flash'],
//        slugCallback: function(filename) {
//            return filename.replace('(', '_').replace(']', '_');
//        }

        language: 'zh', //设置语言
        //allowedFileExtensions : ['xls', 'xlsx'],
//        uploadUrl: uploadUrl, //上传的地址
        //allowedFileExtensions : ['jpg', 'png','gif'],//接收的文件后缀
//        showUpload: false, //是否显示上传按钮
        showCaption: false,//是否显示标题
//        browseClass: "btn btn-primary", //按钮样式
//        previewFileIcon: "<i class='glyphicon glyphicon-king'></i>",
    });






    $(document).ready(function() {

        $("#btn_search").click(function(){
            var search_info = $("#search_info").val();
            if(search_info==''){
                var d = dialog({
                    content: '请输入查询域名'
                });
                d.show();
                setTimeout(function () {
                    d.close().remove();
                }, 2000);
                return false;
            }

            //loading事件
            dialog({
                id:'result_info',
                title:'查询中，请稍后...',
                width:150
            }).show();

            $("#btn_search").attr(' disabled="disabled');

            $.post("<?php echo site_url('index/get_info') ?>", {_search_info: search_info}, function (msg){
                if(msg=='fail'){
                    var d = dialog({
                        title: '结果',
                        content: '查询失败，请确认输入数据正确性'
                    });
                    d.show();
                    dialog.get('result_info').close();
                }else{
                    dialog.get('result_info').width('auto');
                    dialog.get('result_info').title('查询结果');
                    dialog.get('result_info').content(msg);
                }

            });
        });

        /* 响应回车事件 */
        /*document.onkeydown = function(event){
            if(event.keyCode==13) {
                document.getElementById("btn_search").click();
                return false;
            }
        };*/

        /*just for test result box hidden*/


    });

</script>


<?php require_once('common/footer.php');?>