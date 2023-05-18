$(function () {
	$.ajax({
		url :  backURL + getVisitPath("Employee") + "/update",
		type : "get",
		data : {
			bianhao : $("#employee_bianhao_edit").val(),
		},
		dataType: "json",
		beforeSend : function () {
			$.messager.progress({
				text : "正在获取中...",
			});
		},
		success : function (employee, response, status) {
			$.messager.progress("close");
			if (employee) { 
				$("#employee_bianhao_edit").val(employee.bianhao);
				$("#employee_bianhao_edit").validatebox({
					required : true,
					missingMessage : "请输入员工编号",
					editable: false
				});
				$("#employee_mima_edit").val(employee.mima);
				$("#employee_mima_edit").validatebox({
					required : true,
					missingMessage : "请输入密码",
				});
				$("#employee_xingming_edit").val(employee.xingming);
				$("#employee_xingming_edit").validatebox({
					required : true,
					missingMessage : "请输入姓名",
				});
				$("#employee_xingbie_edit").val(employee.xingbie);
				$("#employee_xingbie_edit").validatebox({
					required : true,
					missingMessage : "请输入性别",
				});
				$("#employee_bumenObj_bumenbianhao_edit").combobox({
					url: backURL + getVisitPath("Bumen") + "/listAll",
					valueField:"bumenbianhao",
					textField:"bumenmingcheng",
					panelHeight: "auto",
					editable: false, //不允许手动输入 
					onLoadSuccess: function () { //数据加载完毕事件
						$("#employee_bumenObj_bumenbianhao_edit").combobox("select", employee.bumenObj);
						//var data = $("#employee_bumenObj_bumenbianhao_edit").combobox("getData"); 
						//if (data.length > 0) {
							//$("#employee_bumenObj_bumenbianhao_edit").combobox("select", data[0].bumenbianhao);
						//}
					}
				});
				$("#employee_danrenzhiwu_edit").val(employee.danrenzhiwu);
				$("#employee_danrenzhiwu_edit").validatebox({
					required : true,
					missingMessage : "请输入担任职务",
				});
				$("#employee_minzu_edit").val(employee.minzu);
				$("#employee_minzu_edit").validatebox({
					required : true,
					missingMessage : "请输入民族",
				});
				$("#employee_chushengriqi_edit").datebox({
					value: employee.chushengriqi,
					required: true,
					showSeconds: true,
				});
				$("#employee_shenfenzhenghao_edit").val(employee.shenfenzhenghao);
				$("#employee_shenfenzhenghao_edit").validatebox({
					required : true,
					missingMessage : "请输入身份证号",
				});
				$("#employee_jiguan_edit").val(employee.jiguan);
				$("#employee_jiguan_edit").validatebox({
					required : true,
					missingMessage : "请输入籍贯",
				});
				$("#employee_wenhuachengdu_edit").val(employee.wenhuachengdu);
				$("#employee_wenhuachengdu_edit").validatebox({
					required : true,
					missingMessage : "请输入文化程度",
				});
				$("#employee_zhengzhimianmao_edit").val(employee.zhengzhimianmao);
				$("#employee_zhengzhimianmao_edit").validatebox({
					required : true,
					missingMessage : "请输入政治面貌",
				});
				$("#employee_hunyinqingkuang_edit").val(employee.hunyinqingkuang);
				$("#employee_hunyinqingkuang_edit").validatebox({
					required : true,
					missingMessage : "请输入婚姻状况",
				});
				$("#employee_biyeyuanxiao_edit").val(employee.biyeyuanxiao);
				$("#employee_biyeyuanxiao_edit").validatebox({
					required : true,
					missingMessage : "请输入毕业院校",
				});
				$("#employee_zhuanye_edit").val(employee.zhuanye);
				$("#employee_zhuanye_edit").validatebox({
					required : true,
					missingMessage : "请输入专业",
				});
				$("#employee_biyeshijian_edit").datebox({
					value: employee.biyeshijian,
					required: true,
					showSeconds: true,
				});
				$("#employee_shoujihao_edit").val(employee.shoujihao);
				$("#employee_shoujihao_edit").validatebox({
					required : true,
					missingMessage : "请输入手机号",
				});
				$("#employee_jibengongzi_edit").val(employee.jibengongzi);
				$("#employee_jibengongzi_edit").validatebox({
					required : true,
					validType : "number",
					missingMessage : "请输入基本工资",
					invalidMessage : "基本工资输入不对",
				});
				$("#employee_xianzhuzhi_edit").val(employee.xianzhuzhi);
				$("#employee_xianzhuzhi_edit").validatebox({
					required : true,
					missingMessage : "请输入现住址",
				});
				$("#employee_zhaopian").val(employee.zhaopian);
				$("#employee_zhaopianImg").attr("src", publicURL + employee.zhaopian);
				$("#employee_beizhu_edit").val(employee.beizhu);
				$("#employee_addtime_edit").datetimebox({
					value: employee.addtime,
					required: true,
					showSeconds: true,
				});
			} else {
				$.messager.alert("获取失败！", "未知错误导致失败，请重试！", "warning");
				$(".messager-window").css("z-index",10000);
			}
		}
	});

	$("#employeeModifyButton").click(function(){ 
		if ($("#employeeEditForm").form("validate")) {
			$("#employeeEditForm").form({
			    url: backURL + getVisitPath("Employee") + "/update",
			    onSubmit: function(){
					if($("#employeeEditForm").form("validate"))  {
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
			$("#employeeEditForm").submit();
		} else {
			$.messager.alert("错误提示","你输入的信息还有错误！","warning");
			$(".messager-window").css("z-index",10000);
		}
	});
});
