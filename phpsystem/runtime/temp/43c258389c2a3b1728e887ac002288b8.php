<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:86:"C:\xampp\htdocs\phpsystem\public/../application/back\view\employee\employee_query.html";i:1568642066;}*/ ?>
<link rel="stylesheet" type="text/css" href="__PUBLIC__/backcss/employee.css" />

<div id="employee_manage"></div>
<div id="employee_manage_tool" style="padding:5px;">
	<div style="margin-bottom:5px;">
		<a href="#" class="easyui-linkbutton" iconCls="icon-edit-new" plain="true" onclick="employee_manage_tool.edit();">修改</a>
		<a href="#" class="easyui-linkbutton" iconCls="icon-delete-new" plain="true" onclick="employee_manage_tool.remove();">删除</a>
		<a href="#" class="easyui-linkbutton" iconCls="icon-reload" plain="true"  onclick="employee_manage_tool.reload();">刷新</a>
		<a href="#" class="easyui-linkbutton" iconCls="icon-redo" plain="true" onclick="employee_manage_tool.redo();">取消选择</a>
		<a href="#" class="easyui-linkbutton" iconCls="icon-export" plain="true" onclick="employee_manage_tool.exportExcel();">导出到excel</a>
	</div>
	<div style="padding:0 0 0 7px;color:#333;">
		<form id="employeeQueryForm" method="post">
			员工编号：<input type="text" class="textbox" id="bianhao" name="bianhao" style="width:110px" />
			姓名：<input type="text" class="textbox" id="xingming" name="xingming" style="width:110px" />
			部门：<input class="textbox" type="text" id="bumenObj_bumenbianhao_query" name="bumenObj.bumenbianhao" style="width: auto"/>
			担任职务：<input type="text" class="textbox" id="danrenzhiwu" name="danrenzhiwu" style="width:110px" />
			出生日期：<input type="text" id="chushengriqi" name="chushengriqi" class="easyui-datebox" editable="false" style="width:100px">
			身份证号：<input type="text" class="textbox" id="shenfenzhenghao" name="shenfenzhenghao" style="width:110px" />
			<a href="#" class="easyui-linkbutton" iconCls="icon-search" onclick="employee_manage_tool.search();">查询</a>
		</form>	
	</div>
</div>

<div id="employeeEditDiv">
	<form id="employeeEditForm" enctype="multipart/form-data"  method="post">
		<div>
			<span class="label">员工编号:</span>
			<span class="inputControl">
				<input class="textbox" type="text" id="employee_bianhao_edit" name="employee_bianhao" style="width:200px" />
			</span>
		</div>
		<div>
			<span class="label">密码:</span>
			<span class="inputControl">
				<input class="textbox" type="text" id="employee_mima_edit" name="employee_mima" style="width:200px" />

			</span>

		</div>
		<div>
			<span class="label">姓名:</span>
			<span class="inputControl">
				<input class="textbox" type="text" id="employee_xingming_edit" name="employee_xingming" style="width:200px" />

			</span>

		</div>
		<div>
			<span class="label">性别:</span>
			<span class="inputControl">
				<input class="textbox" type="text" id="employee_xingbie_edit" name="employee_xingbie" style="width:200px" />

			</span>

		</div>
		<div>
			<span class="label">部门:</span>
			<span class="inputControl">
				<input class="textbox"  id="employee_bumenObj_bumenbianhao_edit" name="employee_bumenObj_bumenbianhao" style="width: auto"/>
			</span>
		</div>
		<div>
			<span class="label">担任职务:</span>
			<span class="inputControl">
				<input class="textbox" type="text" id="employee_danrenzhiwu_edit" name="employee_danrenzhiwu" style="width:200px" />

			</span>

		</div>
		<div>
			<span class="label">民族:</span>
			<span class="inputControl">
				<input class="textbox" type="text" id="employee_minzu_edit" name="employee_minzu" style="width:200px" />

			</span>

		</div>
		<div>
			<span class="label">出生日期:</span>
			<span class="inputControl">
				<input class="textbox" type="text" id="employee_chushengriqi_edit" name="employee_chushengriqi" />

			</span>

		</div>
		<div>
			<span class="label">身份证号:</span>
			<span class="inputControl">
				<input class="textbox" type="text" id="employee_shenfenzhenghao_edit" name="employee_shenfenzhenghao" style="width:200px" />

			</span>

		</div>
		<div>
			<span class="label">籍贯:</span>
			<span class="inputControl">
				<input class="textbox" type="text" id="employee_jiguan_edit" name="employee_jiguan" style="width:200px" />

			</span>

		</div>
		<div>
			<span class="label">文化程度:</span>
			<span class="inputControl">
				<input class="textbox" type="text" id="employee_wenhuachengdu_edit" name="employee_wenhuachengdu" style="width:200px" />

			</span>

		</div>
		<div>
			<span class="label">政治面貌:</span>
			<span class="inputControl">
				<input class="textbox" type="text" id="employee_zhengzhimianmao_edit" name="employee_zhengzhimianmao" style="width:200px" />

			</span>

		</div>
		<div>
			<span class="label">婚姻状况:</span>
			<span class="inputControl">
				<input class="textbox" type="text" id="employee_hunyinqingkuang_edit" name="employee_hunyinqingkuang" style="width:200px" />

			</span>

		</div>
		<div>
			<span class="label">毕业院校:</span>
			<span class="inputControl">
				<input class="textbox" type="text" id="employee_biyeyuanxiao_edit" name="employee_biyeyuanxiao" style="width:200px" />

			</span>

		</div>
		<div>
			<span class="label">专业:</span>
			<span class="inputControl">
				<input class="textbox" type="text" id="employee_zhuanye_edit" name="employee_zhuanye" style="width:200px" />

			</span>

		</div>
		<div>
			<span class="label">毕业时间:</span>
			<span class="inputControl">
				<input class="textbox" type="text" id="employee_biyeshijian_edit" name="employee_biyeshijian" />

			</span>

		</div>
		<div>
			<span class="label">手机号:</span>
			<span class="inputControl">
				<input class="textbox" type="text" id="employee_shoujihao_edit" name="employee_shoujihao" style="width:200px" />

			</span>

		</div>
		<div>
			<span class="label">基本工资:</span>
			<span class="inputControl">
				<input class="textbox" type="text" id="employee_jibengongzi_edit" name="employee_jibengongzi" style="width:80px" />

			</span>

		</div>
		<div>
			<span class="label">现住址:</span>
			<span class="inputControl">
				<input class="textbox" type="text" id="employee_xianzhuzhi_edit" name="employee_xianzhuzhi" style="width:200px" />

			</span>

		</div>
		<div>
			<span class="label">照片:</span>
			<span class="inputControl">
				<img id="employee_zhaopianImg" width="200px" border="0px"/><br/>
    			<input type="hidden" id="employee_zhaopian" name="employee_zhaopian"/>
				<input id="zhaopianFile" name="zhaopianFile" type="file" size="50" />
			</span>
		</div>
		<div>
			<span class="label">备注:</span>
			<span class="inputControl">
				<textarea id="employee_beizhu_edit" name="employee_beizhu" rows="8" cols="60"></textarea>

			</span>

		</div>
		<div>
			<span class="label">添加时间:</span>
			<span class="inputControl">
				<input class="textbox" type="text" id="employee_addtime_edit" name="employee_addtime" />

			</span>

		</div>
	</form>
</div>
<script>
	var publicURL = "__PUBLIC__/";
	var backURL = "__PUBLIC__/index.php/back/";
</script>
<script type="text/javascript" src="__PUBLIC__/backjs/employee/employee_manage.js"></script>
