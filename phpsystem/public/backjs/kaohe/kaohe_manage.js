var kaohe_manage_tool = null; 
$(function () { 
	initKaoheManageTool(); //建立Kaohe管理对象
	kaohe_manage_tool.init(); //如果需要通过下拉框查询，首先初始化下拉框的值
	$("#kaohe_manage").datagrid({
		url : backURL + getVisitPath("Kaohe") + '/backList',
		fit : true,
		fitColumns : true,
		striped : true,
		rownumbers : true,
		border : false,
		pagination : true,
		pageSize : 5,
		pageList : [5, 10, 15, 20, 25],
		pageNumber : 1,
		sortName : "kaoheId",
		sortOrder : "desc",
		toolbar : "#kaohe_manage_tool",
		columns : [[
			{
				field : "xingming",
				title : "姓名",
				width : 140,
			},
			{
				field : "bumenObj",
				title : "部门",
				width : 140,
			},
			{
				field : "zhiwu",
				title : "职务",
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
				field : "kaohejieguo",
				title : "考核结果",
				width : 140,
			},
			{
				field : "kaohebumen",
				title : "考核部门",
				width : 140,
			},
			{
				field : "addtime",
				title : "添加时间",
				width : 140,
			},
		]],
	});

	$("#kaoheEditDiv").dialog({
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
				if ($("#kaoheEditForm").form("validate")) {
					//验证表单 
					if(!$("#kaoheEditForm").form("validate")) {
						$.messager.alert("错误提示","你输入的信息还有错误！","warning");
					} else {
						$("#kaoheEditForm").form({
						    url: backURL + getVisitPath("Kaohe") + "/update",
						    onSubmit: function(){
								if($("#kaoheEditForm").form("validate"))  {
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
			                        $("#kaoheEditDiv").dialog("close");
			                        kaohe_manage_tool.reload();
			                    }else{
			                        $.messager.alert("消息",obj.message);
			                    } 
						    }
						});
						//提交表单
						$("#kaoheEditForm").submit();
					}
				}
			},
		},{
			text : "取消",
			iconCls : "icon-redo",
			handler : function () {
				$("#kaoheEditDiv").dialog("close");
				$("#kaoheEditForm").form("reset"); 
			},
		}],
	});
});

function initKaoheManageTool() {
	kaohe_manage_tool = {
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
			$.ajax({
				url : backURL + getVisitPath("Bumen") + "/listAll",
				type : "post",
				dataType: "json",
				success : function (data, response, status) {
					$("#kaohebumen_bumenbianhao_query").combobox({ 
					    valueField:"bumenbianhao",
					    textField:"bumenmingcheng",
					    panelHeight: "200px",
				        editable: false, //不允许手动输入 
					});
					data.splice(0,0,{bumenbianhao:"",bumenmingcheng:"不限制"});
					$("#kaohebumen_bumenbianhao_query").combobox("loadData",data); 
				}
			});
		},
		reload : function () {
			$("#kaohe_manage").datagrid("reload");
		},
		redo : function () {
			$("#kaohe_manage").datagrid("unselectAll");
		},
		search: function() {
			var queryParams = $("#kaohe_manage").datagrid("options").queryParams;
			queryParams["xingming.bianhao"] = $("#xingming_bianhao_query").combobox("getValue");
			queryParams["bumenObj.bumenbianhao"] = $("#bumenObj_bumenbianhao_query").combobox("getValue");
			queryParams["yuefen"] = $("#yuefen").val();
			$("#kaohe_manage").datagrid("options").queryParams=queryParams; 
			$("#kaohe_manage").datagrid("load");
		},
		exportExcel: function() {
			$("#kaoheQueryForm").form({
			    url: backURL + getVisitPath("Kaohe") + "/outToExcel",
			});
			//提交表单
			$("#kaoheQueryForm").submit();
		},
		remove : function () {
			var rows = $("#kaohe_manage").datagrid("getSelections");
			if (rows.length > 0) {
				$.messager.confirm("确定操作", "您正在要删除所选的记录吗？", function (flag) {
					if (flag) {
						var kaoheIds = [];
						for (var i = 0; i < rows.length; i ++) {
							kaoheIds.push(rows[i].kaoheId);
						}
						$.ajax({
							type : "POST",
							url :  backURL + getVisitPath("Kaohe") + "/deletes",
							data : {
								kaoheIds : kaoheIds.join(","),
							},
							dataType: "json",
							beforeSend : function () {
								$("#kaohe_manage").datagrid("loading");
							},
							success : function (data) {
								if (data.success) {
									$("#kaohe_manage").datagrid("loaded");
									$("#kaohe_manage").datagrid("load");
									$("#kaohe_manage").datagrid("unselectAll");
									$.messager.show({
										title : "提示",
										msg : data.message
									});
								} else {
									$("#kaohe_manage").datagrid("loaded");
									$("#kaohe_manage").datagrid("load");
									$("#kaohe_manage").datagrid("unselectAll");
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
			var rows = $("#kaohe_manage").datagrid("getSelections");
			if (rows.length > 1) {
				$.messager.alert("警告操作！", "编辑记录只能选定一条数据！", "warning");
			} else if (rows.length == 1) {
				$.ajax({
					url : backURL + getVisitPath("Kaohe") + "/update",
					type : "get",
					data : {
						kaoheId : rows[0].kaoheId,
					},
					dataType: "json",
					beforeSend : function () {
						$.messager.progress({
							text : "正在获取中...",
						});
					},
					success : function (kaohe, response, status) {
						$.messager.progress("close");
						if (kaohe) { 
							$("#kaoheEditDiv").dialog("open");
							$("#kaohe_kaoheId_edit").val(kaohe.kaoheId);
							$("#kaohe_kaoheId_edit").validatebox({
								required : true,
								missingMessage : "请输入考核id",
								editable: false
							});
							$("#kaohe_xingming_bianhao_edit").combobox({
							    url: backURL + getVisitPath("Employee") + "/listAll",
							    dataType: "json",
							    valueField:"bianhao",
							    textField:"xingming",
							    panelHeight: "auto",
						        editable: false, //不允许手动输入 
						        onLoadSuccess: function () { //数据加载完毕事件
									$("#kaohe_xingming_bianhao_edit").combobox("select", kaohe.xingming);
									//var data = $("#kaohe_xingming_bianhao_edit").combobox("getData"); 
						            //if (data.length > 0) {
						                //$("#kaohe_xingming_bianhao_edit").combobox("select", data[0].bianhao);
						            //}
								}
							});
							$("#kaohe_bumenObj_bumenbianhao_edit").combobox({
							    url: backURL + getVisitPath("Bumen") + "/listAll",
							    dataType: "json",
							    valueField:"bumenbianhao",
							    textField:"bumenmingcheng",
							    panelHeight: "auto",
						        editable: false, //不允许手动输入 
						        onLoadSuccess: function () { //数据加载完毕事件
									$("#kaohe_bumenObj_bumenbianhao_edit").combobox("select", kaohe.bumenObj);
									//var data = $("#kaohe_bumenObj_bumenbianhao_edit").combobox("getData"); 
						            //if (data.length > 0) {
						                //$("#kaohe_bumenObj_bumenbianhao_edit").combobox("select", data[0].bumenbianhao);
						            //}
								}
							});
							$("#kaohe_zhiwu_edit").val(kaohe.zhiwu);
							$("#kaohe_zhiwu_edit").validatebox({
								required : true,
								missingMessage : "请输入职务",
							});
							$("#kaohe_nianfen_edit").val(kaohe.nianfen);
							$("#kaohe_nianfen_edit").validatebox({
								required : true,
								missingMessage : "请输入年份",
							});
							$("#kaohe_yuefen_edit").val(kaohe.yuefen);
							$("#kaohe_yuefen_edit").validatebox({
								required : true,
								missingMessage : "请输入月份",
							});
							$("#kaohe_kaohejieguo_edit").val(kaohe.kaohejieguo);
							$("#kaohe_kaohejieguo_edit").validatebox({
								required : true,
								missingMessage : "请输入考核结果",
							});
							$("#kaohe_kaohejiangli_edit").val(kaohe.kaohejiangli);
							$("#kaohe_kaohejiangli_edit").validatebox({
								required : true,
								missingMessage : "请输入考核奖励",
							});
							$("#kaohe_kaohebumen_bumenbianhao_edit").combobox({
							    url: backURL + getVisitPath("Bumen") + "/listAll",
							    dataType: "json",
							    valueField:"bumenbianhao",
							    textField:"bumenmingcheng",
							    panelHeight: "auto",
						        editable: false, //不允许手动输入 
						        onLoadSuccess: function () { //数据加载完毕事件
									$("#kaohe_kaohebumen_bumenbianhao_edit").combobox("select", kaohe.kaohebumen);
									//var data = $("#kaohe_kaohebumen_bumenbianhao_edit").combobox("getData"); 
						            //if (data.length > 0) {
						                //$("#kaohe_kaohebumen_bumenbianhao_edit").combobox("select", data[0].bumenbianhao);
						            //}
								}
							});
							$("#kaohe_kaoheren_edit").val(kaohe.kaoheren);
							$("#kaohe_kaoheren_edit").validatebox({
								required : true,
								missingMessage : "请输入考核人",
							});
							$("#kaohe_kaoheneirong_edit").val(kaohe.kaoheneirong);
							$("#kaohe_kaoheneirong_edit").validatebox({
								required : true,
								missingMessage : "请输入考核内容",
							});
							$("#kaohe_addtime_edit").datetimebox({
								value: kaohe.addtime,
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
