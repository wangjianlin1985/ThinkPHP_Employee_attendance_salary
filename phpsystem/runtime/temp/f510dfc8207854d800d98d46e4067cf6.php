<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:82:"C:\xampp\htdocs\phpsystem\public/../application/back\view\peixun\peixun_query.html";i:1568642070;}*/ ?>
<link rel="stylesheet" type="text/css" href="__PUBLIC__/backcss/peixun.css" />

<div id="peixun_manage"></div>
<div id="peixun_manage_tool" style="padding:5px;">
	<div style="margin-bottom:5px;">
		<a href="#" class="easyui-linkbutton" iconCls="icon-edit-new" plain="true" onclick="peixun_manage_tool.edit();">修改</a>
		<a href="#" class="easyui-linkbutton" iconCls="icon-delete-new" plain="true" onclick="peixun_manage_tool.remove();">删除</a>
		<a href="#" class="easyui-linkbutton" iconCls="icon-reload" plain="true"  onclick="peixun_manage_tool.reload();">刷新</a>
		<a href="#" class="easyui-linkbutton" iconCls="icon-redo" plain="true" onclick="peixun_manage_tool.redo();">取消选择</a>
		<a href="#" class="easyui-linkbutton" iconCls="icon-export" plain="true" onclick="peixun_manage_tool.exportExcel();">导出到excel</a>
	</div>
	<div style="padding:0 0 0 7px;color:#333;">
		<form id="peixunQueryForm" method="post">
			培训名称：<input type="text" class="textbox" id="mingcheng" name="mingcheng" style="width:110px" />
			培训时间：<input type="text" id="shijian" name="shijian" class="easyui-datebox" editable="false" style="width:100px">
			培训地点：<input type="text" class="textbox" id="didian" name="didian" style="width:110px" />
			添加时间：<input type="text" id="addtime" name="addtime" class="easyui-datebox" editable="false" style="width:100px">
			<a href="#" class="easyui-linkbutton" iconCls="icon-search" onclick="peixun_manage_tool.search();">查询</a>
		</form>	
	</div>
</div>

<div id="peixunEditDiv">
	<form id="peixunEditForm" enctype="multipart/form-data"  method="post">
		<div>
			<span class="label">培训id:</span>
			<span class="inputControl">
				<input class="textbox" type="text" id="peixun_peixunId_edit" name="peixun_peixunId" style="width:200px" />
			</span>
		</div>
		<div>
			<span class="label">培训名称:</span>
			<span class="inputControl">
				<input class="textbox" type="text" id="peixun_mingcheng_edit" name="peixun_mingcheng" style="width:200px" />

			</span>

		</div>
		<div>
			<span class="label">培训时间:</span>
			<span class="inputControl">
				<input class="textbox" type="text" id="peixun_shijian_edit" name="peixun_shijian" />

			</span>

		</div>
		<div>
			<span class="label">培训清单:</span>
			<span class="inputControl">
				<textarea id="peixun_qingdan_edit" name="peixun_qingdan" rows="8" cols="60"></textarea>

			</span>

		</div>
		<div>
			<span class="label">培训地点:</span>
			<span class="inputControl">
				<input class="textbox" type="text" id="peixun_didian_edit" name="peixun_didian" style="width:200px" />

			</span>

		</div>
		<div>
			<span class="label">添加时间:</span>
			<span class="inputControl">
				<input class="textbox" type="text" id="peixun_addtime_edit" name="peixun_addtime" />

			</span>

		</div>
	</form>
</div>
<script>
	var publicURL = "__PUBLIC__/";
	var backURL = "__PUBLIC__/index.php/back/";
</script>
<script type="text/javascript" src="__PUBLIC__/backjs/peixun/peixun_manage.js"></script>
