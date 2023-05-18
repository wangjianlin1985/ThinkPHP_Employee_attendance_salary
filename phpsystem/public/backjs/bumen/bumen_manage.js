var bumen_manage_tool = null; 
$(function () { 
	initBumenManageTool(); //建立Bumen管理对象
	bumen_manage_tool.init(); //如果需要通过下拉框查询，首先初始化下拉框的值
	$("#bumen_manage").datagrid({
		url : backURL + getVisitPath("Bumen") + '/backList',
		fit : true,
		fitColumns : true,
		striped : true,
		rownumbers : true,
		border : false,
		pagination : true,
		pageSize : 5,
		pageList : [5, 10, 15, 20, 25],
		pageNumber : 1,
		sortName : "bumenbianhao",
		sortOrder : "desc",
		toolbar : "#bumen_manage_tool",
		columns : [[
			{
				field : "bumenbianhao",
				title : "部门编号",
				width : 140,
			},
			{
				field : "bumenmingcheng",
				title : "部门名称",
				width : 140,
			},
			{
				field : "addtime",
				title : "添加时间",
				width : 140,
			},
		]],
	});

	$("#bumenEditDiv").dialog({
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
				if ($("#bumenEditForm").form("validate")) {
					//验证表单 
					if(!$("#bumenEditForm").form("validate")) {
						$.messager.alert("错误提示","你输入的信息还有错误！","warning");
					} else {
						$("#bumenEditForm").form({
						    url: backURL + getVisitPath("Bumen") + "/update",
						    onSubmit: function(){
								if($("#bumenEditForm").form("validate"))  {
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
			                        $("#bumenEditDiv").dialog("close");
			                        bumen_manage_tool.reload();
			                    }else{
			                        $.messager.alert("消息",obj.message);
			                    } 
						    }
						});
						//提交表单
						$("#bumenEditForm").submit();
					}
				}
			},
		},{
			text : "取消",
			iconCls : "icon-redo",
			handler : function () {
				$("#bumenEditDiv").dialog("close");
				$("#bumenEditForm").form("reset"); 
			},
		}],
	});
});

function initBumenManageTool() {
	bumen_manage_tool = {
		init: function() {
		},
		reload : function () {
			$("#bumen_manage").datagrid("reload");
		},
		redo : function () {
			$("#bumen_manage").datagrid("unselectAll");
		},
		search: function() {
			var queryParams = $("#bumen_manage").datagrid("options").queryParams;
			queryParams["bumenbianhao"] = $("#bumenbianhao").val();
			queryParams["bumenmingcheng"] = $("#bumenmingcheng").val();
			$("#bumen_manage").datagrid("options").queryParams=queryParams; 
			$("#bumen_manage").datagrid("load");
		},
		exportExcel: function() {
			$("#bumenQueryForm").form({
			    url: backURL + getVisitPath("Bumen") + "/outToExcel",
			});
			//提交表单
			$("#bumenQueryForm").submit();
		},
		remove : function () {
			var rows = $("#bumen_manage").datagrid("getSelections");
			if (rows.length > 0) {
				$.messager.confirm("确定操作", "您正在要删除所选的记录吗？", function (flag) {
					if (flag) {
						var bumenbianhaos = [];
						for (var i = 0; i < rows.length; i ++) {
							bumenbianhaos.push(rows[i].bumenbianhao);
						}
						$.ajax({
							type : "POST",
							url :  backURL + getVisitPath("Bumen") + "/deletes",
							data : {
								bumenbianhaos : bumenbianhaos.join(","),
							},
							dataType: "json",
							beforeSend : function () {
								$("#bumen_manage").datagrid("loading");
							},
							success : function (data) {
								if (data.success) {
									$("#bumen_manage").datagrid("loaded");
									$("#bumen_manage").datagrid("load");
									$("#bumen_manage").datagrid("unselectAll");
									$.messager.show({
										title : "提示",
										msg : data.message
									});
								} else {
									$("#bumen_manage").datagrid("loaded");
									$("#bumen_manage").datagrid("load");
									$("#bumen_manage").datagrid("unselectAll");
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
			var rows = $("#bumen_manage").datagrid("getSelections");
			if (rows.length > 1) {
				$.messager.alert("警告操作！", "编辑记录只能选定一条数据！", "warning");
			} else if (rows.length == 1) {
				$.ajax({
					url : backURL + getVisitPath("Bumen") + "/update",
					type : "get",
					data : {
						bumenbianhao : rows[0].bumenbianhao,
					},
					dataType: "json",
					beforeSend : function () {
						$.messager.progress({
							text : "正在获取中...",
						});
					},
					success : function (bumen, response, status) {
						$.messager.progress("close");
						if (bumen) { 
							$("#bumenEditDiv").dialog("open");
							$("#bumen_bumenbianhao_edit").val(bumen.bumenbianhao);
							$("#bumen_bumenbianhao_edit").validatebox({
								required : true,
								missingMessage : "请输入部门编号",
								editable: false
							});
							$("#bumen_bumenmingcheng_edit").val(bumen.bumenmingcheng);
							$("#bumen_bumenmingcheng_edit").validatebox({
								required : true,
								missingMessage : "请输入部门名称",
							});
							$("#bumen_addtime_edit").datetimebox({
								value: bumen.addtime,
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
