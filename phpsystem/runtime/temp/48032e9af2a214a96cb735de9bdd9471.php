<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:82:"C:\xampp\htdocs\phpsystem\public/../application/back\view\salary\salary_query.html";i:1568642068;}*/ ?>
<link rel="stylesheet" type="text/css" href="__PUBLIC__/backcss/salary.css" />

<div id="salary_manage"></div>
<div id="salary_manage_tool" style="padding:5px;">
	<div style="margin-bottom:5px;">
		<a href="#" class="easyui-linkbutton" iconCls="icon-edit-new" plain="true" onclick="salary_manage_tool.edit();">修改</a>
		<a href="#" class="easyui-linkbutton" iconCls="icon-delete-new" plain="true" onclick="salary_manage_tool.remove();">删除</a>
		<a href="#" class="easyui-linkbutton" iconCls="icon-reload" plain="true"  onclick="salary_manage_tool.reload();">刷新</a>
		<a href="#" class="easyui-linkbutton" iconCls="icon-redo" plain="true" onclick="salary_manage_tool.redo();">取消选择</a>
		<a href="#" class="easyui-linkbutton" iconCls="icon-export" plain="true" onclick="salary_manage_tool.exportExcel();">导出到excel</a>
	</div>
	<div style="padding:0 0 0 7px;color:#333;">
		<form id="salaryQueryForm" method="post">
			年份：<input type="text" class="textbox" id="nianfen" name="nianfen" style="width:110px" />
			月份：<input type="text" class="textbox" id="yuefen" name="yuefen" style="width:110px" />
			添加时间：<input type="text" id="addtime" name="addtime" class="easyui-datebox" editable="false" style="width:100px">
			姓名：<input class="textbox" type="text" id="xingming_bianhao_query" name="xingming.bianhao" style="width: auto"/>
			部门名称：<input class="textbox" type="text" id="bumenmingcheng_bumenbianhao_query" name="bumenmingcheng.bumenbianhao" style="width: auto"/>
			<a href="#" class="easyui-linkbutton" iconCls="icon-search" onclick="salary_manage_tool.search();">查询</a>
		</form>	
	</div>
</div>

<div id="salaryEditDiv">
	<form id="salaryEditForm" enctype="multipart/form-data"  method="post">
		<div>
			<span class="label">工资id:</span>
			<span class="inputControl">
				<input class="textbox" type="text" id="salary_salaryId_edit" name="salary_salaryId" style="width:200px" />
			</span>
		</div>
		<div>
			<span class="label">姓名:</span>
			<span class="inputControl">
				<input class="textbox"  id="salary_xingming_bianhao_edit" name="salary_xingming_bianhao" style="width: auto"/>
			</span>
		</div>
		<div>
			<span class="label">部门名称:</span>
			<span class="inputControl">
				<input class="textbox"  id="salary_bumenmingcheng_bumenbianhao_edit" name="salary_bumenmingcheng_bumenbianhao" style="width: auto"/>
			</span>
		</div>
		<div>
			<span class="label">担任职务:</span>
			<span class="inputControl">
				<input class="textbox" type="text" id="salary_danrenzhiwu_edit" name="salary_danrenzhiwu" style="width:200px" />

			</span>

		</div>
		<div>
			<span class="label">年份:</span>
			<span class="inputControl">
				<input class="textbox" type="text" id="salary_nianfen_edit" name="salary_nianfen" style="width:200px" />

			</span>

		</div>
		<div>
			<span class="label">月份:</span>
			<span class="inputControl">
				<input class="textbox" type="text" id="salary_yuefen_edit" name="salary_yuefen" style="width:200px" />

			</span>

		</div>
		<div>
			<span class="label">基本工资:</span>
			<span class="inputControl">
				<input class="textbox" type="text" id="salary_jibengongzi_edit" name="salary_jibengongzi" style="width:80px" />

			</span>

		</div>
		<div>
			<span class="label">全勤奖励:</span>
			<span class="inputControl">
				<input class="textbox" type="text" id="salary_quanqinjiangli_edit" name="salary_quanqinjiangli" style="width:80px" />

			</span>

		</div>
		<div>
			<span class="label">考核奖励:</span>
			<span class="inputControl">
				<input class="textbox" type="text" id="salary_kaohejiangli_edit" name="salary_kaohejiangli" style="width:80px" />

			</span>

		</div>
		<div>
			<span class="label">加班工资:</span>
			<span class="inputControl">
				<input class="textbox" type="text" id="salary_jiabangongzi_edit" name="salary_jiabangongzi" style="width:80px" />

			</span>

		</div>
		<div>
			<span class="label">津贴补助:</span>
			<span class="inputControl">
				<input class="textbox" type="text" id="salary_jintiebuzhu_edit" name="salary_jintiebuzhu" style="width:80px" />

			</span>

		</div>
		<div>
			<span class="label">惩罚金额:</span>
			<span class="inputControl">
				<input class="textbox" type="text" id="salary_chengfajine_edit" name="salary_chengfajine" style="width:80px" />

			</span>

		</div>
		<div>
			<span class="label">个人所得税:</span>
			<span class="inputControl">
				<input class="textbox" type="text" id="salary_gerensuodeshui_edit" name="salary_gerensuodeshui" style="width:80px" />

			</span>

		</div>
		<div>
			<span class="label">五险一金:</span>
			<span class="inputControl">
				<input class="textbox" type="text" id="salary_wuxianyijin_edit" name="salary_wuxianyijin" style="width:80px" />

			</span>

		</div>
		<div>
			<span class="label">应发工资:</span>
			<span class="inputControl">
				<input class="textbox" type="text" id="salary_yingfagongzi_edit" name="salary_yingfagongzi" style="width:80px" />

			</span>

		</div>
		<div>
			<span class="label">实发工资:</span>
			<span class="inputControl">
				<input class="textbox" type="text" id="salary_shifagongzi_edit" name="salary_shifagongzi" style="width:80px" />

			</span>

		</div>
		<div>
			<span class="label">备注:</span>
			<span class="inputControl">
				<textarea id="salary_beizhu_edit" name="salary_beizhu" rows="8" cols="60"></textarea>

			</span>

		</div>
		<div>
			<span class="label">添加时间:</span>
			<span class="inputControl">
				<input class="textbox" type="text" id="salary_addtime_edit" name="salary_addtime" />

			</span>

		</div>
	</form>
</div>
<script>
	var publicURL = "__PUBLIC__/";
	var backURL = "__PUBLIC__/index.php/back/";
</script>
<script type="text/javascript" src="__PUBLIC__/backjs/salary/salary_manage.js"></script>
