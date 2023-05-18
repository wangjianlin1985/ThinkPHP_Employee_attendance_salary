$(function () {
	$("#bumen_bumenbianhao").validatebox({
		required : true, 
		missingMessage : '请输入部门编号',
	});

	$("#bumen_bumenmingcheng").validatebox({
		required : true, 
		missingMessage : '请输入部门名称',
	});

	$("#bumen_addtime").datetimebox({
	    required : true, 
	    showSeconds: true,
	    editable: false
	});

	//单击添加按钮
	$("#bumenAddButton").click(function () {
		//验证表单 
		if(!$("#bumenAddForm").form("validate")) {
			$.messager.alert("错误提示","你输入的信息还有错误！","warning");
			$(".messager-window").css("z-index",10000);
		} else {
			$("#bumenAddForm").form({
			    url: backURL + getVisitPath("Bumen") + "/add",
			    onSubmit: function(){
					if($("#bumenAddForm").form("validate"))  { 
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
                        $("#bumenAddForm").form("clear");
                    }else{
                        $.messager.alert("消息",obj.message);
                        $(".messager-window").css("z-index",10000);
                    }
			    }
			});
			//提交表单
			$("#bumenAddForm").submit();
		}
	});

	//单击清空按钮
	$("#bumenClearButton").click(function () { 
		$("#bumenAddForm").form("clear"); 
	});
});
