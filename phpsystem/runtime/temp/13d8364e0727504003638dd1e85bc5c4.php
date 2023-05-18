<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:80:"C:\xampp\htdocs\phpsystem\public/../application/back\view\bumen\bumen_query.html";i:1568642066;}*/ ?>
<link rel="stylesheet" type="text/css" href="__PUBLIC__/backcss/bumen.css" />

<div id="bumen_manage"></div>
<div id="bumen_manage_tool" style="padding:5px;">
	<div style="margin-bottom:5px;">
		<a href="#" class="easyui-linkbutton" iconCls="icon-edit-new" plain="true" onclick="bumen_manage_tool.edit();">修改</a>
		<a href="#" class="easyui-linkbutton" iconCls="icon-delete-new" plain="true" onclick="bumen_manage_tool.remove();">删除</a>
		<a href="#" class="easyui-linkbutton" iconCls="icon-reload" plain="true"  onclick="bumen_manage_tool.reload();">刷新</a>
		<a href="#" class="easyui-linkbutton" iconCls="icon-redo" plain="true" onclick="bumen_manage_tool.redo();">取消选择</a>
		<a href="#" class="easyui-linkbutton" iconCls="icon-export" plain="true" onclick="bumen_manage_tool.exportExcel();">导出到excel</a>
	</div>
	<div style="padding:0 0 0 7px;color:#333;">
		<form id="bumenQueryForm" method="post">
			部门编号：<input type="text" class="textbox" id="bumenbianhao" name="bumenbianhao" style="width:110px" />
			部门名称：<input type="text" class="textbox" id="bumenmingcheng" name="bumenmingcheng" style="width:110px" />
			<a href="#" class="easyui-linkbutton" iconCls="icon-search" onclick="bumen_manage_tool.search();">查询</a>
		</form>	
	</div>
</div>

<div id="bumenEditDiv">
	<form id="bumenEditForm" enctype="multipart/form-data"  method="post">
		<div>
			<span class="label">部门编号:</span>
			<span class="inputControl">
				<input class="textbox" type="text" id="bumen_bumenbianhao_edit" name="bumen_bumenbianhao" style="width:200px" />
			</span>
		</div>
		<div>
			<span class="label">部门名称:</span>
			<span class="inputControl">
				<input class="textbox" type="text" id="bumen_bumenmingcheng_edit" name="bumen_bumenmingcheng" style="width:200px" />

			</span>

		</div>
		<div>
			<span class="label">添加时间:</span>
			<span class="inputControl">
				<input class="textbox" type="text" id="bumen_addtime_edit" name="bumen_addtime" />

			</span>

		</div>
	</form>
</div>
<script>
	var publicURL = "__PUBLIC__/";
	var backURL = "__PUBLIC__/index.php/back/";
</script>
<script type="text/javascript" src="__PUBLIC__/backjs/bumen/bumen_manage.js"></script>
