$(function () {
	$.ajax({
		url :  backURL + getVisitPath("Bumen") + "/update",
		type : "get",
		data : {
			bumenbianhao : $("#bumen_bumenbianhao_edit").val(),
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
				$(".messager-window").css("z-index",10000);
			}
		}
	});

	$("#bumenModifyButton").click(function(){ 
		if ($("#bumenEditForm").form("validate")) {
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
			$("#bumenEditForm").submit();
		} else {
			$.messager.alert("错误提示","你输入的信息还有错误！","warning");
			$(".messager-window").css("z-index",10000);
		}
	});
});
