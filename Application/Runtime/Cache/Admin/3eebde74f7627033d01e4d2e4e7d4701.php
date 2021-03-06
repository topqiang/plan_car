<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>后台管理系统</title>
	<link rel="stylesheet" href="/plancar/Public/Admin/css/reset.css" type="text/css" media="screen" />
	<link rel="stylesheet" href="/plancar/Public/Admin/css/style.css" type="text/css" media="screen" />
	<link rel="stylesheet" href="/plancar/Public/Admin/css/invalid.css" type="text/css" media="screen" />
	<script type="text/javascript" src="/plancar/Public/Admin/js/jquery-1.9.1.min.js"></script>
</head>
<body>
<div id="main-content">
	<div class="content-box">
		<!--头部切换-->
		<div class="content-box-header">
			<h3>商家列表</h3>
			<ul class="content-box-tabs">
				<li><a href="<?php echo U('Shop/shoplist');?>" class="default-tab current">商家列表</a></li>
				<li><a href="<?php echo U('Shop/addshop');?>">添加商家</a></li>
			</ul>
			<div class="clear"></div>
		</div>

		<div class="content-search" style="height: 40px;margin: 10px 0 0 10px;">
			<form action="<?php echo U('Shop/shoplist');?>" method="post">
				商家店名：<input type="text" name="title" class="text-input" value="<?php echo ($_REQUEST['title']); ?>">
				老板名：<input type="text" name="boss" class="text-input" value="<?php echo ($_REQUEST['boss']); ?>">
				<input type="submit" class="button search-btn" value="查询">
			</form>
		</div>
		
		<!--表格内容-->
		<div class="content-box-content">
			<div class="tab-content default-tab" id="tab1">
				<form action="<?php echo U('AdminBasic/delList',array('type'=>'real','tname'=>'Shop'));?>" method="post">
					<table border="1">
						<!--标题-->
						<thead>
						<tr>
							<th width="5%">
								<input class="check-all" type="checkbox" />
								ID
							</th>
							<th width="10%">商家店名</th>
							<th width="5%">老板名</th>
							<th width="10%">电话</th>
							<th width="15%">地址</th>
							<th width="10%">店铺余额</th>
							<th width="10%">入住时间</th>
							<th width="15%">银行账号</th>
							<th width="10%">开户行</th>
							<th width="10%">当前状态</th>
							<th width="5%">操作</th>
						</tr>
						</thead>
						<!--内容-->
						<tbody>
						<?php if(empty($list)): ?><tr><td colspan="10">没有符合条件的结果</td></tr><?php endif; ?>
						<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
								<td>
									<input type="checkbox" name="id[]" value="<?php echo ($vo['id']); ?>"/><?php echo ($vo["id"]); ?>
								</td>
								<td><?php echo ($vo["title"]); ?></td>
								<td><?php echo ($vo["boss"]); ?></td>
								<td><?php echo ($vo["tel"]); ?></td>
								<td><?php echo ($vo["address"]); ?></td>
								<td><?php echo ($vo["money"]); ?></td>
								<td><?php echo (date("y-m-d H:m:i",$vo["createtime"])); ?></td>

								<td><?php echo ($vo["banknum"]); ?></td>
								<td><?php echo ($vo["bankname"]); ?></td>
								<td>
									<?php if($vo['status'] == 0): ?>正常营业
									<?php else: ?>已关闭<?php endif; ?>
								</td>
								<td>
                                    <a href="<?php echo U('Shop/shopedit',array('id'=>$vo['id']));?>" title="编辑">
                                        <img src="/plancar/Public/Admin/images/icons/pencil.png" alt="Edit" />
                                    </a>
                                    <a href="<?php echo U('Shop/shopdel',array('id'=>$vo['id']));?>" title="删除">
                                        <img src="/plancar/Public/Admin/images/icons/cross.png" alt="Delete" />
                                    </a>
								</td>
							</tr><?php endforeach; endif; else: echo "" ;endif; ?>
						<!--表尾-->
						</tbody>
						<tfoot>
						<tr>
							<td colspan="20">
								<div class="bulk-actions align-left">
									<input type="submit" value="批量删除" class="button"/>
								</div>
								<div class="pagination">
									<?php echo ($page); ?>
								</div>
								<div class="clear"></div>
							</td>
						</tr>
						</tfoot>
					</table>
				</form>
			</div>
		</div>
	</div>
</div>
</body>
</html>