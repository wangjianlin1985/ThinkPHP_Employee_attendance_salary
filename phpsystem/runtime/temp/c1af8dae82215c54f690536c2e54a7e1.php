<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:78:"C:\xampp\htdocs\phpsystem\public/../application/back\view\kaohe\kaohe_add.html";i:1568642068;}*/ ?>
<link rel="stylesheet" type="text/css" href="__PUBLIC__/backcss/kaohe.css" />
<div id="kaoheAddDiv">
	<form id="kaoheAddForm" enctype="multipart/form-data"  method="post">
		<div>
			<span class="label">姓名:</span>
			<span class="inputControl">
				<input class="textbox" type="text" id="kaohe_xingming_bianhao" name="kaohe.xingming.bianhao" style="width: auto"/>
			</span>
		</div>
		<div>
			<span class="label">部门:</span>
			<span class="inputControl">
				<input class="textbox" type="text" id="kaohe_bumenObj_bumenbianhao" name="kaohe.bumenObj.bumenbianhao" style="width: auto"/>
			</span>
		</div>
		<div>
			<span class="label">职务:</span>
			<span class="inputControl">
				<input class="textbox" type="text" id="kaohe_zhiwu" name="kaohe_zhiwu" style="width:200px" />

			</span>

		</div>
		<div>
			<span class="label">年份:</span>
			<span class="inputControl">
				<input class="textbox" type="text" id="kaohe_nianfen" name="kaohe_nianfen" style="width:200px" />

			</span>

		</div>
		<div>
			<span class="label">月份:</span>
			<span class="inputControl">
				<input class="textbox" type="text" id="kaohe_yuefen" name="kaohe_yuefen" style="width:200px" />

			</span>

		</div>
		<div>
			<span class="label">考核结果:</span>
			<span class="inputControl">
				<textarea id="kaohe_kaohejieguo" name="kaohe_kaohejieguo" rows="6" cols="80"></textarea>

			</span>

		</div>
		<div>
			<span class="label">考核奖励:</span>
			<span class="inputControl">
				<textarea id="kaohe_kaohejiangli" name="kaohe_kaohejiangli" rows="6" cols="80"></textarea>

			</span>

		</div>
		<div>
			<span class="label">考核部门:</span>
			<span class="inputControl">
				<input class="textbox" type="text" id="kaohe_kaohebumen_bumenbianhao" name="kaohe.kaohebumen.bumenbianhao" style="width: auto"/>
			</span>
		</div>
		<div>
			<span class="label">考核人:</span>
			<span class="inputControl">
				<input class="textbox" type="text" id="kaohe_kaoheren" name="kaohe_kaoheren" style="width:200px" />

			</span>

		</div>
		<div>
			<span class="label">考核内容:</span>
			<span class="inputControl">
				<textarea id="kaohe_kaoheneirong" name="kaohe_kaoheneirong" rows="6" cols="80"></textarea>

			</span>

		</div>
		<div>
			<span class="label">添加时间:</span>
			<span class="inputControl">
				<input class="textbox" type="text" id="kaohe_addtime" name="kaohe_addtime" />

			</span>

		</div>
		<div class="operation">
			<a id="kaoheAddButton" class="easyui-linkbutton">添加</a>
			<a id="kaoheClearButton" class="easyui-linkbutton">重填</a>
		</div> 
	</form>
</div>
<script> var backURL = "__PUBLIC__/index.php/back/";</script>
<script src="__PUBLIC__/backjs/kaohe/kaohe_add.js"></script>
