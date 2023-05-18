$(function () {
	$("#salary_xingming_bianhao").combobox({
	    url: backURL + getVisitPath("Employee") + '/listAll',
	    valueField: "bianhao",
	    textField: "xingming",
	    panelHeight: "auto",
        editable: false, //不允许手动输入
        required : true,
        onLoadSuccess: function () { //数据加载完毕事件
            var data = $("#salary_xingming_bianhao").combobox("getData"); 
            if (data.length > 0) {
                $("#salary_xingming_bianhao").combobox("select", data[0].bianhao);
            }
        }
	});
	$("#salary_bumenmingcheng_bumenbianhao").combobox({
	    url: backURL + getVisitPath("Bumen") + '/listAll',
	    valueField: "bumenbianhao",
	    textField: "bumenmingcheng",
	    panelHeight: "auto",
        editable: false, //不允许手动输入
        required : true,
        onLoadSuccess: function () { //数据加载完毕事件
            var data = $("#salary_bumenmingcheng_bumenbianhao").combobox("getData"); 
            if (data.length > 0) {
                $("#salary_bumenmingcheng_bumenbianhao").combobox("select", data[0].bumenbianhao);
            }
        }
	});
	$("#salary_danrenzhiwu").validatebox({
		required : true, 
		missingMessage : '请输入担任职务',
	});

	$("#salary_nianfen").validatebox({
		required : true, 
		missingMessage : '请输入年份',
	});

	$("#salary_yuefen").validatebox({
		required : true, 
		missingMessage : '请输入月份',
	});

	$("#salary_jibengongzi").validatebox({
		required : true,
		validType : "number",
		missingMessage : '请输入基本工资',
		invalidMessage : '基本工资输入不对',
	});

	$("#salary_quanqinjiangli").validatebox({
		required : true,
		validType : "number",
		missingMessage : '请输入全勤奖励',
		invalidMessage : '全勤奖励输入不对',
	});

	$("#salary_kaohejiangli").validatebox({
		required : true,
		validType : "number",
		missingMessage : '请输入考核奖励',
		invalidMessage : '考核奖励输入不对',
	});

	$("#salary_jiabangongzi").validatebox({
		required : true,
		validType : "number",
		missingMessage : '请输入加班工资',
		invalidMessage : '加班工资输入不对',
	});

	$("#salary_jintiebuzhu").validatebox({
		required : true,
		validType : "number",
		missingMessage : '请输入津贴补助',
		invalidMessage : '津贴补助输入不对',
	});

	$("#salary_chengfajine").validatebox({
		required : true,
		validType : "number",
		missingMessage : '请输入惩罚金额',
		invalidMessage : '惩罚金额输入不对',
	});

	$("#salary_gerensuodeshui").validatebox({
		required : true,
		validType : "number",
		missingMessage : '请输入个人所得税',
		invalidMessage : '个人所得税输入不对',
	});

	$("#salary_wuxianyijin").validatebox({
		required : true,
		validType : "number",
		missingMessage : '请输入五险一金',
		invalidMessage : '五险一金输入不对',
	});

	$("#salary_yingfagongzi").validatebox({
		required : true,
		validType : "number",
		missingMessage : '请输入应发工资',
		invalidMessage : '应发工资输入不对',
	});

	$("#salary_shifagongzi").validatebox({
		required : true,
		validType : "number",
		missingMessage : '请输入实发工资',
		invalidMessage : '实发工资输入不对',
	});

	$("#salary_addtime").datetimebox({
	    required : true, 
	    showSeconds: true,
	    editable: false
	});

	//单击添加按钮
	$("#salaryAddButton").click(function () {
		//验证表单 
		if(!$("#salaryAddForm").form("validate")) {
			$.messager.alert("错误提示","你输入的信息还有错误！","warning");
			$(".messager-window").css("z-index",10000);
		} else {
			$("#salaryAddForm").form({
			    url: backURL + getVisitPath("Salary") + "/add",
			    onSubmit: function(){
					if($("#salaryAddForm").form("validate"))  { 
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
                        $("#salaryAddForm").form("clear");
                    }else{
                        $.messager.alert("消息",obj.message);
                        $(".messager-window").css("z-index",10000);
                    }
			    }
			});
			//提交表单
			$("#salaryAddForm").submit();
		}
	});

	//单击清空按钮
	$("#salaryClearButton").click(function () { 
		$("#salaryAddForm").form("clear"); 
	});
});
