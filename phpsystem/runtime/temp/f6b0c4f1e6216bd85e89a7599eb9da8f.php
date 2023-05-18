<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:80:"C:\xampp\htdocs\phpsystem\public/../application/back\view\salary\salary_add.html";i:1568642068;}*/ ?>
<link rel="stylesheet" type="text/css" href="__PUBLIC__/backcss/salary.css" />
<div id="salaryAddDiv">
	<form id="salaryAddForm" enctype="multipart/form-data"  method="post">
		<div>
			<span class="label">姓名:</span>
			<span class="inputControl">
				<input class="textbox" type="text" id="salary_xingming_bianhao" name="salary.xingming.bianhao" style="width: auto"/>
			</span>
		</div>
		<div>
			<span class="label">部门名称:</span>
			<span class="inputControl">
				<input class="textbox" type="text" id="salary_bumenmingcheng_bumenbianhao" name="salary.bumenmingcheng.bumenbianhao" style="width: auto"/>
			</span>
		</div>
		<div>
			<span class="label">担任职务:</span>
			<span class="inputControl">
				<input class="textbox" type="text" id="salary_danrenzhiwu" name="salary_danrenzhiwu" style="width:200px" />

			</span>

		</div>
		<div>
			<span class="label">年份:</span>
			<span class="inputControl">
				<input class="textbox" type="text" id="salary_nianfen" name="salary_nianfen" style="width:200px" />

			</span>

		</div>
		<div>
			<span class="label">月份:</span>
			<span class="inputControl">
				<input class="textbox" type="text" id="salary_yuefen" name="salary_yuefen" style="width:200px" />

			</span>

		</div>
		<div>
			<span class="label">基本工资:</span>
			<span class="inputControl">
				<input class="textbox" type="text" id="salary_jibengongzi" name="salary_jibengongzi" style="width:80px" />

			</span>

		</div>
		<div>
			<span class="label">全勤奖励:</span>
			<span class="inputControl">
				<input class="textbox" type="text" id="salary_quanqinjiangli" name="salary_quanqinjiangli" style="width:80px" />

			</span>

		</div>
		<div>
			<span class="label">考核奖励:</span>
			<span class="inputControl">
				<input class="textbox" type="text" id="salary_kaohejiangli" name="salary_kaohejiangli" style="width:80px" />

			</span>

		</div>
		<div>
			<span class="label">加班工资:</span>
			<span class="inputControl">
				<input class="textbox" type="text" id="salary_jiabangongzi" name="salary_jiabangongzi" style="width:80px" />

			</span>

		</div>
		<div>
			<span class="label">津贴补助:</span>
			<span class="inputControl">
				<input class="textbox" type="text" id="salary_jintiebuzhu" name="salary_jintiebuzhu" style="width:80px" />

			</span>

		</div>
		<div>
			<span class="label">惩罚金额:</span>
			<span class="inputControl">
				<input class="textbox" type="text" id="salary_chengfajine" name="salary_chengfajine" style="width:80px" />

			</span>

		</div>
		<div>
			<span class="label">个人所得税:</span>
			<span class="inputControl">
				<input class="textbox" type="text" id="salary_gerensuodeshui" name="salary_gerensuodeshui" style="width:80px" />

			</span>

		</div>
		<div>
			<span class="label">五险一金:</span>
			<span class="inputControl">
				<input class="textbox" type="text" id="salary_wuxianyijin" name="salary_wuxianyijin" style="width:80px" />

			</span>

		</div>
		<div>
			<span class="label">应发工资:</span>
			<span class="inputControl">
				<input class="textbox" type="text" id="salary_yingfagongzi" name="salary_yingfagongzi" style="width:80px" />

			</span>

		</div>
		<div>
			<span class="label">实发工资:</span>
			<span class="inputControl">
				<input class="textbox" type="text" id="salary_shifagongzi" name="salary_shifagongzi" style="width:80px" />

			</span>

		</div>
		<div>
			<span class="label">备注:</span>
			<span class="inputControl">
				<textarea id="salary_beizhu" name="salary_beizhu" rows="6" cols="80"></textarea>

			</span>

		</div>
		<div>
			<span class="label">添加时间:</span>
			<span class="inputControl">
				<input class="textbox" type="text" id="salary_addtime" name="salary_addtime" />

			</span>

		</div>
		<div class="operation">
			<a id="salaryAddButton" class="easyui-linkbutton">添加</a>
			<a id="salaryClearButton" class="easyui-linkbutton">重填</a>
		</div> 
	</form>
</div>
<script> var backURL = "__PUBLIC__/index.php/back/";</script>
<script src="__PUBLIC__/backjs/salary/salary_add.js"></script>
