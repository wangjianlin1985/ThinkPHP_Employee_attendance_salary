<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:78:"C:\xampp\htdocs\phpsystem\public/../application/back\view\bumen\bumen_add.html";i:1568642066;}*/ ?>
<link rel="stylesheet" type="text/css" href="__PUBLIC__/backcss/bumen.css" />
<div id="bumenAddDiv">
	<form id="bumenAddForm" enctype="multipart/form-data"  method="post">
		<div>
			<span class="label">部门编号:</span>
			<span class="inputControl">
				<input class="textbox" type="text" id="bumen_bumenbianhao" name="bumen_bumenbianhao" style="width:200px" />

			</span>

		</div>
		<div>
			<span class="label">部门名称:</span>
			<span class="inputControl">
				<input class="textbox" type="text" id="bumen_bumenmingcheng" name="bumen_bumenmingcheng" style="width:200px" />

			</span>

		</div>
		<div>
			<span class="label">添加时间:</span>
			<span class="inputControl">
				<input class="textbox" type="text" id="bumen_addtime" name="bumen_addtime" />

			</span>

		</div>
		<div class="operation">
			<a id="bumenAddButton" class="easyui-linkbutton">添加</a>
			<a id="bumenClearButton" class="easyui-linkbutton">重填</a>
		</div> 
	</form>
</div>
<script> var backURL = "__PUBLIC__/index.php/back/";</script>
<script src="__PUBLIC__/backjs/bumen/bumen_add.js"></script>
