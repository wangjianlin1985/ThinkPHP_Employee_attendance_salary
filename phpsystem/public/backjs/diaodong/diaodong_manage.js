var diaodong_manage_tool = null; 
$(function () { 
	initDiaodongManageTool(); //建立Diaodong管理对象
	diaodong_manage_tool.init(); //如果需要通过下拉框查询，首先初始化下拉框的值
	$("#diaodong_manage").datagrid({
		url : backURL + getVisitPath("Diaodong") + '/backList',
		fit : true,
		fitColumns : true,
		striped : true,
		rownumbers : true,
		border : false,
		pagination : true,
		pageSize : 5,
		pageList : [5, 10, 15, 20, 25],
		pageNumber : 1,
		sortName : "id",
		sortOrder : "desc",
		toolbar : "#diaodong_manage_tool",
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
				field : "yuanjibengongzi",
				title : "原基本工资",
				width : 70,
			},
			{
				field : "diaodongzhiwei",
				title : "调动职位",
				width : 140,
			},
			{
				field : "diaodongbumen",
				title : "调动部门",
				width : 140,
			},
			{
				field : "diaodongriqi",
				title : "调动日期",
				width : 140,
			},
			{
				field : "xianjibengongzi",
				title : "现基本工资",
				width : 70,
			},
			{
				field : "diaodongyuanyin",
				title : "调动原因",
				width : 140,
			},
			{
				field : "addtime",
				title : "添加时间",
				width : 140,
			},
		]],
	});

	$("#diaodongEditDiv").dialog({
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
				if ($("#diaodongEditForm").form("validate")) {
					//验证表单 
					if(!$("#diaodongEditForm").form("validate")) {
						$.messager.alert("错误提示","你输入的信息还有错误！","warning");
					} else {
						$("#diaodongEditForm").form({
						    url: backURL + getVisitPath("Diaodong") + "/update",
						    onSubmit: function(){
								if($("#diaodongEditForm").form("validate"))  {
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
			                        $("#diaodongEditDiv").dialog("close");
			                        diaodong_manage_tool.reload();
			                    }else{
			                        $.messager.alert("消息",obj.message);
			                    } 
						    }
						});
						//提交表单
						$("#diaodongEditForm").submit();
					}
				}
			},
		},{
			text : "取消",
			iconCls : "icon-redo",
			handler : function () {
				$("#diaodongEditDiv").dialog("close");
				$("#diaodongEditForm").form("reset"); 
			},
		}],
	});
});

function initDiaodongManageTool() {
	diaodong_manage_tool = {
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
			$.ajax({
				url : backURL + getVisitPath("Bumen") + "/listAll",
				type : "post",
				dataType: "json",
				success : function (data, response, status) {
					$("#diaodongbumen_bumenbianhao_query").combobox({ 
					    valueField:"bumenbianhao",
					    textField:"bumenmingcheng",
					    panelHeight: "200px",
				        editable: false, //不允许手动输入 
					});
					data.splice(0,0,{bumenbianhao:"",bumenmingcheng:"不限制"});
					$("#diaodongbumen_bumenbianhao_query").combobox("loadData",data); 
				}
			});
		},
		reload : function () {
			$("#diaodong_manage").datagrid("reload");
		},
		redo : function () {
			$("#diaodong_manage").datagrid("unselectAll");
		},
		search: function() {
			var queryParams = $("#diaodong_manage").datagrid("options").queryParams;
			queryParams["xingming.bianhao"] = $("#xingming_bianhao_query").combobox("getValue");
			queryParams["diaodongriqi"] = $("#diaodongriqi").datebox("getValue"); 
			queryParams["diaodongyuanyin"] = $("#diaodongyuanyin").val();
			queryParams["addtime"] = $("#addtime").datebox("getValue"); 
			$("#diaodong_manage").datagrid("options").queryParams=queryParams; 
			$("#diaodong_manage").datagrid("load");
		},
		exportExcel: function() {
			$("#diaodongQueryForm").form({
			    url: backURL + getVisitPath("Diaodong") + "/outToExcel",
			});
			//提交表单
			$("#diaodongQueryForm").submit();
		},
		remove : function () {
			var rows = $("#diaodong_manage").datagrid("getSelections");
			if (rows.length > 0) {
				$.messager.confirm("确定操作", "您正在要删除所选的记录吗？", function (flag) {
					if (flag) {
						var ids = [];
						for (var i = 0; i < rows.length; i ++) {
							ids.push(rows[i].id);
						}
						$.ajax({
							type : "POST",
							url :  backURL + getVisitPath("Diaodong") + "/deletes",
							data : {
								ids : ids.join(","),
							},
							dataType: "json",
							beforeSend : function () {
								$("#diaodong_manage").datagrid("loading");
							},
							success : function (data) {
								if (data.success) {
									$("#diaodong_manage").datagrid("loaded");
									$("#diaodong_manage").datagrid("load");
									$("#diaodong_manage").datagrid("unselectAll");
									$.messager.show({
										title : "提示",
										msg : data.message
									});
								} else {
									$("#diaodong_manage").datagrid("loaded");
									$("#diaodong_manage").datagrid("load");
									$("#diaodong_manage").datagrid("unselectAll");
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
			var rows = $("#diaodong_manage").datagrid("getSelections");
			if (rows.length > 1) {
				$.messager.alert("警告操作！", "编辑记录只能选定一条数据！", "warning");
			} else if (rows.length == 1) {
				$.ajax({
					url : backURL + getVisitPath("Diaodong") + "/update",
					type : "get",
					data : {
						id : rows[0].id,
					},
					dataType: "json",
					beforeSend : function () {
						$.messager.progress({
							text : "正在获取中...",
						});
					},
					success : function (diaodong, response, status) {
						$.messager.progress("close");
						if (diaodong) { 
							$("#diaodongEditDiv").dialog("open");
							$("#diaodong_id_edit").val(diaodong.id);
							$("#diaodong_id_edit").validatebox({
								required : true,
								missingMessage : "请输入调动id",
								editable: false
							});
							$("#diaodong_xingming_bianhao_edit").combobox({
							    url: backURL + getVisitPath("Employee") + "/listAll",
							    dataType: "json",
							    valueField:"bianhao",
							    textField:"xingming",
							    panelHeight: "auto",
						        editable: false, //不允许手动输入 
						        onLoadSuccess: function () { //数据加载完毕事件
									$("#diaodong_xingming_bianhao_edit").combobox("select", diaodong.xingming);
									//var data = $("#diaodong_xingming_bianhao_edit").combobox("getData"); 
						            //if (data.length > 0) {
						                //$("#diaodong_xingming_bianhao_edit").combobox("select", data[0].bianhao);
						            //}
								}
							});
							$("#diaodong_bumenmingcheng_bumenbianhao_edit").combobox({
							    url: backURL + getVisitPath("Bumen") + "/listAll",
							    dataType: "json",
							    valueField:"bumenbianhao",
							    textField:"bumenmingcheng",
							    panelHeight: "auto",
						        editable: false, //不允许手动输入 
						        onLoadSuccess: function () { //数据加载完毕事件
									$("#diaodong_bumenmingcheng_bumenbianhao_edit").combobox("select", diaodong.bumenmingcheng);
									//var data = $("#diaodong_bumenmingcheng_bumenbianhao_edit").combobox("getData"); 
						            //if (data.length > 0) {
						                //$("#diaodong_bumenmingcheng_bumenbianhao_edit").combobox("select", data[0].bumenbianhao);
						            //}
								}
							});
							$("#diaodong_danrenzhiwu_edit").val(diaodong.danrenzhiwu);
							$("#diaodong_danrenzhiwu_edit").validatebox({
								required : true,
								missingMessage : "请输入担任职务",
							});
							$("#diaodong_yuanjibengongzi_edit").val(diaodong.yuanjibengongzi);
							$("#diaodong_yuanjibengongzi_edit").validatebox({
								required : true,
								validType : "number",
								missingMessage : "请输入原基本工资",
								invalidMessage : "原基本工资输入不对",
							});
							$("#diaodong_diaodongzhiwei_edit").val(diaodong.diaodongzhiwei);
							$("#diaodong_diaodongzhiwei_edit").validatebox({
								required : true,
								missingMessage : "请输入调动职位",
							});
							$("#diaodong_diaodongbumen_bumenbianhao_edit").combobox({
							    url: backURL + getVisitPath("Bumen") + "/listAll",
							    dataType: "json",
							    valueField:"bumenbianhao",
							    textField:"bumenmingcheng",
							    panelHeight: "auto",
						        editable: false, //不允许手动输入 
						        onLoadSuccess: function () { //数据加载完毕事件
									$("#diaodong_diaodongbumen_bumenbianhao_edit").combobox("select", diaodong.diaodongbumen);
									//var data = $("#diaodong_diaodongbumen_bumenbianhao_edit").combobox("getData"); 
						            //if (data.length > 0) {
						                //$("#diaodong_diaodongbumen_bumenbianhao_edit").combobox("select", data[0].bumenbianhao);
						            //}
								}
							});
							$("#diaodong_diaodongriqi_edit").datebox({
								value: diaodong.diaodongriqi,
							    required: true,
							    showSeconds: true,
							});
							$("#diaodong_xianjibengongzi_edit").val(diaodong.xianjibengongzi);
							$("#diaodong_xianjibengongzi_edit").validatebox({
								required : true,
								validType : "number",
								missingMessage : "请输入现基本工资",
								invalidMessage : "现基本工资输入不对",
							});
							$("#diaodong_diaodongyuanyin_edit").val(diaodong.diaodongyuanyin);
							$("#diaodong_diaodongyuanyin_edit").validatebox({
								required : true,
								missingMessage : "请输入调动原因",
							});
							$("#diaodong_addtime_edit").datetimebox({
								value: diaodong.addtime,
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
