<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:84:"C:\xampp\htdocs\phpsystem\public/../application/back\view\diaodong\diaodong_add.html";i:1568642067;}*/ ?>
<link rel="stylesheet" type="text/css" href="__PUBLIC__/backcss/diaodong.css" />
<div id="diaodongAddDiv">
	<form id="diaodongAddForm" enctype="multipart/form-data"  method="post">
		<div>
			<span class="label">姓名:</span>
			<span class="inputControl">
				<input class="textbox" type="text" id="diaodong_xingming_bianhao" name="diaodong.xingming.bianhao" style="width: auto"/>
			</span>
		</div>
		<div>
			<span class="label">部门名称:</span>
			<span class="inputControl">
				<input class="textbox" type="text" id="diaodong_bumenmingcheng_bumenbianhao" name="diaodong.bumenmingcheng.bumenbianhao" style="width: auto"/>
			</span>
		</div>
		<div>
			<span class="label">担任职务:</span>
			<span class="inputControl">
				<input class="textbox" type="text" id="diaodong_danrenzhiwu" name="diaodong_danrenzhiwu" style="width:200px" />

			</span>

		</div>
		<div>
			<span class="label">原基本工资:</span>
			<span class="inputControl">
				<input class="textbox" type="text" id="diaodong_yuanjibengongzi" name="diaodong_yuanjibengongzi" style="width:80px" />

			</span>

		</div>
		<div>
			<span class="label">调动职位:</span>
			<span class="inputControl">
				<input class="textbox" type="text" id="diaodong_diaodongzhiwei" name="diaodong_diaodongzhiwei" style="width:200px" />

			</span>

		</div>
		<div>
			<span class="label">调动部门:</span>
			<span class="inputControl">
				<input class="textbox" type="text" id="diaodong_diaodongbumen_bumenbianhao" name="diaodong.diaodongbumen.bumenbianhao" style="width: auto"/>
			</span>
		</div>
		<div>
			<span class="label">调动日期:</span>
			<span class="inputControl">
				<input class="textbox" type="text" id="diaodong_diaodongriqi" name="diaodong_diaodongriqi" />

			</span>

		</div>
		<div>
			<span class="label">现基本工资:</span>
			<span class="inputControl">
				<input class="textbox" type="text" id="diaodong_xianjibengongzi" name="diaodong_xianjibengongzi" style="width:80px" />

			</span>

		</div>
		<div>
			<span class="label">调动原因:</span>
			<span class="inputControl">
				<input class="textbox" type="text" id="diaodong_diaodongyuanyin" name="diaodong_diaodongyuanyin" style="width:200px" />

			</span>

		</div>
		<div>
			<span class="label">添加时间:</span>
			<span class="inputControl">
				<input class="textbox" type="text" id="diaodong_addtime" name="diaodong_addtime" />

			</span>

		</div>
		<div class="operation">
			<a id="diaodongAddButton" class="easyui-linkbutton">添加</a>
			<a id="diaodongClearButton" class="easyui-linkbutton">重填</a>
		</div> 
	</form>
</div>
<script> var backURL = "__PUBLIC__/index.php/back/";</script>
<script src="__PUBLIC__/backjs/diaodong/diaodong_add.js"></script>
