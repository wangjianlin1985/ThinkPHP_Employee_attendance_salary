<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:82:"C:\xampp\htdocs\phpsystem\public/../application/back\view\kaoqin\kaoqin_query.html";i:1568642069;}*/ ?>
<link rel="stylesheet" type="text/css" href="__PUBLIC__/backcss/kaoqin.css" />

<div id="kaoqin_manage"></div>
<div id="kaoqin_manage_tool" style="padding:5px;">
	<div style="margin-bottom:5px;">
		<a href="#" class="easyui-linkbutton" iconCls="icon-edit-new" plain="true" onclick="kaoqin_manage_tool.edit();">修改</a>
		<a href="#" class="easyui-linkbutton" iconCls="icon-delete-new" plain="true" onclick="kaoqin_manage_tool.remove();">删除</a>
		<a href="#" class="easyui-linkbutton" iconCls="icon-reload" plain="true"  onclick="kaoqin_manage_tool.reload();">刷新</a>
		<a href="#" class="easyui-linkbutton" iconCls="icon-redo" plain="true" onclick="kaoqin_manage_tool.redo();">取消选择</a>
		<a href="#" class="easyui-linkbutton" iconCls="icon-export" plain="true" onclick="kaoqin_manage_tool.exportExcel();">导出到excel</a>
	</div>
	<div style="padding:0 0 0 7px;color:#333;">
		<form id="kaoqinQueryForm" method="post">
			姓名：<input class="textbox" type="text" id="xingming_bianhao_query" name="xingming.bianhao" style="width: auto"/>
			所属部门：<input class="textbox" type="text" id="suoshubumen_bumenbianhao_query" name="suoshubumen.bumenbianhao" style="width: auto"/>
			年份：<input type="text" class="textbox" id="nianfen" name="nianfen" style="width:110px" />
			月份：<input type="text" class="textbox" id="yuefen" name="yuefen" style="width:110px" />
			添加时间：<input type="text" id="addtime" name="addtime" class="easyui-datebox" editable="false" style="width:100px">
			<a href="#" class="easyui-linkbutton" iconCls="icon-search" onclick="kaoqin_manage_tool.search();">查询</a>
		</form>	
	</div>
</div>

<div id="kaoqinEditDiv">
	<form id="kaoqinEditForm" enctype="multipart/form-data"  method="post">
		<div>
			<span class="label">考勤id:</span>
			<span class="inputControl">
				<input class="textbox" type="text" id="kaoqin_kaoqinId_edit" name="kaoqin_kaoqinId" style="width:200px" />
			</span>
		</div>
		<div>
			<span class="label">姓名:</span>
			<span class="inputControl">
				<input class="textbox"  id="kaoqin_xingming_bianhao_edit" name="kaoqin_xingming_bianhao" style="width: auto"/>
			</span>
		</div>
		<div>
			<span class="label">性别:</span>
			<span class="inputControl">
				<input class="textbox" type="text" id="kaoqin_xingbie_edit" name="kaoqin_xingbie" style="width:200px" />

			</span>

		</div>
		<div>
			<span class="label">所属部门:</span>
			<span class="inputControl">
				<input class="textbox"  id="kaoqin_suoshubumen_bumenbianhao_edit" name="kaoqin_suoshubumen_bumenbianhao" style="width: auto"/>
			</span>
		</div>
		<div>
			<span class="label">担任职务:</span>
			<span class="inputControl">
				<input class="textbox" type="text" id="kaoqin_danrenzhiwu_edit" name="kaoqin_danrenzhiwu" style="width:200px" />

			</span>

		</div>
		<div>
			<span class="label">年份:</span>
			<span class="inputControl">
				<input class="textbox" type="text" id="kaoqin_nianfen_edit" name="kaoqin_nianfen" style="width:200px" />

			</span>

		</div>
		<div>
			<span class="label">月份:</span>
			<span class="inputControl">
				<input class="textbox" type="text" id="kaoqin_yuefen_edit" name="kaoqin_yuefen" style="width:200px" />

			</span>

		</div>
		<div>
			<span class="label">到勤天数:</span>
			<span class="inputControl">
				<input class="textbox" type="text" id="kaoqin_daoqintianshu_edit" name="kaoqin_daoqintianshu" style="width:80px" />

			</span>

		</div>
		<div>
			<span class="label">迟到天数:</span>
			<span class="inputControl">
				<input class="textbox" type="text" id="kaoqin_chidaotianshu_edit" name="kaoqin_chidaotianshu" style="width:80px" />

			</span>

		</div>
		<div>
			<span class="label">旷工天数:</span>
			<span class="inputControl">
				<input class="textbox" type="text" id="kaoqin_kuangdaotianshu_edit" name="kaoqin_kuangdaotianshu" style="width:80px" />

			</span>

		</div>
		<div>
			<span class="label">请假天数:</span>
			<span class="inputControl">
				<input class="textbox" type="text" id="kaoqin_qingjiatianshu_edit" name="kaoqin_qingjiatianshu" style="width:80px" />

			</span>

		</div>
		<div>
			<span class="label">备注:</span>
			<span class="inputControl">
				<textarea id="kaoqin_beizhu_edit" name="kaoqin_beizhu" rows="8" cols="60"></textarea>

			</span>

		</div>
		<div>
			<span class="label">添加时间:</span>
			<span class="inputControl">
				<input class="textbox" type="text" id="kaoqin_addtime_edit" name="kaoqin_addtime" />

			</span>

		</div>
	</form>
</div>
<script>
	var publicURL = "__PUBLIC__/";
	var backURL = "__PUBLIC__/index.php/back/";
</script>
<script type="text/javascript" src="__PUBLIC__/backjs/kaoqin/kaoqin_manage.js"></script>
