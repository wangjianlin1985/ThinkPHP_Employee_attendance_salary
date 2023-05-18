var employee_manage_tool = null; 
$(function () { 
	initEmployeeManageTool(); //建立Employee管理对象
	employee_manage_tool.init(); //如果需要通过下拉框查询，首先初始化下拉框的值
	$("#employee_manage").datagrid({
		url : backURL + getVisitPath("Employee") + '/backList',
		fit : true,
		fitColumns : true,
		striped : true,
		rownumbers : true,
		border : false,
		pagination : true,
		pageSize : 5,
		pageList : [5, 10, 15, 20, 25],
		pageNumber : 1,
		sortName : "bianhao",
		sortOrder : "desc",
		toolbar : "#employee_manage_tool",
		columns : [[
			{
				field : "bianhao",
				title : "员工编号",
				width : 140,
			},
			{
				field : "xingming",
				title : "姓名",
				width : 140,
			},
			{
				field : "xingbie",
				title : "性别",
				width : 140,
			},
			{
				field : "bumenObj",
				title : "部门",
				width : 140,
			},
			{
				field : "danrenzhiwu",
				title : "担任职务",
				width : 140,
			},
			{
				field : "minzu",
				title : "民族",
				width : 140,
			},
			{
				field : "chushengriqi",
				title : "出生日期",
				width : 140,
			},
			{
				field : "shenfenzhenghao",
				title : "身份证号",
				width : 140,
			},
			{
				field : "jiguan",
				title : "籍贯",
				width : 140,
			},
			{
				field : "zhaopian",
				title : "照片",
				width : "70px",
				height: "65px",
				formatter: function(val,row) {
					return "<img src='" + publicURL + val + "' width='65px' height='55px' />";
				}
 			},
			{
				field : "addtime",
				title : "添加时间",
				width : 140,
			},
		]],
	});

	$("#employeeEditDiv").dialog({
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
				if ($("#employeeEditForm").form("validate")) {
					//验证表单 
					if(!$("#employeeEditForm").form("validate")) {
						$.messager.alert("错误提示","你输入的信息还有错误！","warning");
					} else {
						$("#employeeEditForm").form({
						    url: backURL + getVisitPath("Employee") + "/update",
						    onSubmit: function(){
								if($("#employeeEditForm").form("validate"))  {
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
			                        $("#employeeEditDiv").dialog("close");
			                        employee_manage_tool.reload();
			                    }else{
			                        $.messager.alert("消息",obj.message);
			                    } 
						    }
						});
						//提交表单
						$("#employeeEditForm").submit();
					}
				}
			},
		},{
			text : "取消",
			iconCls : "icon-redo",
			handler : function () {
				$("#employeeEditDiv").dialog("close");
				$("#employeeEditForm").form("reset"); 
			},
		}],
	});
});

function initEmployeeManageTool() {
	employee_manage_tool = {
		init: function() {
			$.ajax({
				url : backURL + getVisitPath("Bumen") + "/listAll",
				type : "post",
				dataType: "json",
				success : function (data, response, status) {
					$("#bumenObj_bumenbianhao_query").combobox({ 
					    valueField:"bumenbianhao",
					    textField:"bumenmingcheng",
					    panelHeight: "200px",
				        editable: false, //不允许手动输入 
					});
					data.splice(0,0,{bumenbianhao:"",bumenmingcheng:"不限制"});
					$("#bumenObj_bumenbianhao_query").combobox("loadData",data); 
				}
			});
		},
		reload : function () {
			$("#employee_manage").datagrid("reload");
		},
		redo : function () {
			$("#employee_manage").datagrid("unselectAll");
		},
		search: function() {
			var queryParams = $("#employee_manage").datagrid("options").queryParams;
			queryParams["bianhao"] = $("#bianhao").val();
			queryParams["xingming"] = $("#xingming").val();
			queryParams["bumenObj.bumenbianhao"] = $("#bumenObj_bumenbianhao_query").combobox("getValue");
			queryParams["danrenzhiwu"] = $("#danrenzhiwu").val();
			queryParams["chushengriqi"] = $("#chushengriqi").datebox("getValue"); 
			queryParams["shenfenzhenghao"] = $("#shenfenzhenghao").val();
			$("#employee_manage").datagrid("options").queryParams=queryParams; 
			$("#employee_manage").datagrid("load");
		},
		exportExcel: function() {
			$("#employeeQueryForm").form({
			    url: backURL + getVisitPath("Employee") + "/outToExcel",
			});
			//提交表单
			$("#employeeQueryForm").submit();
		},
		remove : function () {
			var rows = $("#employee_manage").datagrid("getSelections");
			if (rows.length > 0) {
				$.messager.confirm("确定操作", "您正在要删除所选的记录吗？", function (flag) {
					if (flag) {
						var bianhaos = [];
						for (var i = 0; i < rows.length; i ++) {
							bianhaos.push(rows[i].bianhao);
						}
						$.ajax({
							type : "POST",
							url :  backURL + getVisitPath("Employee") + "/deletes",
							data : {
								bianhaos : bianhaos.join(","),
							},
							dataType: "json",
							beforeSend : function () {
								$("#employee_manage").datagrid("loading");
							},
							success : function (data) {
								if (data.success) {
									$("#employee_manage").datagrid("loaded");
									$("#employee_manage").datagrid("load");
									$("#employee_manage").datagrid("unselectAll");
									$.messager.show({
										title : "提示",
										msg : data.message
									});
								} else {
									$("#employee_manage").datagrid("loaded");
									$("#employee_manage").datagrid("load");
									$("#employee_manage").datagrid("unselectAll");
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
			var rows = $("#employee_manage").datagrid("getSelections");
			if (rows.length > 1) {
				$.messager.alert("警告操作！", "编辑记录只能选定一条数据！", "warning");
			} else if (rows.length == 1) {
				$.ajax({
					url : backURL + getVisitPath("Employee") + "/update",
					type : "get",
					data : {
						bianhao : rows[0].bianhao,
					},
					dataType: "json",
					beforeSend : function () {
						$.messager.progress({
							text : "正在获取中...",
						});
					},
					success : function (employee, response, status) {
						$.messager.progress("close");
						if (employee) { 
							$("#employeeEditDiv").dialog("open");
							$("#employee_bianhao_edit").val(employee.bianhao);
							$("#employee_bianhao_edit").validatebox({
								required : true,
								missingMessage : "请输入员工编号",
								editable: false
							});
							$("#employee_mima_edit").val(employee.mima);
							$("#employee_mima_edit").validatebox({
								required : true,
								missingMessage : "请输入密码",
							});
							$("#employee_xingming_edit").val(employee.xingming);
							$("#employee_xingming_edit").validatebox({
								required : true,
								missingMessage : "请输入姓名",
							});
							$("#employee_xingbie_edit").val(employee.xingbie);
							$("#employee_xingbie_edit").validatebox({
								required : true,
								missingMessage : "请输入性别",
							});
							$("#employee_bumenObj_bumenbianhao_edit").combobox({
							    url: backURL + getVisitPath("Bumen") + "/listAll",
							    dataType: "json",
							    valueField:"bumenbianhao",
							    textField:"bumenmingcheng",
							    panelHeight: "auto",
						        editable: false, //不允许手动输入 
						        onLoadSuccess: function () { //数据加载完毕事件
									$("#employee_bumenObj_bumenbianhao_edit").combobox("select", employee.bumenObj);
									//var data = $("#employee_bumenObj_bumenbianhao_edit").combobox("getData"); 
						            //if (data.length > 0) {
						                //$("#employee_bumenObj_bumenbianhao_edit").combobox("select", data[0].bumenbianhao);
						            //}
								}
							});
							$("#employee_danrenzhiwu_edit").val(employee.danrenzhiwu);
							$("#employee_danrenzhiwu_edit").validatebox({
								required : true,
								missingMessage : "请输入担任职务",
							});
							$("#employee_minzu_edit").val(employee.minzu);
							$("#employee_minzu_edit").validatebox({
								required : true,
								missingMessage : "请输入民族",
							});
							$("#employee_chushengriqi_edit").datebox({
								value: employee.chushengriqi,
							    required: true,
							    showSeconds: true,
							});
							$("#employee_shenfenzhenghao_edit").val(employee.shenfenzhenghao);
							$("#employee_shenfenzhenghao_edit").validatebox({
								required : true,
								missingMessage : "请输入身份证号",
							});
							$("#employee_jiguan_edit").val(employee.jiguan);
							$("#employee_jiguan_edit").validatebox({
								required : true,
								missingMessage : "请输入籍贯",
							});
							$("#employee_wenhuachengdu_edit").val(employee.wenhuachengdu);
							$("#employee_wenhuachengdu_edit").validatebox({
								required : true,
								missingMessage : "请输入文化程度",
							});
							$("#employee_zhengzhimianmao_edit").val(employee.zhengzhimianmao);
							$("#employee_zhengzhimianmao_edit").validatebox({
								required : true,
								missingMessage : "请输入政治面貌",
							});
							$("#employee_hunyinqingkuang_edit").val(employee.hunyinqingkuang);
							$("#employee_hunyinqingkuang_edit").validatebox({
								required : true,
								missingMessage : "请输入婚姻状况",
							});
							$("#employee_biyeyuanxiao_edit").val(employee.biyeyuanxiao);
							$("#employee_biyeyuanxiao_edit").validatebox({
								required : true,
								missingMessage : "请输入毕业院校",
							});
							$("#employee_zhuanye_edit").val(employee.zhuanye);
							$("#employee_zhuanye_edit").validatebox({
								required : true,
								missingMessage : "请输入专业",
							});
							$("#employee_biyeshijian_edit").datebox({
								value: employee.biyeshijian,
							    required: true,
							    showSeconds: true,
							});
							$("#employee_shoujihao_edit").val(employee.shoujihao);
							$("#employee_shoujihao_edit").validatebox({
								required : true,
								missingMessage : "请输入手机号",
							});
							$("#employee_jibengongzi_edit").val(employee.jibengongzi);
							$("#employee_jibengongzi_edit").validatebox({
								required : true,
								validType : "number",
								missingMessage : "请输入基本工资",
								invalidMessage : "基本工资输入不对",
							});
							$("#employee_xianzhuzhi_edit").val(employee.xianzhuzhi);
							$("#employee_xianzhuzhi_edit").validatebox({
								required : true,
								missingMessage : "请输入现住址",
							});
							$("#employee_zhaopian").val(employee.zhaopian);
							$("#employee_zhaopianImg").attr("src", publicURL + employee.zhaopian);
							$("#employee_beizhu_edit").val(employee.beizhu);
							$("#employee_addtime_edit").datetimebox({
								value: employee.addtime,
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
