$(function () {
	$.ajax({
		url :  backURL + getVisitPath("Peixun") + "/update",
		type : "get",
		data : {
			peixunId : $("#peixun_peixunId_edit").val(),
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
				$(".messager-window").css("z-index",10000);
			}
		}
	});

	$("#peixunModifyButton").click(function(){ 
		if ($("#peixunEditForm").form("validate")) {
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
			$("#peixunEditForm").submit();
		} else {
			$.messager.alert("错误提示","你输入的信息还有错误！","warning");
			$(".messager-window").css("z-index",10000);
		}
	});
});
