<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>后台管理系统</title>
    <link rel="stylesheet" href="/plancar/Public/Admin/css/reset.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="/plancar/Public/Admin/css/style.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="/plancar/Public/Admin/css/invalid.css" type="text/css" media="screen" />
    <!--<link rel="stylesheet" href="/plancar/Public/Admin/css/expand.css" type="text/css" media="screen" />-->
    <script type="text/javascript" src="/plancar/Public/Admin/js/jquery-1.9.1.min.js"></script>
</head>
<body>
<!--主页面-->
<div id="main-content">
    <div class="content-box">
        <!--头部切换-->
        <div class="content-box-header">
            <h3>会员列表</h3>
            <div class="clear"></div>
        </div>

        <div class="content-search" style="height: 40px;margin: 10px 0 0 10px;">
            <form action="<?php echo U('User/msg');?>" method="post">
                用户名：<input type="text" name="name" class="text-input">
                手机号：<input type="text" name="tel" class="text-input">

                <input type="submit" class="button search-btn" value="查询">
            </form>
        </div>

        <!--表格内容-->
        <div class="content-box-content">
            <!--内容表格 start-->
            <div class="tab-content default-tab" id="tab1">
                <table border="1">
                    <!--标题 start-->
                    <thead>
                    <tr>
                        <th width="5%">ID</th>
                        <th width="10%">姓名</th>
                        <th width="10%">电话</th>
                        <th width="45%">内容</th>
                        <th width="10%">创建时间</th>
                        <th width="10%">状态</th>
                        <th width="10%">操作</th>
                    </tr>
                    </thead>
                    <!--标题 end-->
                    <!--内容 start-->
                    <tbody>
                    <?php if(is_array($msglist)): $i = 0; $__LIST__ = $msglist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$user): $mod = ($i % 2 );++$i;?><tr>
                            <td><?php echo ($user["id"]); ?></td>
                            <td><?php echo ($user["name"]); ?></td>
                            <td>
                                <?php echo ($user["tel"]); ?>
                            </td>
                            <td>
                                <?php echo ($user["text"]); ?>
                            </td>
                            <td>
                                <?php echo (date("Y/m/d",$user["ctime"])); ?>
                            </td>
                            <td>
                                <?php if($user['status'] == 1): ?>已处理<?php else: ?>未处理<?php endif; ?>
                            </td>
                            <td>
                                <?php if($user['status'] == 0): ?><a href="<?php echo U('User/updMsg',array('id'=>$user['id']));?>" title="处理">
                                    <img src="/plancar/Public/Admin/images/icons/pencil.png" width="16" height="18" alt="处理" />
                                </a><?php endif; ?>
                                <a href="###" class="del" title="删除" uid="<?php echo ($user["id"]); ?>">
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
            </div>
            <!--内容表格 end-->
        </div>
    </div>
</div>
</body>
<script type="text/javascript">
    $(document).ready(function(){
        //删除类型
        $('.del').click(function(){
            if(confirm('确定要删除吗')){
                var id = $(this).attr("uid");

                window.location.href = "<?php echo U('User/delMsg');?>/id/"+id;
            }
        });
    });
</script>
</html>