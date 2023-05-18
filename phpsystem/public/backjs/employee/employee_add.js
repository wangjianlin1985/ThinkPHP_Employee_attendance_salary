$(function () {
	$("#employee_bianhao").validatebox({
		required : true, 
		missingMessage : '请输入员工编号',
	});

	$("#employee_mima").validatebox({
		required : true, 
		missingMessage : '请输入密码',
	});

	$("#employee_xingming").validatebox({
		required : true, 
		missingMessage : '请输入姓名',
	});

	$("#employee_xingbie").validatebox({
		required : true, 
		missingMessage : '请输入性别',
	});

	$("#employee_bumenObj_bumenbianhao").combobox({
	    url: backURL + getVisitPath("Bumen") + '/listAll',
	    valueField: "bumenbianhao",
	    textField: "bumenmingcheng",
	    panelHeight: "auto",
        editable: false, //不允许手动输入
        required : true,
        onLoadSuccess: function () { //数据加载完毕事件
            var data = $("#employee_bumenObj_bumenbianhao").combobox("getData"); 
            if (data.length > 0) {
                $("#employee_bumenObj_bumenbianhao").combobox("select", data[0].bumenbianhao);
            }
        }
	});
	$("#employee_danrenzhiwu").validatebox({
		required : true, 
		missingMessage : '请输入担任职务',
	});

	$("#employee_minzu").validatebox({
		required : true, 
		missingMessage : '请输入民族',
	});

	$("#employee_chushengriqi").datebox({
	    required : true, 
	    showSeconds: true,
	    editable: false
	});

	$("#employee_shenfenzhenghao").validatebox({
		required : true, 
		missingMessage : '请输入身份证号',
	});

	$("#employee_jiguan").validatebox({
		required : true, 
		missingMessage : '请输入籍贯',
	});

	$("#employee_wenhuachengdu").validatebox({
		required : true, 
		missingMessage : '请输入文化程度',
	});

	$("#employee_zhengzhimianmao").validatebox({
		required : true, 
		missingMessage : '请输入政治面貌',
	});

	$("#employee_hunyinqingkuang").validatebox({
		required : true, 
		missingMessage : '请输入婚姻状况',
	});

	$("#employee_biyeyuanxiao").validatebox({
		required : true, 
		missingMessage : '请输入毕业院校',
	});

	$("#employee_zhuanye").validatebox({
		required : true, 
		missingMessage : '请输入专业',
	});

	$("#employee_biyeshijian").datebox({
	    required : true, 
	    showSeconds: true,
	    editable: false
	});

	$("#employee_shoujihao").validatebox({
		required : true, 
		missingMessage : '请输入手机号',
	});

	$("#employee_jibengongzi").validatebox({
		required : true,
		validType : "number",
		missingMessage : '请输入基本工资',
		invalidMessage : '基本工资输入不对',
	});

	$("#employee_xianzhuzhi").validatebox({
		required : true, 
		missingMessage : '请输入现住址',
	});

	$("#employee_addtime").datetimebox({
	    required : true, 
	    showSeconds: true,
	    editable: false
	});

	//单击添加按钮
	$("#employeeAddButton").click(function () {
		//验证表单 
		if(!$("#employeeAddForm").form("validate")) {
			$.messager.alert("错误提示","你输入的信息还有错误！","warning");
			$(".messager-window").css("z-index",10000);
		} else {
			$("#employeeAddForm").form({
			    url: backURL + getVisitPath("Employee") + "/add",
			    onSubmit: function(){
					if($("#employeeAddForm").form("validate"))  { 
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
                        $("#employeeAddForm").form("clear");
                    }else{
                        $.messager.alert("消息",obj.message);
                        $(".messager-window").css("z-index",10000);
                    }
			    }
			});
			//提交表单
			$("#employeeAddForm").submit();
		}
	});

	//单击清空按钮
	$("#employeeClearButton").click(function () { 
		$("#employeeAddForm").form("clear"); 
	});
});
