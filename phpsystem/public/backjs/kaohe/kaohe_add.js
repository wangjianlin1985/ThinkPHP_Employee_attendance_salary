$(function () {
	$("#kaohe_xingming_bianhao").combobox({
	    url: backURL + getVisitPath("Employee") + '/listAll',
	    valueField: "bianhao",
	    textField: "xingming",
	    panelHeight: "auto",
        editable: false, //不允许手动输入
        required : true,
        onLoadSuccess: function () { //数据加载完毕事件
            var data = $("#kaohe_xingming_bianhao").combobox("getData"); 
            if (data.length > 0) {
                $("#kaohe_xingming_bianhao").combobox("select", data[0].bianhao);
            }
        }
	});
	$("#kaohe_bumenObj_bumenbianhao").combobox({
	    url: backURL + getVisitPath("Bumen") + '/listAll',
	    valueField: "bumenbianhao",
	    textField: "bumenmingcheng",
	    panelHeight: "auto",
        editable: false, //不允许手动输入
        required : true,
        onLoadSuccess: function () { //数据加载完毕事件
            var data = $("#kaohe_bumenObj_bumenbianhao").combobox("getData"); 
            if (data.length > 0) {
                $("#kaohe_bumenObj_bumenbianhao").combobox("select", data[0].bumenbianhao);
            }
        }
	});
	$("#kaohe_zhiwu").validatebox({
		required : true, 
		missingMessage : '请输入职务',
	});

	$("#kaohe_nianfen").validatebox({
		required : true, 
		missingMessage : '请输入年份',
	});

	$("#kaohe_yuefen").validatebox({
		required : true, 
		missingMessage : '请输入月份',
	});

	$("#kaohe_kaohejieguo").validatebox({
		required : true, 
		missingMessage : '请输入考核结果',
	});

	$("#kaohe_kaohejiangli").validatebox({
		required : true, 
		missingMessage : '请输入考核奖励',
	});

	$("#kaohe_kaohebumen_bumenbianhao").combobox({
	    url: backURL + getVisitPath("Bumen") + '/listAll',
	    valueField: "bumenbianhao",
	    textField: "bumenmingcheng",
	    panelHeight: "auto",
        editable: false, //不允许手动输入
        required : true,
        onLoadSuccess: function () { //数据加载完毕事件
            var data = $("#kaohe_kaohebumen_bumenbianhao").combobox("getData"); 
            if (data.length > 0) {
                $("#kaohe_kaohebumen_bumenbianhao").combobox("select", data[0].bumenbianhao);
            }
        }
	});
	$("#kaohe_kaoheren").validatebox({
		required : true, 
		missingMessage : '请输入考核人',
	});

	$("#kaohe_kaoheneirong").validatebox({
		required : true, 
		missingMessage : '请输入考核内容',
	});

	$("#kaohe_addtime").datetimebox({
	    required : true, 
	    showSeconds: true,
	    editable: false
	});

	//单击添加按钮
	$("#kaoheAddButton").click(function () {
		//验证表单 
		if(!$("#kaoheAddForm").form("validate")) {
			$.messager.alert("错误提示","你输入的信息还有错误！","warning");
			$(".messager-window").css("z-index",10000);
		} else {
			$("#kaoheAddForm").form({
			    url: backURL + getVisitPath("Kaohe") + "/add",
			    onSubmit: function(){
					if($("#kaoheAddForm").form("validate"))  { 
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
                        $("#kaoheAddForm").form("clear");
                    }else{
                        $.messager.alert("消息",obj.message);
                        $(".messager-window").css("z-index",10000);
                    }
			    }
			});
			//提交表单
			$("#kaoheAddForm").submit();
		}
	});

	//单击清空按钮
	$("#kaoheClearButton").click(function () { 
		$("#kaoheAddForm").form("clear"); 
	});
});
