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
    <script type="text/javascript" src="/plancar/Public/Admin/js/facebox.js"></script>
    <script type="text/javascript" src="/plancar/Public/Admin/js/jquery.wysiwyg.js"></script>
    <script type="text/javascript" src="/plancar/Public/Admin/js/trivial.jquery.js"></script>
    <script type="text/javascript" src="/plancar/Public/Admin/js/simpla.jquery.configuration.js"></script>
    <script type="text/javascript" src="/plancar/Public/Admin/js/ajax_operate.js"></script>
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
            <h3>API接口</h3>
            <ul class="content-box-tabs">

            </ul>
            <div class="clear"></div>
        </div>
        <!--表格内容-->
        <div class="content-box-content">
            <!--表单 start-->
            <div class="tab-content default-tab" id="tab1">
                <form action="<?php echo U('WeiXinArticle/editTextBack');?>" method="post" class="form">
                    <input type="hidden" name="wxa_id" value="<?php echo ($text_back['wxa_id']); ?>">
                    <fieldset>
                        <p>
                            <span class="label">url：　　</span>
                            <?php echo ($token['api_url']); ?>
                        </p>
                        <p>
                            <span class="label">token：　</span>
                            <?php echo ($token['token']); ?>
                        </p>
                        <p>
                            注：登陆微信公众号，进入开发模式，点击‘注册成为开发者’，填入url和token，将url中‘您的域名’字样换成您的英文域名。
                            提交成功后，开启开发模式，即可在后台进行配置。
                        </p>
                    </fieldset>
                    <div class="clear"></div>
                </form>
            </div>
            <!--表单 end-->
        </div>
    </div>
</div>
</body>
<script type="text/javascript">
    $(document).ready(function(){

    });
</script>
</html>