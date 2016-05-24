
<?php require_once('common/header.php');?>

<div class="container">
    <div class="row" style="margin: 0;min-height:300px;margin-top: 100px;">
        <div class="jumbotron search-box">
            <p>请输入查询域名：</p>

            <div class="input-group">
                <input placeholder="比如：www.baidu.com"
                       type="text" id="search_info" class="form-control" value="">
                    <span class="input-group-btn scan-but-span">
                        <button class="btn btn-info" id="btn_search" type="button">查询</button>
                    </span>
            </div>
            <div class="input-group mt15 geetest-box hidden">
                <script type="text/javascript"
                        src="http://api.geetest.com/get.php?gt=ae3fdacc1cc224b6d5fcf0c4e25c03cb"></script>
            </div>

            <div id="scan-result-box">

            </div>
        </div>
    </div>
</div>

<script>
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

            $.post("<?php echo site_url('index/get_info') ?>", {_search_info: search_info}, function (msg){
                if(msg==''){
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
        document.onkeydown = function(event){
            if(event.keyCode==13) {
                document.getElementById("btn_search").click();
                return false;
            }
        };
    });

</script>


<?php require_once('common/footer.php');?>