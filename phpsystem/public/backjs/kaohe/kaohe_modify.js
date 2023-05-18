$(function () {
	$.ajax({
		url :  backURL + getVisitPath("Kaohe") + "/update",
		type : "get",
		data : {
			kaoheId : $("#kaohe_kaoheId_edit").val(),
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
				$("#kaohe_kaoheId_edit").val(kaohe.kaoheId);
				$("#kaohe_kaoheId_edit").validatebox({
					required : true,
					missingMessage : "请输入考核id",
					editable: false
				});
				$("#kaohe_xingming_bianhao_edit").combobox({
					url: backURL + getVisitPath("Employee") + "/listAll",
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
				$(".messager-window").css("z-index",10000);
			}
		}
	});

	$("#kaoheModifyButton").click(function(){ 
		if ($("#kaoheEditForm").form("validate")) {
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
                	var obj = jQuery.parseJSON(data);
                    if(obj.success){
                        $.messager.alert("消息","信息修改成功！");
                        $(".messager-window").css("z-index",10000);
                        //location.href="frontlist";
                    }else{
                        $.messager.alert("消息",obj.message);
                        $(".messager-window").css("z-index",10000);
                    } 
			    }
			});
			//提交表单
			$("#kaoheEditForm").submit();
		} else {
			$.messager.alert("错误提示","你输入的信息还有错误！","warning");
			$(".messager-window").css("z-index",10000);
		}
	});
});
