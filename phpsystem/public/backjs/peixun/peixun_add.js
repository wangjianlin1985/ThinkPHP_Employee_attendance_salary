$(function () {
	$("#peixun_mingcheng").validatebox({
		required : true, 
		missingMessage : '请输入培训名称',
	});

	$("#peixun_shijian").datebox({
	    required : true, 
	    showSeconds: true,
	    editable: false
	});

	$("#peixun_qingdan").validatebox({
		required : true, 
		missingMessage : '请输入培训清单',
	});

	$("#peixun_didian").validatebox({
		required : true, 
		missingMessage : '请输入培训地点',
	});

	$("#peixun_addtime").datetimebox({
	    required : true, 
	    showSeconds: true,
	    editable: false
	});

	//单击添加按钮
	$("#peixunAddButton").click(function () {
		//验证表单 
		if(!$("#peixunAddForm").form("validate")) {
			$.messager.alert("错误提示","你输入的信息还有错误！","warning");
			$(".messager-window").css("z-index",10000);
		} else {
			$("#peixunAddForm").form({
			    url: backURL + getVisitPath("Peixun") + "/add",
			    onSubmit: function(){
					if($("#peixunAddForm").form("validate"))  { 
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
                    //此处data={"Success":true}是字符串
                	var obj = jQuery.parseJSON(data); 
                    if(obj.success){ 
                        $.messager.alert("消息","保存成功！");
                        $(".messager-window").css("z-index",10000);
                        $("#peixunAddForm").form("clear");
                    }else{
                        $.messager.alert("消息",obj.message);
                        $(".messager-window").css("z-index",10000);
                    }
			    }
			});
			//提交表单
			$("#peixunAddForm").submit();
		}
	});

	//单击清空按钮
	$("#peixunClearButton").click(function () { 
		$("#peixunAddForm").form("clear"); 
	});
});
