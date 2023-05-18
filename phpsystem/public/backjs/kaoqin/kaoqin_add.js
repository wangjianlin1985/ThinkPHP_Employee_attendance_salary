$(function () {
	$("#kaoqin_xingming_bianhao").combobox({
	    url: backURL + getVisitPath("Employee") + '/listAll',
	    valueField: "bianhao",
	    textField: "xingming",
	    panelHeight: "auto",
        editable: false, //不允许手动输入
        required : true,
        onLoadSuccess: function () { //数据加载完毕事件
            var data = $("#kaoqin_xingming_bianhao").combobox("getData"); 
            if (data.length > 0) {
                $("#kaoqin_xingming_bianhao").combobox("select", data[0].bianhao);
            }
        }
	});
	$("#kaoqin_xingbie").validatebox({
		required : true, 
		missingMessage : '请输入性别',
	});

	$("#kaoqin_suoshubumen_bumenbianhao").combobox({
	    url: backURL + getVisitPath("Bumen") + '/listAll',
	    valueField: "bumenbianhao",
	    textField: "bumenmingcheng",
	    panelHeight: "auto",
        editable: false, //不允许手动输入
        required : true,
        onLoadSuccess: function () { //数据加载完毕事件
            var data = $("#kaoqin_suoshubumen_bumenbianhao").combobox("getData"); 
            if (data.length > 0) {
                $("#kaoqin_suoshubumen_bumenbianhao").combobox("select", data[0].bumenbianhao);
            }
        }
	});
	$("#kaoqin_danrenzhiwu").validatebox({
		required : true, 
		missingMessage : '请输入担任职务',
	});

	$("#kaoqin_nianfen").validatebox({
		required : true, 
		missingMessage : '请输入年份',
	});

	$("#kaoqin_yuefen").validatebox({
		required : true, 
		missingMessage : '请输入月份',
	});

	$("#kaoqin_daoqintianshu").validatebox({
		required : true,
		validType : "number",
		missingMessage : '请输入到勤天数',
		invalidMessage : '到勤天数输入不对',
	});

	$("#kaoqin_chidaotianshu").validatebox({
		required : true,
		validType : "number",
		missingMessage : '请输入迟到天数',
		invalidMessage : '迟到天数输入不对',
	});

	$("#kaoqin_kuangdaotianshu").validatebox({
		required : true,
		validType : "number",
		missingMessage : '请输入旷工天数',
		invalidMessage : '旷工天数输入不对',
	});

	$("#kaoqin_qingjiatianshu").validatebox({
		required : true,
		validType : "number",
		missingMessage : '请输入请假天数',
		invalidMessage : '请假天数输入不对',
	});

	$("#kaoqin_addtime").datetimebox({
	    required : true, 
	    showSeconds: true,
	    editable: false
	});

	//单击添加按钮
	$("#kaoqinAddButton").click(function () {
		//验证表单 
		if(!$("#kaoqinAddForm").form("validate")) {
			$.messager.alert("错误提示","你输入的信息还有错误！","warning");
			$(".messager-window").css("z-index",10000);
		} else {
			$("#kaoqinAddForm").form({
			    url: backURL + getVisitPath("Kaoqin") + "/add",
			    onSubmit: function(){
					if($("#kaoqinAddForm").form("validate"))  { 
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
                        $("#kaoqinAddForm").form("clear");
                    }else{
                        $.messager.alert("消息",obj.message);
                        $(".messager-window").css("z-index",10000);
                    }
			    }
			});
			//提交表单
			$("#kaoqinAddForm").submit();
		}
	});

	//单击清空按钮
	$("#kaoqinClearButton").click(function () { 
		$("#kaoqinAddForm").form("clear"); 
	});
});
