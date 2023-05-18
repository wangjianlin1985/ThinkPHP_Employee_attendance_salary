<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:80:"C:\xampp\htdocs\phpsystem\public/../application/back\view\kaohe\kaohe_query.html";i:1568642068;}*/ ?>
<link rel="stylesheet" type="text/css" href="__PUBLIC__/backcss/kaohe.css" />

<div id="kaohe_manage"></div>
<div id="kaohe_manage_tool" style="padding:5px;">
	<div style="margin-bottom:5px;">
		<a href="#" class="easyui-linkbutton" iconCls="icon-edit-new" plain="true" onclick="kaohe_manage_tool.edit();">修改</a>
		<a href="#" class="easyui-linkbutton" iconCls="icon-delete-new" plain="true" onclick="kaohe_manage_tool.remove();">删除</a>
		<a href="#" class="easyui-linkbutton" iconCls="icon-reload" plain="true"  onclick="kaohe_manage_tool.reload();">刷新</a>
		<a href="#" class="easyui-linkbutton" iconCls="icon-redo" plain="true" onclick="kaohe_manage_tool.redo();">取消选择</a>
		<a href="#" class="easyui-linkbutton" iconCls="icon-export" plain="true" onclick="kaohe_manage_tool.exportExcel();">导出到excel</a>
	</div>
	<div style="padding:0 0 0 7px;color:#333;">
		<form id="kaoheQueryForm" method="post">
			姓名：<input class="textbox" type="text" id="xingming_bianhao_query" name="xingming.bianhao" style="width: auto"/>
			部门：<input class="textbox" type="text" id="bumenObj_bumenbianhao_query" name="bumenObj.bumenbianhao" style="width: auto"/>
			月份：<input type="text" class="textbox" id="yuefen" name="yuefen" style="width:110px" />
			<a href="#" class="easyui-linkbutton" iconCls="icon-search" onclick="kaohe_manage_tool.search();">查询</a>
		</form>	
	</div>
</div>

<div id="kaoheEditDiv">
	<form id="kaoheEditForm" enctype="multipart/form-data"  method="post">
		<div>
			<span class="label">考核id:</span>
			<span class="inputControl">
				<input class="textbox" type="text" id="kaohe_kaoheId_edit" name="kaohe_kaoheId" style="width:200px" />
			</span>
		</div>
		<div>
			<span class="label">姓名:</span>
			<span class="inputControl">
				<input class="textbox"  id="kaohe_xingming_bianhao_edit" name="kaohe_xingming_bianhao" style="width: auto"/>
			</span>
		</div>
		<div>
			<span class="label">部门:</span>
			<span class="inputControl">
				<input class="textbox"  id="kaohe_bumenObj_bumenbianhao_edit" name="kaohe_bumenObj_bumenbianhao" style="width: auto"/>
			</span>
		</div>
		<div>
			<span class="label">职务:</span>
			<span class="inputControl">
				<input class="textbox" type="text" id="kaohe_zhiwu_edit" name="kaohe_zhiwu" style="width:200px" />

			</span>

		</div>
		<div>
			<span class="label">年份:</span>
			<span class="inputControl">
				<input class="textbox" type="text" id="kaohe_nianfen_edit" name="kaohe_nianfen" style="width:200px" />

			</span>

		</div>
		<div>
			<span class="label">月份:</span>
			<span class="inputControl">
				<input class="textbox" type="text" id="kaohe_yuefen_edit" name="kaohe_yuefen" style="width:200px" />

			</span>

		</div>
		<div>
			<span class="label">考核结果:</span>
			<span class="inputControl">
				<textarea id="kaohe_kaohejieguo_edit" name="kaohe_kaohejieguo" rows="8" cols="60"></textarea>

			</span>

		</div>
		<div>
			<span class="label">考核奖励:</span>
			<span class="inputControl">
				<textarea id="kaohe_kaohejiangli_edit" name="kaohe_kaohejiangli" rows="8" cols="60"></textarea>

			</span>

		</div>
		<div>
			<span class="label">考核部门:</span>
			<span class="inputControl">
				<input class="textbox"  id="kaohe_kaohebumen_bumenbianhao_edit" name="kaohe_kaohebumen_bumenbianhao" style="width: auto"/>
			</span>
		</div>
		<div>
			<span class="label">考核人:</span>
			<span class="inputControl">
				<input class="textbox" type="text" id="kaohe_kaoheren_edit" name="kaohe_kaoheren" style="width:200px" />

			</span>

		</div>
		<div>
			<span class="label">考核内容:</span>
			<span class="inputControl">
				<textarea id="kaohe_kaoheneirong_edit" name="kaohe_kaoheneirong" rows="8" cols="60"></textarea>

			</span>

		</div>
		<div>
			<span class="label">添加时间:</span>
			<span class="inputControl">
				<input class="textbox" type="text" id="kaohe_addtime_edit" name="kaohe_addtime" />

			</span>

		</div>
	</form>
</div>
<script>
	var publicURL = "__PUBLIC__/";
	var backURL = "__PUBLIC__/index.php/back/";
</script>
<script type="text/javascript" src="__PUBLIC__/backjs/kaohe/kaohe_manage.js"></script>
