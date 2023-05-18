<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:84:"C:\xampp\htdocs\phpsystem\public/../application/back\view\employee\employee_add.html";i:1568642066;}*/ ?>
<link rel="stylesheet" type="text/css" href="__PUBLIC__/backcss/employee.css" />
<div id="employeeAddDiv">
	<form id="employeeAddForm" enctype="multipart/form-data"  method="post">
		<div>
			<span class="label">员工编号:</span>
			<span class="inputControl">
				<input class="textbox" type="text" id="employee_bianhao" name="employee_bianhao" style="width:200px" />

			</span>

		</div>
		<div>
			<span class="label">密码:</span>
			<span class="inputControl">
				<input class="textbox" type="text" id="employee_mima" name="employee_mima" style="width:200px" />

			</span>

		</div>
		<div>
			<span class="label">姓名:</span>
			<span class="inputControl">
				<input class="textbox" type="text" id="employee_xingming" name="employee_xingming" style="width:200px" />

			</span>

		</div>
		<div>
			<span class="label">性别:</span>
			<span class="inputControl">
				<input class="textbox" type="text" id="employee_xingbie" name="employee_xingbie" style="width:200px" />

			</span>

		</div>
		<div>
			<span class="label">部门:</span>
			<span class="inputControl">
				<input class="textbox" type="text" id="employee_bumenObj_bumenbianhao" name="employee.bumenObj.bumenbianhao" style="width: auto"/>
			</span>
		</div>
		<div>
			<span class="label">担任职务:</span>
			<span class="inputControl">
				<input class="textbox" type="text" id="employee_danrenzhiwu" name="employee_danrenzhiwu" style="width:200px" />

			</span>

		</div>
		<div>
			<span class="label">民族:</span>
			<span class="inputControl">
				<input class="textbox" type="text" id="employee_minzu" name="employee_minzu" style="width:200px" />

			</span>

		</div>
		<div>
			<span class="label">出生日期:</span>
			<span class="inputControl">
				<input class="textbox" type="text" id="employee_chushengriqi" name="employee_chushengriqi" />

			</span>

		</div>
		<div>
			<span class="label">身份证号:</span>
			<span class="inputControl">
				<input class="textbox" type="text" id="employee_shenfenzhenghao" name="employee_shenfenzhenghao" style="width:200px" />

			</span>

		</div>
		<div>
			<span class="label">籍贯:</span>
			<span class="inputControl">
				<input class="textbox" type="text" id="employee_jiguan" name="employee_jiguan" style="width:200px" />

			</span>

		</div>
		<div>
			<span class="label">文化程度:</span>
			<span class="inputControl">
				<input class="textbox" type="text" id="employee_wenhuachengdu" name="employee_wenhuachengdu" style="width:200px" />

			</span>

		</div>
		<div>
			<span class="label">政治面貌:</span>
			<span class="inputControl">
				<input class="textbox" type="text" id="employee_zhengzhimianmao" name="employee_zhengzhimianmao" style="width:200px" />

			</span>

		</div>
		<div>
			<span class="label">婚姻状况:</span>
			<span class="inputControl">
				<input class="textbox" type="text" id="employee_hunyinqingkuang" name="employee_hunyinqingkuang" style="width:200px" />

			</span>

		</div>
		<div>
			<span class="label">毕业院校:</span>
			<span class="inputControl">
				<input class="textbox" type="text" id="employee_biyeyuanxiao" name="employee_biyeyuanxiao" style="width:200px" />

			</span>

		</div>
		<div>
			<span class="label">专业:</span>
			<span class="inputControl">
				<input class="textbox" type="text" id="employee_zhuanye" name="employee_zhuanye" style="width:200px" />

			</span>

		</div>
		<div>
			<span class="label">毕业时间:</span>
			<span class="inputControl">
				<input class="textbox" type="text" id="employee_biyeshijian" name="employee_biyeshijian" />

			</span>

		</div>
		<div>
			<span class="label">手机号:</span>
			<span class="inputControl">
				<input class="textbox" type="text" id="employee_shoujihao" name="employee_shoujihao" style="width:200px" />

			</span>

		</div>
		<div>
			<span class="label">基本工资:</span>
			<span class="inputControl">
				<input class="textbox" type="text" id="employee_jibengongzi" name="employee_jibengongzi" style="width:80px" />

			</span>

		</div>
		<div>
			<span class="label">现住址:</span>
			<span class="inputControl">
				<input class="textbox" type="text" id="employee_xianzhuzhi" name="employee_xianzhuzhi" style="width:200px" />

			</span>

		</div>
		<div>
			<span class="label">照片:</span>
			<span class="inputControl">
				<input id="zhaopianFile" name="zhaopianFile" type="file" size="50" />
			</span>
		</div>
		<div>
			<span class="label">备注:</span>
			<span class="inputControl">
				<textarea id="employee_beizhu" name="employee_beizhu" rows="6" cols="80"></textarea>

			</span>

		</div>
		<div>
			<span class="label">添加时间:</span>
			<span class="inputControl">
				<input class="textbox" type="text" id="employee_addtime" name="employee_addtime" />

			</span>

		</div>
		<div class="operation">
			<a id="employeeAddButton" class="easyui-linkbutton">添加</a>
			<a id="employeeClearButton" class="easyui-linkbutton">重填</a>
		</div> 
	</form>
</div>
<script> var backURL = "__PUBLIC__/index.php/back/";</script>
<script src="__PUBLIC__/backjs/employee/employee_add.js"></script>
