
<?php require_once('common/header.php');?>

<div class="container">
    <div class="row" style="margin: 0;min-height:300px">
        <div class="jumbotron search-box">
            <p>请输入查询域名：</p>

            <div class="input-group">
                <input placeholder="比如：www.baidu.com"
                       type="text" id="search_info" class="form-control" value="">
                    <span class="input-group-btn scan-but-span">
                        <button class="btn btn-success" id="btn_search" type="button">查找</button>
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
            $.post("<?php echo site_url('index/get_info') ?>", {_search_info: search_info}, function (msg){
                $("#btn_search").html('查询中...');
                if(msg==''){
                    var d = dialog({
                        title: '结果',
                        content: '查询失败，请确认输入数据正确性'
                    });
                    d.show();
                }else{
                    /*$.each(msg,function(key,val){
                        console.log('index in arr:' + key + ", corresponding value:" + val);
                    });*/

                    var d = dialog({
                        title: '结果',
                        content: msg
                    });
                    d.show();
                }

            });
        });
    });

</script>


<?php require_once('common/footer.php');?>