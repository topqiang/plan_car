<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>后台管理系统</title>
    <link rel="stylesheet" href="/plancar/Public/Admin/css/reset.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="/plancar/Public/Admin/css/style.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="/plancar/Public/Admin/css/invalid.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="/plancar/Public/Admin/css/expand.css" type="text/css" media="screen" />
    <script type="text/javascript" src="/plancar/Public/Admin/js/jquery-1.9.1.min.js"></script>
    <script type="text/javascript" src="/plancar/Public/Admin/js/layer/layer.js"></script>
</head>
<body>
<!--主页面-->
<div id="main-content">
    <div class="content-box">
        <!--提示-->
        <div class="notification success png_bg" style="display:none">
            <div></div>
        </div>
        <div class="notification error png_bg n-error" style="display:none">
            <div></div>
        </div>
        <!--头部切换-->
        <div class="content-box-header">
            <h3>时段列表</h3>
            <ul class="content-box-tabs">
                <li><a id="add">新增</a></li>
            </ul>
            <div class="clear"></div>
        </div>
        <!--表格内容-->
        <div class="content-box-content">
            <!--内容表格 start-->
            <div class="tab-content default-tab" id="tab1">
                <form action="<?php echo U('AdminBasic/delList',array('tname'=>'Date','type'=>'real'));?>" method="post">
                    <table border="1">
                        <!--标题 start-->
                        <thead>
                        <tr>
                            <th width="10%">ID</th>
                            <th width="20%">时段</th>
                            <th width="30%">状态</th>
                            <th width="30%">时间</th>
                            <th width="10%">操作</th>
                        </tr>
                        </thead>
                        <!--标题 end-->
                        <!--内容 start-->
                        <tbody>
                        <?php if(is_array($datelist)): $i = 0; $__LIST__ = $datelist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$art): $mod = ($i % 2 );++$i;?><tr>
                                <td><?php echo ($art['id']); ?></td>
                                <td>
                                    <?php echo ($art['time']); ?>
                                </td>
                                <td>
                                    <?php if($art['istrue'] == 1): ?>可选
                                        <?php else: ?>
                                        不可选<?php endif; ?>
                                </td>
                                <td>
                                    <?php echo (date('Y-m-d',$art['ctime'])); ?>
                                </td>
                                <td>
                                    <a class="edit" title="修改状态" id="<?php echo ($art['id']); ?>" istrue="<?php echo ($art['istrue']); ?>">
                                        <img src="/plancar/Public/Admin/images/icons/pencil.png" width="16" height="18" alt="修改状态" />
                                    </a>&nbsp;
                                    <a class="del" title="删除" id="<?php echo ($art['id']); ?>" istrue="<?php echo ($art['istrue']); ?>">
                                        <img src="/plancar/Public/Admin/images/icons/cross.png" alt="删除" />
                                    </a>
                                </td>
                            </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                        </tbody>
                        <!--内容 end-->
                        <!--表尾 start-->
                        <tfoot>
                        <tr>
                            <td colspan="20">
                                <div class="bulk-actions align-left">
                                </div>
                                <div class="pagination">
                                    <?php echo ($page); ?>
                                </div>
                                <div class="clear"></div>
                            </td>
                        </tr>
                        </tfoot>
                        <!--表尾 end-->
                    </table>
                </form>
            </div>
            <!--内容表格 end-->
        </div>
    </div>
    <div class="tab-content adddiv disn" style="padding:20px;">
        <fieldset>
        <form>
            <p>
                <label>分类名称</label>
                <input class="text-input small-input time" type="text" id="small-input" name="time" />
            </p>
            <p>
                <label>是否可选</label>
                <input class="istrue" type="radio" name="isture" value="1" checked>可选
                <input class="istrue" type="radio" name="isture" value="0">不可选
            </p>
            <p>
                <input class="button texcen" value="保存"/>
            </p>
            </form>
        </fieldset>
        <div class="clear"></div>
    </div>
</div>
</body>
<script type="text/javascript">
        $(".del").on('click',function () {
            if(confirm('确定要删除吗')){
                var id = $(this).attr("id");
                $.ajax({
                    url: '<?php echo U("Date/delDate");?>',
                    type: 'post',
                    dataType: 'json',
                    data: {id:id},
                    success: function ( res ) {
                        if (res.flag == "success") {
                            window.location.reload();
                        }
                        layer.msg(res.message);
                    }
                });    
            }
        });

        $(".button").on('click',function () {
            
            var time = $(".time").val();
            var isture = $(".istrue").val();

            if (!/^\d{1,2}:\d{2}$/.test( time )) {
                layer.msg("您输入的时段不合法！");
                return;  
            }

            $.ajax({
                "url" : "<?php echo U('Date/addDate');?>",
                "type" : "post",
                "dataType" : "json",
                "data" : {"time":time,"istrue":isture},
                "success" : function ( res ) {
                    if ( res.flag == "success" ) {
                        window.location.reload();
                    }else{
                        layer.msg( res.message );
                    }
                }
            })

        });

        $("#add").on('click',function () {
            layer.open({
                "type" : 1,
                "title" : "添加时段",
                "area" : ["300px",""],
                "content" : $(".adddiv")
            });
        });

        $(".edit").on('click',function () {
            var id = $(this).attr("id");
            var istrue = $(this).attr("istrue");

            $.ajax({
                url: '<?php echo U("Date/editDate");?>',
                type: 'post',
                dataType: 'json',
                data: {id:id,istrue:istrue},
                success: function ( res ) {
                    if (res.flag == "success") {
                        window.location.reload();
                    }
                    layer.msg(res.message);
                }
            });
        });
</script>
</html>