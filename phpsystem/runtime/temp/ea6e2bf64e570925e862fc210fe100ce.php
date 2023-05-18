<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:86:"C:\xampp\htdocs\phpsystem\public/../application/back\view\diaodong\diaodong_query.html";i:1568642067;}*/ ?>
<link rel="stylesheet" type="text/css" href="__PUBLIC__/backcss/diaodong.css" />

<div id="diaodong_manage"></div>
<div id="diaodong_manage_tool" style="padding:5px;">
	<div style="margin-bottom:5px;">
		<a href="#" class="easyui-linkbutton" iconCls="icon-edit-new" plain="true" onclick="diaodong_manage_tool.edit();">修改</a>
		<a href="#" class="easyui-linkbutton" iconCls="icon-delete-new" plain="true" onclick="diaodong_manage_tool.remove();">删除</a>
		<a href="#" class="easyui-linkbutton" iconCls="icon-reload" plain="true"  onclick="diaodong_manage_tool.reload();">刷新</a>
		<a href="#" class="easyui-linkbutton" iconCls="icon-redo" plain="true" onclick="diaodong_manage_tool.redo();">取消选择</a>
		<a href="#" class="easyui-linkbutton" iconCls="icon-export" plain="true" onclick="diaodong_manage_tool.exportExcel();">导出到excel</a>
	</div>
	<div style="padding:0 0 0 7px;color:#333;">
		<form id="diaodongQueryForm" method="post">
			姓名：<input class="textbox" type="text" id="xingming_bianhao_query" name="xingming.bianhao" style="width: auto"/>
			调动日期：<input type="text" id="diaodongriqi" name="diaodongriqi" class="easyui-datebox" editable="false" style="width:100px">
			调动原因：<input type="text" class="textbox" id="diaodongyuanyin" name="diaodongyuanyin" style="width:110px" />
			添加时间：<input type="text" id="addtime" name="addtime" class="easyui-datebox" editable="false" style="width:100px">
			<a href="#" class="easyui-linkbutton" iconCls="icon-search" onclick="diaodong_manage_tool.search();">查询</a>
		</form>	
	</div>
</div>

<div id="diaodongEditDiv">
	<form id="diaodongEditForm" enctype="multipart/form-data"  method="post">
		<div>
			<span class="label">调动id:</span>
			<span class="inputControl">
				<input class="textbox" type="text" id="diaodong_id_edit" name="diaodong_id" style="width:200px" />
			</span>
		</div>
		<div>
			<span class="label">姓名:</span>
			<span class="inputControl">
				<input class="textbox"  id="diaodong_xingming_bianhao_edit" name="diaodong_xingming_bianhao" style="width: auto"/>
			</span>
		</div>
		<div>
			<span class="label">部门名称:</span>
			<span class="inputControl">
				<input class="textbox"  id="diaodong_bumenmingcheng_bumenbianhao_edit" name="diaodong_bumenmingcheng_bumenbianhao" style="width: auto"/>
			</span>
		</div>
		<div>
			<span class="label">担任职务:</span>
			<span class="inputControl">
				<input class="textbox" type="text" id="diaodong_danrenzhiwu_edit" name="diaodong_danrenzhiwu" style="width:200px" />

			</span>

		</div>
		<div>
			<span class="label">原基本工资:</span>
			<span class="inputControl">
				<input class="textbox" type="text" id="diaodong_yuanjibengongzi_edit" name="diaodong_yuanjibengongzi" style="width:80px" />

			</span>

		</div>
		<div>
			<span class="label">调动职位:</span>
			<span class="inputControl">
				<input class="textbox" type="text" id="diaodong_diaodongzhiwei_edit" name="diaodong_diaodongzhiwei" style="width:200px" />

			</span>

		</div>
		<div>
			<span class="label">调动部门:</span>
			<span class="inputControl">
				<input class="textbox"  id="diaodong_diaodongbumen_bumenbianhao_edit" name="diaodong_diaodongbumen_bumenbianhao" style="width: auto"/>
			</span>
		</div>
		<div>
			<span class="label">调动日期:</span>
			<span class="inputControl">
				<input class="textbox" type="text" id="diaodong_diaodongriqi_edit" name="diaodong_diaodongriqi" />

			</span>

		</div>
		<div>
			<span class="label">现基本工资:</span>
			<span class="inputControl">
				<input class="textbox" type="text" id="diaodong_xianjibengongzi_edit" name="diaodong_xianjibengongzi" style="width:80px" />

			</span>

		</div>
		<div>
			<span class="label">调动原因:</span>
			<span class="inputControl">
				<input class="textbox" type="text" id="diaodong_diaodongyuanyin_edit" name="diaodong_diaodongyuanyin" style="width:200px" />

			</span>

		</div>
		<div>
			<span class="label">添加时间:</span>
			<span class="inputControl">
				<input class="textbox" type="text" id="diaodong_addtime_edit" name="diaodong_addtime" />

			</span>

		</div>
	</form>
</div>
<script>
	var publicURL = "__PUBLIC__/";
	var backURL = "__PUBLIC__/index.php/back/";
</script>
<script type="text/javascript" src="__PUBLIC__/backjs/diaodong/diaodong_manage.js"></script>
