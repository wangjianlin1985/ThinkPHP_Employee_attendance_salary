<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:80:"C:\xampp\htdocs\phpsystem\public/../application/back\view\kaoqin\kaoqin_add.html";i:1568642069;}*/ ?>
<link rel="stylesheet" type="text/css" href="__PUBLIC__/backcss/kaoqin.css" />
<div id="kaoqinAddDiv">
	<form id="kaoqinAddForm" enctype="multipart/form-data"  method="post">
		<div>
			<span class="label">姓名:</span>
			<span class="inputControl">
				<input class="textbox" type="text" id="kaoqin_xingming_bianhao" name="kaoqin.xingming.bianhao" style="width: auto"/>
			</span>
		</div>
		<div>
			<span class="label">性别:</span>
			<span class="inputControl">
				<input class="textbox" type="text" id="kaoqin_xingbie" name="kaoqin_xingbie" style="width:200px" />

			</span>

		</div>
		<div>
			<span class="label">所属部门:</span>
			<span class="inputControl">
				<input class="textbox" type="text" id="kaoqin_suoshubumen_bumenbianhao" name="kaoqin.suoshubumen.bumenbianhao" style="width: auto"/>
			</span>
		</div>
		<div>
			<span class="label">担任职务:</span>
			<span class="inputControl">
				<input class="textbox" type="text" id="kaoqin_danrenzhiwu" name="kaoqin_danrenzhiwu" style="width:200px" />

			</span>

		</div>
		<div>
			<span class="label">年份:</span>
			<span class="inputControl">
				<input class="textbox" type="text" id="kaoqin_nianfen" name="kaoqin_nianfen" style="width:200px" />

			</span>

		</div>
		<div>
			<span class="label">月份:</span>
			<span class="inputControl">
				<input class="textbox" type="text" id="kaoqin_yuefen" name="kaoqin_yuefen" style="width:200px" />

			</span>

		</div>
		<div>
			<span class="label">到勤天数:</span>
			<span class="inputControl">
				<input class="textbox" type="text" id="kaoqin_daoqintianshu" name="kaoqin_daoqintianshu" style="width:80px" />

			</span>

		</div>
		<div>
			<span class="label">迟到天数:</span>
			<span class="inputControl">
				<input class="textbox" type="text" id="kaoqin_chidaotianshu" name="kaoqin_chidaotianshu" style="width:80px" />

			</span>

		</div>
		<div>
			<span class="label">旷工天数:</span>
			<span class="inputControl">
				<input class="textbox" type="text" id="kaoqin_kuangdaotianshu" name="kaoqin_kuangdaotianshu" style="width:80px" />

			</span>

		</div>
		<div>
			<span class="label">请假天数:</span>
			<span class="inputControl">
				<input class="textbox" type="text" id="kaoqin_qingjiatianshu" name="kaoqin_qingjiatianshu" style="width:80px" />

			</span>

		</div>
		<div>
			<span class="label">备注:</span>
			<span class="inputControl">
				<textarea id="kaoqin_beizhu" name="kaoqin_beizhu" rows="6" cols="80"></textarea>

			</span>

		</div>
		<div>
			<span class="label">添加时间:</span>
			<span class="inputControl">
				<input class="textbox" type="text" id="kaoqin_addtime" name="kaoqin_addtime" />

			</span>

		</div>
		<div class="operation">
			<a id="kaoqinAddButton" class="easyui-linkbutton">添加</a>
			<a id="kaoqinClearButton" class="easyui-linkbutton">重填</a>
		</div> 
	</form>
</div>
<script> var backURL = "__PUBLIC__/index.php/back/";</script>
<script src="__PUBLIC__/backjs/kaoqin/kaoqin_add.js"></script>
