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
			<h3>汽车列表</h3>
			<ul class="content-box-tabs">
				<li><a href="<?php echo U('Car/carList');?>" class="default-tab current">列表</a></li>
				<li><a href="<?php echo U('Car/carAdd');?>">添加</a></li>
			</ul>
			<div class="clear"></div>
		</div>

		<div class="content-search" style="height: 40px;margin: 10px 0 0 10px;">
			<form action="<?php echo U('Car/carList');?>" method="post">
				车牌号：<input type="text" name="carcode" class="text-input">
				<?php if(empty($_SESSION['s_id'])): ?>所属学校：
				<select name="sid">
					<option value=""></option>
					<?php if(is_array($schoollist)): $i = 0; $__LIST__ = $schoollist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["id"]); ?>"><?php echo ($vo["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
				</select><?php endif; ?>
				<input type="submit" class="button search-btn" value="查询">
			</form>
		</div>
		
		<!--表格内容-->
		<div class="content-box-content">
			<div class="tab-content default-tab" id="tab1">
				<form action="<?php echo U('AdminBasic/delList',array('tname'=>'Car'));?>" method="post">
					<table border="1">
						<!--标题-->
						<thead>
						<tr>
							<th width="5%">
								<input class="check-all" type="checkbox" />
								ID
							</th>
							<th width="10%">车名</th>
							<th width="10%">车牌</th>
							<td width="10%">所属驾校</td>
							<th width="10%">缩略图</th>
							<th width="10%">生成时间</th>
							<th width="10%">修改时间</th>
                            <th width="5%">状态</th>
							<th width="10%">操作</th>
						</tr>
						</thead>
						<!--内容-->
						<tbody>
						<?php if(empty($list)): ?><tr><td colspan="10">没有符合条件的结果</td></tr><?php endif; ?>
						<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
								<td>
									<?php echo ($vo["id"]); ?>
								</td>
								<td><?php echo ($vo["name"]); ?></td>
								<td>
									<?php echo ($vo["carcode"]); ?>
								</td>
								<td><?php echo ($vo["sname"]); ?></td>
								
								<td><img src="/plancar/<?php echo ($vo["pic"]); ?>" height="30" /></td>
								<td><?php echo (date("Y/m/d H:m:i",$vo["ctime"])); ?></td>
								<td><?php echo (date("Y/m/d H:m:i",$vo["utime"])); ?></td>
								<td>
                                    <?php if($vo['status'] == 0): ?><a href="<?php echo U('Car/carDown',array('id'=>$vo['id']));?>" title="下架">
                                        <img src="/plancar/Public/Admin/images/icons/tick_circle.png" alt="Delete" />
                                    </a>
                                    <?php elseif($vo['status'] == 1): ?>
                                    <a href="<?php echo U('Car/carUp',array('id'=>$vo['id']));?>" title="上架">
                                        <img src="/plancar/Public/Admin/images/icons/cross_circle.png" alt="Delete" />
                                    </a><?php endif; ?>
                                </td>
                                <td>
                                    <a href="<?php echo U('Car/carEdit',array('id'=>$vo['id']));?>" title="编辑">
                                        <img src="/plancar/Public/Admin/images/icons/pencil.png" alt="Edit" />
                                    </a>
                                    <a href="<?php echo U('Car/carDel',array('id'=>$vo['id']));?>" title="删除">
                                        <img src="/plancar/Public/Admin/images/icons/cross.png" alt="Delete" />
                                    </a>
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
</body>
</html>