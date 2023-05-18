var peixun_manage_tool = null; 
$(function () { 
	initPeixunManageTool(); //建立Peixun管理对象
	peixun_manage_tool.init(); //如果需要通过下拉框查询，首先初始化下拉框的值
	$("#peixun_manage").datagrid({
		url : backURL + getVisitPath("Peixun") + '/backList',
		fit : true,
		fitColumns : true,
		striped : true,
		rownumbers : true,
		border : false,
		pagination : true,
		pageSize : 5,
		pageList : [5, 10, 15, 20, 25],
		pageNumber : 1,
		sortName : "peixunId",
		sortOrder : "desc",
		toolbar : "#peixun_manage_tool",
		columns : [[
			{
				field : "peixunId",
				title : "培训id",
				width : 70,
			},
			{
				field : "mingcheng",
				title : "培训名称",
				width : 140,
			},
			{
				field : "shijian",
				title : "培训时间",
				width : 140,
			},
			{
				field : "didian",
				title : "培训地点",
				width : 140,
			},
			{
				field : "addtime",
				title : "添加时间",
				width : 140,
			},
		]],
	});

	$("#peixunEditDiv").dialog({
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
				if ($("#peixunEditForm").form("validate")) {
					//验证表单 
					if(!$("#peixunEditForm").form("validate")) {
						$.messager.alert("错误提示","你输入的信息还有错误！","warning");
					} else {
						$("#peixunEditForm").form({
						    url: backURL + getVisitPath("Peixun") + "/update",
						    onSubmit: function(){
								if($("#peixunEditForm").form("validate"))  {
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
			                        $("#peixunEditDiv").dialog("close");
			                        peixun_manage_tool.reload();
			                    }else{
			                        $.messager.alert("消息",obj.message);
			                    } 
						    }
						});
						//提交表单
						$("#peixunEditForm").submit();
					}
				}
			},
		},{
			text : "取消",
			iconCls : "icon-redo",
			handler : function () {
				$("#peixunEditDiv").dialog("close");
				$("#peixunEditForm").form("reset"); 
			},
		}],
	});
});

function initPeixunManageTool() {
	peixun_manage_tool = {
		init: function() {
		},
		reload : function () {
			$("#peixun_manage").datagrid("reload");
		},
		redo : function () {
			$("#peixun_manage").datagrid("unselectAll");
		},
		search: function() {
			var queryParams = $("#peixun_manage").datagrid("options").queryParams;
			queryParams["mingcheng"] = $("#mingcheng").val();
			queryParams["shijian"] = $("#shijian").datebox("getValue"); 
			queryParams["didian"] = $("#didian").val();
			queryParams["addtime"] = $("#addtime").datebox("getValue"); 
			$("#peixun_manage").datagrid("options").queryParams=queryParams; 
			$("#peixun_manage").datagrid("load");
		},
		exportExcel: function() {
			$("#peixunQueryForm").form({
			    url: backURL + getVisitPath("Peixun") + "/outToExcel",
			});
			//提交表单
			$("#peixunQueryForm").submit();
		},
		remove : function () {
			var rows = $("#peixun_manage").datagrid("getSelections");
			if (rows.length > 0) {
				$.messager.confirm("确定操作", "您正在要删除所选的记录吗？", function (flag) {
					if (flag) {
						var peixunIds = [];
						for (var i = 0; i < rows.length; i ++) {
							peixunIds.push(rows[i].peixunId);
						}
						$.ajax({
							type : "POST",
							url :  backURL + getVisitPath("Peixun") + "/deletes",
							data : {
								peixunIds : peixunIds.join(","),
							},
							dataType: "json",
							beforeSend : function () {
								$("#peixun_manage").datagrid("loading");
							},
							success : function (data) {
								if (data.success) {
									$("#peixun_manage").datagrid("loaded");
									$("#peixun_manage").datagrid("load");
									$("#peixun_manage").datagrid("unselectAll");
									$.messager.show({
										title : "提示",
										msg : data.message
									});
								} else {
									$("#peixun_manage").datagrid("loaded");
									$("#peixun_manage").datagrid("load");
									$("#peixun_manage").datagrid("unselectAll");
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
			var rows = $("#peixun_manage").datagrid("getSelections");
			if (rows.length > 1) {
				$.messager.alert("警告操作！", "编辑记录只能选定一条数据！", "warning");
			} else if (rows.length == 1) {
				$.ajax({
					url : backURL + getVisitPath("Peixun") + "/update",
					type : "get",
					data : {
						peixunId : rows[0].peixunId,
					},
					dataType: "json",
					beforeSend : function () {
						$.messager.progress({
							text : "正在获取中...",
						});
					},
					success : function (peixun, response, status) {
						$.messager.progress("close");
						if (peixun) { 
							$("#peixunEditDiv").dialog("open");
							$("#peixun_peixunId_edit").val(peixun.peixunId);
							$("#peixun_peixunId_edit").validatebox({
								required : true,
								missingMessage : "请输入培训id",
								editable: false
							});
							$("#peixun_mingcheng_edit").val(peixun.mingcheng);
							$("#peixun_mingcheng_edit").validatebox({
								required : true,
								missingMessage : "请输入培训名称",
							});
							$("#peixun_shijian_edit").datebox({
								value: peixun.shijian,
							    required: true,
							    showSeconds: true,
							});
							$("#peixun_qingdan_edit").val(peixun.qingdan);
							$("#peixun_qingdan_edit").validatebox({
								required : true,
								missingMessage : "请输入培训清单",
							});
							$("#peixun_didian_edit").val(peixun.didian);
							$("#peixun_didian_edit").validatebox({
								required : true,
								missingMessage : "请输入培训地点",
							});
							$("#peixun_addtime_edit").datetimebox({
								value: peixun.addtime,
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
