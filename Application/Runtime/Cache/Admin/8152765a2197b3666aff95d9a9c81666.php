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
			<h3>预约列表</h3>
			<div class="clear"></div>
		</div>

		<div class="content-search" style="height: 40px;margin: 10px 0 0 10px;">
			<form action="<?php echo U('Order/orderlist');?>" method="post">
				订单号：<input type="text" name="id" class="text-input" value="<?php echo ($_REQUEST['id']); ?>">
				预约人姓名：<input type="text" name="uname" class="text-input" value="<?php echo ($_REQUEST['uname']); ?>">
				预约人电话：<input type="text" name="phone" class="text-input" value="<?php echo ($_REQUEST['phone']); ?>">
				<input type="submit" class="button search-btn" value="查询">
			</form>
		</div>
		
		<!--表格内容-->
		<div class="content-box-content">
			<div class="tab-content default-tab" id="tab1">
				<form action="<?php echo U('AdminBasic/delList',array('tname'=>''));?>" method="post">
					<table border="1">
						<!--标题-->
						<thead>
						<tr>
							<th width="3%">预约号</th>
							<th width="5%">姓名</th>
							<th width="8%">电话</th>
							<th width="12%">预约驾校</th>
							<th width="10%">预约车辆</th>
							<th width="5%">预约车牌</th>
							<th width="8%">驾校电话</th>
							<th width="12%">预约时段</th>
							<th width="12%">创建时间</th>
							<th width="10%">备注</th>
							<th width="5%">状态</th>

							<th width="10%">操作</th>
						</tr>
						</thead>
						<!--内容-->
						<tbody>
						<?php if(empty($orders)): ?><tr><td colspan="11">没有符合条件的结果</td></tr><?php endif; ?>
						<?php if(is_array($orders)): $i = 0; $__LIST__ = $orders;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$order): $mod = ($i % 2 );++$i;?><tr>
								<td><?php echo ($order["id"]); ?></td>
								<td><?php echo ($order["uname"]); ?></td>
								<td><?php echo ($order["phone"]); ?></td>
								<td><?php echo ($order["sname"]); ?></td>
                                <td>
                                	<?php echo ($order["cname"]); ?>
                                </td>
                                 <td>
									<?php echo ($order["carcode"]); ?>
                                </td>
                                 <td>
                                	<?php echo ($order["tel"]); ?>
                                </td>
								<td>
									<?php echo ($order["date"]); ?>&nbsp;&nbsp;<?php echo ($order["time"]); ?>
								</td>
								<td><?php echo (date("Y/m/d H:m:i",$order["c_time"])); ?></td>
								<td><?php echo ($order["remark"]); ?></td>
								<td>
									<?php if($order['status'] == 8): ?>已取消<?php else: ?>已预约<?php endif; ?>
								</td>

								<td class="playorder">
									<?php if($order['status'] == 0): ?><a oid="<?php echo ($order["id"]); ?>" type="8" title="取消预约" class="button">取消</a><?php endif; ?>
                                    <a oid="<?php echo ($order["id"]); ?>" title="详情" class="button getinfo">详情</a>
								</td>
							</tr><?php endforeach; endif; else: echo "" ;endif; ?>
						<!--表尾-->
						</tbody>
						<tfoot>
						<tr>
							<td colspan="20">
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
<div class="goodslist" style="padding:10px;display:none">
</div>
</body>
<script type="text/javascript" src="/plancar/Public/Admin/js/layer/layer.js"></script>
<script type="text/javascript">
	$("[type=8]").on('click',function () {
		var id = $(this).attr("oid");
		if (id) {
			$.ajax({
				"url":"<?php echo U('Order/updstatus');?>",
				"dataType":"json",
				"type":"post",
				"data":{id:id},
				"success":function ( res ) {
					layer.msg( res.message );
				}
			})
		}
	});
</script>
</html>