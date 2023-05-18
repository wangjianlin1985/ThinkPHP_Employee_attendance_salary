var salary_manage_tool = null; 
$(function () { 
	initSalaryManageTool(); //建立Salary管理对象
	salary_manage_tool.init(); //如果需要通过下拉框查询，首先初始化下拉框的值
	$("#salary_manage").datagrid({
		url : backURL + getVisitPath("Salary") + '/backList',
		fit : true,
		fitColumns : true,
		striped : true,
		rownumbers : true,
		border : false,
		pagination : true,
		pageSize : 5,
		pageList : [5, 10, 15, 20, 25],
		pageNumber : 1,
		sortName : "salaryId",
		sortOrder : "desc",
		toolbar : "#salary_manage_tool",
		columns : [[
			{
				field : "xingming",
				title : "姓名",
				width : 140,
			},
			{
				field : "bumenmingcheng",
				title : "部门名称",
				width : 140,
			},
			{
				field : "danrenzhiwu",
				title : "担任职务",
				width : 140,
			},
			{
				field : "nianfen",
				title : "年份",
				width : 140,
			},
			{
				field : "yuefen",
				title : "月份",
				width : 140,
			},
			{
				field : "jibengongzi",
				title : "基本工资",
				width : 70,
			},
			{
				field : "quanqinjiangli",
				title : "全勤奖励",
				width : 70,
			},
			{
				field : "kaohejiangli",
				title : "考核奖励",
				width : 70,
			},
			{
				field : "jiabangongzi",
				title : "加班工资",
				width : 70,
			},
			{
				field : "gerensuodeshui",
				title : "个人所得税",
				width : 70,
			},
			{
				field : "yingfagongzi",
				title : "应发工资",
				width : 70,
			},
			{
				field : "shifagongzi",
				title : "实发工资",
				width : 70,
			},
			{
				field : "addtime",
				title : "添加时间",
				width : 140,
			},
		]],
	});

	$("#salaryEditDiv").dialog({
		title : "修改管理",
		top: "50px",
		width : 700,
		height : 515,
		modal : true,
		closed : true,
		iconCls : "icon-edit-new",
		buttons : [{
			text : "提交",
			iconCls : "icon-edit-new",
			handler : function () {
				if ($("#salaryEditForm").form("validate")) {
					//验证表单 
					if(!$("#salaryEditForm").form("validate")) {
						$.messager.alert("错误提示","你输入的信息还有错误！","warning");
					} else {
						$("#salaryEditForm").form({
						    url: backURL + getVisitPath("Salary") + "/update",
						    onSubmit: function(){
								if($("#salaryEditForm").form("validate"))  {
				                	$.messager.progress({
										text : "正在提交数据中...",
									});
				                	return true;
				                } else { 
				                    return false; 
				                }
						    },
						    success:function(data){
						    	$.messager.progress("close");
						    	console.log(data);
			                	var obj = jQuery.parseJSON(data);
			                    if(obj.success){
			                        $.messager.alert("消息","信息修改成功！");
			                        $("#salaryEditDiv").dialog("close");
			                        salary_manage_tool.reload();
			                    }else{
			                        $.messager.alert("消息",obj.message);
			                    } 
						    }
						});
						//提交表单
						$("#salaryEditForm").submit();
					}
				}
			},
		},{
			text : "取消",
			iconCls : "icon-redo",
			handler : function () {
				$("#salaryEditDiv").dialog("close");
				$("#salaryEditForm").form("reset"); 
			},
		}],
	});
});

function initSalaryManageTool() {
	salary_manage_tool = {
		init: function() {
			$.ajax({
				url : backURL + getVisitPath("Employee") + "/listAll",
				type : "post",
				dataType: "json",
				success : function (data, response, status) {
					$("#xingming_bianhao_query").combobox({ 
					    valueField:"bianhao",
					    textField:"xingming",
					    panelHeight: "200px",
				        editable: false, //不允许手动输入 
					});
					data.splice(0,0,{bianhao:"",xingming:"不限制"});
					$("#xingming_bianhao_query").combobox("loadData",data); 
				}
			});
			$.ajax({
				url : backURL + getVisitPath("Bumen") + "/listAll",
				type : "post",
				dataType: "json",
				success : function (data, response, status) {
					$("#bumenmingcheng_bumenbianhao_query").combobox({ 
					    valueField:"bumenbianhao",
					    textField:"bumenmingcheng",
					    panelHeight: "200px",
				        editable: false, //不允许手动输入 
					});
					data.splice(0,0,{bumenbianhao:"",bumenmingcheng:"不限制"});
					$("#bumenmingcheng_bumenbianhao_query").combobox("loadData",data); 
				}
			});
		},
		reload : function () {
			$("#salary_manage").datagrid("reload");
		},
		redo : function () {
			$("#salary_manage").datagrid("unselectAll");
		},
		search: function() {
			var queryParams = $("#salary_manage").datagrid("options").queryParams;
			queryParams["nianfen"] = $("#nianfen").val();
			queryParams["yuefen"] = $("#yuefen").val();
			queryParams["addtime"] = $("#addtime").datebox("getValue"); 
			queryParams["xingming.bianhao"] = $("#xingming_bianhao_query").combobox("getValue");
			queryParams["bumenmingcheng.bumenbianhao"] = $("#bumenmingcheng_bumenbianhao_query").combobox("getValue");
			$("#salary_manage").datagrid("options").queryParams=queryParams; 
			$("#salary_manage").datagrid("load");
		},
		exportExcel: function() {
			$("#salaryQueryForm").form({
			    url: backURL + getVisitPath("Salary") + "/outToExcel",
			});
			//提交表单
			$("#salaryQueryForm").submit();
		},
		remove : function () {
			var rows = $("#salary_manage").datagrid("getSelections");
			if (rows.length > 0) {
				$.messager.confirm("确定操作", "您正在要删除所选的记录吗？", function (flag) {
					if (flag) {
						var salaryIds = [];
						for (var i = 0; i < rows.length; i ++) {
							salaryIds.push(rows[i].salaryId);
						}
						$.ajax({
							type : "POST",
							url :  backURL + getVisitPath("Salary") + "/deletes",
							data : {
								salaryIds : salaryIds.join(","),
							},
							dataType: "json",
							beforeSend : function () {
								$("#salary_manage").datagrid("loading");
							},
							success : function (data) {
								if (data.success) {
									$("#salary_manage").datagrid("loaded");
									$("#salary_manage").datagrid("load");
									$("#salary_manage").datagrid("unselectAll");
									$.messager.show({
										title : "提示",
										msg : data.message
									});
								} else {
									$("#salary_manage").datagrid("loaded");
									$("#salary_manage").datagrid("load");
									$("#salary_manage").datagrid("unselectAll");
									$.messager.alert("消息",data.message);
								}
							},
						});
					}
				});
			} else {
				$.messager.alert("提示", "请选择要删除的记录！", "info");
			}
		},
		edit : function () {
			var rows = $("#salary_manage").datagrid("getSelections");
			if (rows.length > 1) {
				$.messager.alert("警告操作！", "编辑记录只能选定一条数据！", "warning");
			} else if (rows.length == 1) {
				$.ajax({
					url : backURL + getVisitPath("Salary") + "/update",
					type : "get",
					data : {
						salaryId : rows[0].salaryId,
					},
					dataType: "json",
					beforeSend : function () {
						$.messager.progress({
							text : "正在获取中...",
						});
					},
					success : function (salary, response, status) {
						$.messager.progress("close");
						if (salary) { 
							$("#salaryEditDiv").dialog("open");
							$("#salary_salaryId_edit").val(salary.salaryId);
							$("#salary_salaryId_edit").validatebox({
								required : true,
								missingMessage : "请输入工资id",
								editable: false
							});
							$("#salary_xingming_bianhao_edit").combobox({
							    url: backURL + getVisitPath("Employee") + "/listAll",
							    dataType: "json",
							    valueField:"bianhao",
							    textField:"xingming",
							    panelHeight: "auto",
						        editable: false, //不允许手动输入 
						        onLoadSuccess: function () { //数据加载完毕事件
									$("#salary_xingming_bianhao_edit").combobox("select", salary.xingming);
									//var data = $("#salary_xingming_bianhao_edit").combobox("getData"); 
						            //if (data.length > 0) {
						                //$("#salary_xingming_bianhao_edit").combobox("select", data[0].bianhao);
						            //}
								}
							});
							$("#salary_bumenmingcheng_bumenbianhao_edit").combobox({
							    url: backURL + getVisitPath("Bumen") + "/listAll",
							    dataType: "json",
							    valueField:"bumenbianhao",
							    textField:"bumenmingcheng",
							    panelHeight: "auto",
						        editable: false, //不允许手动输入 
						        onLoadSuccess: function () { //数据加载完毕事件
									$("#salary_bumenmingcheng_bumenbianhao_edit").combobox("select", salary.bumenmingcheng);
									//var data = $("#salary_bumenmingcheng_bumenbianhao_edit").combobox("getData"); 
						            //if (data.length > 0) {
						                //$("#salary_bumenmingcheng_bumenbianhao_edit").combobox("select", data[0].bumenbianhao);
						            //}
								}
							});
							$("#salary_danrenzhiwu_edit").val(salary.danrenzhiwu);
							$("#salary_danrenzhiwu_edit").validatebox({
								required : true,
								missingMessage : "请输入担任职务",
							});
							$("#salary_nianfen_edit").val(salary.nianfen);
							$("#salary_nianfen_edit").validatebox({
								required : true,
								missingMessage : "请输入年份",
							});
							$("#salary_yuefen_edit").val(salary.yuefen);
							$("#salary_yuefen_edit").validatebox({
								required : true,
								missingMessage : "请输入月份",
							});
							$("#salary_jibengongzi_edit").val(salary.jibengongzi);
							$("#salary_jibengongzi_edit").validatebox({
								required : true,
								validType : "number",
								missingMessage : "请输入基本工资",
								invalidMessage : "基本工资输入不对",
							});
							$("#salary_quanqinjiangli_edit").val(salary.quanqinjiangli);
							$("#salary_quanqinjiangli_edit").validatebox({
								required : true,
								validType : "number",
								missingMessage : "请输入全勤奖励",
								invalidMessage : "全勤奖励输入不对",
							});
							$("#salary_kaohejiangli_edit").val(salary.kaohejiangli);
							$("#salary_kaohejiangli_edit").validatebox({
								required : true,
								validType : "number",
								missingMessage : "请输入考核奖励",
								invalidMessage : "考核奖励输入不对",
							});
							$("#salary_jiabangongzi_edit").val(salary.jiabangongzi);
							$("#salary_jiabangongzi_edit").validatebox({
								required : true,
								validType : "number",
								missingMessage : "请输入加班工资",
								invalidMessage : "加班工资输入不对",
							});
							$("#salary_jintiebuzhu_edit").val(salary.jintiebuzhu);
							$("#salary_jintiebuzhu_edit").validatebox({
								required : true,
								validType : "number",
								missingMessage : "请输入津贴补助",
								invalidMessage : "津贴补助输入不对",
							});
							$("#salary_chengfajine_edit").val(salary.chengfajine);
							$("#salary_chengfajine_edit").validatebox({
								required : true,
								validType : "number",
								missingMessage : "请输入惩罚金额",
								invalidMessage : "惩罚金额输入不对",
							});
							$("#salary_gerensuodeshui_edit").val(salary.gerensuodeshui);
							$("#salary_gerensuodeshui_edit").validatebox({
								required : true,
								validType : "number",
								missingMessage : "请输入个人所得税",
								invalidMessage : "个人所得税输入不对",
							});
							$("#salary_wuxianyijin_edit").val(salary.wuxianyijin);
							$("#salary_wuxianyijin_edit").validatebox({
								required : true,
								validType : "number",
								missingMessage : "请输入五险一金",
								invalidMessage : "五险一金输入不对",
							});
							$("#salary_yingfagongzi_edit").val(salary.yingfagongzi);
							$("#salary_yingfagongzi_edit").validatebox({
								required : true,
								validType : "number",
								missingMessage : "请输入应发工资",
								invalidMessage : "应发工资输入不对",
							});
							$("#salary_shifagongzi_edit").val(salary.shifagongzi);
							$("#salary_shifagongzi_edit").validatebox({
								required : true,
								validType : "number",
								missingMessage : "请输入实发工资",
								invalidMessage : "实发工资输入不对",
							});
							$("#salary_beizhu_edit").val(salary.beizhu);
							$("#salary_addtime_edit").datetimebox({
								value: salary.addtime,
							    required: true,
							    showSeconds: true,
							});
						} else {
							$.messager.alert("获取失败！", "未知错误导致失败，请重试！", "warning");
						}
					}
				});
			} else if (rows.length == 0) {
				$.messager.alert("警告操作！", "编辑记录至少选定一条数据！", "warning");
			}
		},
	};
}
