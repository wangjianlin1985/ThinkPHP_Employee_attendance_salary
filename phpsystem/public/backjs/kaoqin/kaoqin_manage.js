var kaoqin_manage_tool = null; 
$(function () { 
	initKaoqinManageTool(); //建立Kaoqin管理对象
	kaoqin_manage_tool.init(); //如果需要通过下拉框查询，首先初始化下拉框的值
	$("#kaoqin_manage").datagrid({
		url : backURL + getVisitPath("Kaoqin") + '/backList',
		fit : true,
		fitColumns : true,
		striped : true,
		rownumbers : true,
		border : false,
		pagination : true,
		pageSize : 5,
		pageList : [5, 10, 15, 20, 25],
		pageNumber : 1,
		sortName : "kaoqinId",
		sortOrder : "desc",
		toolbar : "#kaoqin_manage_tool",
		columns : [[
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
				field : "suoshubumen",
				title : "所属部门",
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
				field : "daoqintianshu",
				title : "到勤天数",
				width : 70,
			},
			{
				field : "chidaotianshu",
				title : "迟到天数",
				width : 70,
			},
			{
				field : "kuangdaotianshu",
				title : "旷工天数",
				width : 70,
			},
			{
				field : "qingjiatianshu",
				title : "请假天数",
				width : 70,
			},
			{
				field : "addtime",
				title : "添加时间",
				width : 140,
			},
		]],
	});

	$("#kaoqinEditDiv").dialog({
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
				if ($("#kaoqinEditForm").form("validate")) {
					//验证表单 
					if(!$("#kaoqinEditForm").form("validate")) {
						$.messager.alert("错误提示","你输入的信息还有错误！","warning");
					} else {
						$("#kaoqinEditForm").form({
						    url: backURL + getVisitPath("Kaoqin") + "/update",
						    onSubmit: function(){
								if($("#kaoqinEditForm").form("validate"))  {
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
			                        $("#kaoqinEditDiv").dialog("close");
			                        kaoqin_manage_tool.reload();
			                    }else{
			                        $.messager.alert("消息",obj.message);
			                    } 
						    }
						});
						//提交表单
						$("#kaoqinEditForm").submit();
					}
				}
			},
		},{
			text : "取消",
			iconCls : "icon-redo",
			handler : function () {
				$("#kaoqinEditDiv").dialog("close");
				$("#kaoqinEditForm").form("reset"); 
			},
		}],
	});
});

function initKaoqinManageTool() {
	kaoqin_manage_tool = {
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
					$("#suoshubumen_bumenbianhao_query").combobox({ 
					    valueField:"bumenbianhao",
					    textField:"bumenmingcheng",
					    panelHeight: "200px",
				        editable: false, //不允许手动输入 
					});
					data.splice(0,0,{bumenbianhao:"",bumenmingcheng:"不限制"});
					$("#suoshubumen_bumenbianhao_query").combobox("loadData",data); 
				}
			});
		},
		reload : function () {
			$("#kaoqin_manage").datagrid("reload");
		},
		redo : function () {
			$("#kaoqin_manage").datagrid("unselectAll");
		},
		search: function() {
			var queryParams = $("#kaoqin_manage").datagrid("options").queryParams;
			queryParams["xingming.bianhao"] = $("#xingming_bianhao_query").combobox("getValue");
			queryParams["suoshubumen.bumenbianhao"] = $("#suoshubumen_bumenbianhao_query").combobox("getValue");
			queryParams["nianfen"] = $("#nianfen").val();
			queryParams["yuefen"] = $("#yuefen").val();
			queryParams["addtime"] = $("#addtime").datebox("getValue"); 
			$("#kaoqin_manage").datagrid("options").queryParams=queryParams; 
			$("#kaoqin_manage").datagrid("load");
		},
		exportExcel: function() {
			$("#kaoqinQueryForm").form({
			    url: backURL + getVisitPath("Kaoqin") + "/outToExcel",
			});
			//提交表单
			$("#kaoqinQueryForm").submit();
		},
		remove : function () {
			var rows = $("#kaoqin_manage").datagrid("getSelections");
			if (rows.length > 0) {
				$.messager.confirm("确定操作", "您正在要删除所选的记录吗？", function (flag) {
					if (flag) {
						var kaoqinIds = [];
						for (var i = 0; i < rows.length; i ++) {
							kaoqinIds.push(rows[i].kaoqinId);
						}
						$.ajax({
							type : "POST",
							url :  backURL + getVisitPath("Kaoqin") + "/deletes",
							data : {
								kaoqinIds : kaoqinIds.join(","),
							},
							dataType: "json",
							beforeSend : function () {
								$("#kaoqin_manage").datagrid("loading");
							},
							success : function (data) {
								if (data.success) {
									$("#kaoqin_manage").datagrid("loaded");
									$("#kaoqin_manage").datagrid("load");
									$("#kaoqin_manage").datagrid("unselectAll");
									$.messager.show({
										title : "提示",
										msg : data.message
									});
								} else {
									$("#kaoqin_manage").datagrid("loaded");
									$("#kaoqin_manage").datagrid("load");
									$("#kaoqin_manage").datagrid("unselectAll");
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
			var rows = $("#kaoqin_manage").datagrid("getSelections");
			if (rows.length > 1) {
				$.messager.alert("警告操作！", "编辑记录只能选定一条数据！", "warning");
			} else if (rows.length == 1) {
				$.ajax({
					url : backURL + getVisitPath("Kaoqin") + "/update",
					type : "get",
					data : {
						kaoqinId : rows[0].kaoqinId,
					},
					dataType: "json",
					beforeSend : function () {
						$.messager.progress({
							text : "正在获取中...",
						});
					},
					success : function (kaoqin, response, status) {
						$.messager.progress("close");
						if (kaoqin) { 
							$("#kaoqinEditDiv").dialog("open");
							$("#kaoqin_kaoqinId_edit").val(kaoqin.kaoqinId);
							$("#kaoqin_kaoqinId_edit").validatebox({
								required : true,
								missingMessage : "请输入考勤id",
								editable: false
							});
							$("#kaoqin_xingming_bianhao_edit").combobox({
							    url: backURL + getVisitPath("Employee") + "/listAll",
							    dataType: "json",
							    valueField:"bianhao",
							    textField:"xingming",
							    panelHeight: "auto",
						        editable: false, //不允许手动输入 
						        onLoadSuccess: function () { //数据加载完毕事件
									$("#kaoqin_xingming_bianhao_edit").combobox("select", kaoqin.xingming);
									//var data = $("#kaoqin_xingming_bianhao_edit").combobox("getData"); 
						            //if (data.length > 0) {
						                //$("#kaoqin_xingming_bianhao_edit").combobox("select", data[0].bianhao);
						            //}
								}
							});
							$("#kaoqin_xingbie_edit").val(kaoqin.xingbie);
							$("#kaoqin_xingbie_edit").validatebox({
								required : true,
								missingMessage : "请输入性别",
							});
							$("#kaoqin_suoshubumen_bumenbianhao_edit").combobox({
							    url: backURL + getVisitPath("Bumen") + "/listAll",
							    dataType: "json",
							    valueField:"bumenbianhao",
							    textField:"bumenmingcheng",
							    panelHeight: "auto",
						        editable: false, //不允许手动输入 
						        onLoadSuccess: function () { //数据加载完毕事件
									$("#kaoqin_suoshubumen_bumenbianhao_edit").combobox("select", kaoqin.suoshubumen);
									//var data = $("#kaoqin_suoshubumen_bumenbianhao_edit").combobox("getData"); 
						            //if (data.length > 0) {
						                //$("#kaoqin_suoshubumen_bumenbianhao_edit").combobox("select", data[0].bumenbianhao);
						            //}
								}
							});
							$("#kaoqin_danrenzhiwu_edit").val(kaoqin.danrenzhiwu);
							$("#kaoqin_danrenzhiwu_edit").validatebox({
								required : true,
								missingMessage : "请输入担任职务",
							});
							$("#kaoqin_nianfen_edit").val(kaoqin.nianfen);
							$("#kaoqin_nianfen_edit").validatebox({
								required : true,
								missingMessage : "请输入年份",
							});
							$("#kaoqin_yuefen_edit").val(kaoqin.yuefen);
							$("#kaoqin_yuefen_edit").validatebox({
								required : true,
								missingMessage : "请输入月份",
							});
							$("#kaoqin_daoqintianshu_edit").val(kaoqin.daoqintianshu);
							$("#kaoqin_daoqintianshu_edit").validatebox({
								required : true,
								validType : "number",
								missingMessage : "请输入到勤天数",
								invalidMessage : "到勤天数输入不对",
							});
							$("#kaoqin_chidaotianshu_edit").val(kaoqin.chidaotianshu);
							$("#kaoqin_chidaotianshu_edit").validatebox({
								required : true,
								validType : "number",
								missingMessage : "请输入迟到天数",
								invalidMessage : "迟到天数输入不对",
							});
							$("#kaoqin_kuangdaotianshu_edit").val(kaoqin.kuangdaotianshu);
							$("#kaoqin_kuangdaotianshu_edit").validatebox({
								required : true,
								validType : "number",
								missingMessage : "请输入旷工天数",
								invalidMessage : "旷工天数输入不对",
							});
							$("#kaoqin_qingjiatianshu_edit").val(kaoqin.qingjiatianshu);
							$("#kaoqin_qingjiatianshu_edit").validatebox({
								required : true,
								validType : "number",
								missingMessage : "请输入请假天数",
								invalidMessage : "请假天数输入不对",
							});
							$("#kaoqin_beizhu_edit").val(kaoqin.beizhu);
							$("#kaoqin_addtime_edit").datetimebox({
								value: kaoqin.addtime,
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
