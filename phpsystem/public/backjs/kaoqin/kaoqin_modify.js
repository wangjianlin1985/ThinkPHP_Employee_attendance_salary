$(function () {
	$.ajax({
		url :  backURL + getVisitPath("Kaoqin") + "/update",
		type : "get",
		data : {
			kaoqinId : $("#kaoqin_kaoqinId_edit").val(),
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
				$("#kaoqin_kaoqinId_edit").val(kaoqin.kaoqinId);
				$("#kaoqin_kaoqinId_edit").validatebox({
					required : true,
					missingMessage : "请输入考勤id",
					editable: false
				});
				$("#kaoqin_xingming_bianhao_edit").combobox({
					url: backURL + getVisitPath("Employee") + "/listAll",
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
				$(".messager-window").css("z-index",10000);
			}
		}
	});

	$("#kaoqinModifyButton").click(function(){ 
		if ($("#kaoqinEditForm").form("validate")) {
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
			$("#kaoqinEditForm").submit();
		} else {
			$.messager.alert("错误提示","你输入的信息还有错误！","warning");
			$(".messager-window").css("z-index",10000);
		}
	});
});
