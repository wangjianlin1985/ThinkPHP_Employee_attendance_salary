<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:80:"C:\xampp\htdocs\phpsystem\public/../application/back\view\peixun\peixun_add.html";i:1568642070;}*/ ?>
<link rel="stylesheet" type="text/css" href="__PUBLIC__/backcss/peixun.css" />
<div id="peixunAddDiv">
	<form id="peixunAddForm" enctype="multipart/form-data"  method="post">
		<div>
			<span class="label">培训名称:</span>
			<span class="inputControl">
				<input class="textbox" type="text" id="peixun_mingcheng" name="peixun_mingcheng" style="width:200px" />

			</span>

		</div>
		<div>
			<span class="label">培训时间:</span>
			<span class="inputControl">
				<input class="textbox" type="text" id="peixun_shijian" name="peixun_shijian" />

			</span>

		</div>
		<div>
			<span class="label">培训清单:</span>
			<span class="inputControl">
				<textarea id="peixun_qingdan" name="peixun_qingdan" rows="6" cols="80"></textarea>

			</span>

		</div>
		<div>
			<span class="label">培训地点:</span>
			<span class="inputControl">
				<input class="textbox" type="text" id="peixun_didian" name="peixun_didian" style="width:200px" />

			</span>

		</div>
		<div>
			<span class="label">添加时间:</span>
			<span class="inputControl">
				<input class="textbox" type="text" id="peixun_addtime" name="peixun_addtime" />

			</span>

		</div>
		<div class="operation">
			<a id="peixunAddButton" class="easyui-linkbutton">添加</a>
			<a id="peixunClearButton" class="easyui-linkbutton">重填</a>
		</div> 
	</form>
</div>
<script> var backURL = "__PUBLIC__/index.php/back/";</script>
<script src="__PUBLIC__/backjs/peixun/peixun_add.js"></script>
