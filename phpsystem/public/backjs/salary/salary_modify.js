$(function () {
	$.ajax({
		url :  backURL + getVisitPath("Salary") + "/update",
		type : "get",
		data : {
			salaryId : $("#salary_salaryId_edit").val(),
		},
		dataType: "json",
		beforeSend : function () {
			$.messager.progress({
				text : "正在获取中...",
			});
		},
		success : function (salary, response, status) {
			$.messager.progress("close");
			if (salary) { 
				$("#salary_salaryId_edit").val(salary.salaryId);
				$("#salary_salaryId_edit").validatebox({
					required : true,
					missingMessage : "请输入工资id",
					editable: false
				});
				$("#salary_xingming_bianhao_edit").combobox({
					url: backURL + getVisitPath("Employee") + "/listAll",
					valueField:"bianhao",
					textField:"xingming",
					panelHeight: "auto",
					editable: false, //不允许手动输入 
					onLoadSuccess: function () { //数据加载完毕事件
						$("#salary_xingming_bianhao_edit").combobox("select", salary.xingming);
						//var data = $("#salary_xingming_bianhao_edit").combobox("getData"); 
						//if (data.length > 0) {
							//$("#salary_xingming_bianhao_edit").combobox("select", data[0].bianhao);
						//}
					}
				});
				$("#salary_bumenmingcheng_bumenbianhao_edit").combobox({
					url: backURL + getVisitPath("Bumen") + "/listAll",
					valueField:"bumenbianhao",
					textField:"bumenmingcheng",
					panelHeight: "auto",
					editable: false, //不允许手动输入 
					onLoadSuccess: function () { //数据加载完毕事件
						$("#salary_bumenmingcheng_bumenbianhao_edit").combobox("select", salary.bumenmingcheng);
						//var data = $("#salary_bumenmingcheng_bumenbianhao_edit").combobox("getData"); 
						//if (data.length > 0) {
							//$("#salary_bumenmingcheng_bumenbianhao_edit").combobox("select", data[0].bumenbianhao);
						//}
					}
				});
				$("#salary_danrenzhiwu_edit").val(salary.danrenzhiwu);
				$("#salary_danrenzhiwu_edit").validatebox({
					required : true,
					missingMessage : "请输入担任职务",
				});
				$("#salary_nianfen_edit").val(salary.nianfen);
				$("#salary_nianfen_edit").validatebox({
					required : true,
					missingMessage : "请输入年份",
				});
				$("#salary_yuefen_edit").val(salary.yuefen);
				$("#salary_yuefen_edit").validatebox({
					required : true,
					missingMessage : "请输入月份",
				});
				$("#salary_jibengongzi_edit").val(salary.jibengongzi);
				$("#salary_jibengongzi_edit").validatebox({
					required : true,
					validType : "number",
					missingMessage : "请输入基本工资",
					invalidMessage : "基本工资输入不对",
				});
				$("#salary_quanqinjiangli_edit").val(salary.quanqinjiangli);
				$("#salary_quanqinjiangli_edit").validatebox({
					required : true,
					validType : "number",
					missingMessage : "请输入全勤奖励",
					invalidMessage : "全勤奖励输入不对",
				});
				$("#salary_kaohejiangli_edit").val(salary.kaohejiangli);
				$("#salary_kaohejiangli_edit").validatebox({
					required : true,
					validType : "number",
					missingMessage : "请输入考核奖励",
					invalidMessage : "考核奖励输入不对",
				});
				$("#salary_jiabangongzi_edit").val(salary.jiabangongzi);
				$("#salary_jiabangongzi_edit").validatebox({
					required : true,
					validType : "number",
					missingMessage : "请输入加班工资",
					invalidMessage : "加班工资输入不对",
				});
				$("#salary_jintiebuzhu_edit").val(salary.jintiebuzhu);
				$("#salary_jintiebuzhu_edit").validatebox({
					required : true,
					validType : "number",
					missingMessage : "请输入津贴补助",
					invalidMessage : "津贴补助输入不对",
				});
				$("#salary_chengfajine_edit").val(salary.chengfajine);
				$("#salary_chengfajine_edit").validatebox({
					required : true,
					validType : "number",
					missingMessage : "请输入惩罚金额",
					invalidMessage : "惩罚金额输入不对",
				});
				$("#salary_gerensuodeshui_edit").val(salary.gerensuodeshui);
				$("#salary_gerensuodeshui_edit").validatebox({
					required : true,
					validType : "number",
					missingMessage : "请输入个人所得税",
					invalidMessage : "个人所得税输入不对",
				});
				$("#salary_wuxianyijin_edit").val(salary.wuxianyijin);
				$("#salary_wuxianyijin_edit").validatebox({
					required : true,
					validType : "number",
					missingMessage : "请输入五险一金",
					invalidMessage : "五险一金输入不对",
				});
				$("#salary_yingfagongzi_edit").val(salary.yingfagongzi);
				$("#salary_yingfagongzi_edit").validatebox({
					required : true,
					validType : "number",
					missingMessage : "请输入应发工资",
					invalidMessage : "应发工资输入不对",
				});
				$("#salary_shifagongzi_edit").val(salary.shifagongzi);
				$("#salary_shifagongzi_edit").validatebox({
					required : true,
					validType : "number",
					missingMessage : "请输入实发工资",
					invalidMessage : "实发工资输入不对",
				});
				$("#salary_beizhu_edit").val(salary.beizhu);
				$("#salary_addtime_edit").datetimebox({
					value: salary.addtime,
					required: true,
					showSeconds: true,
				});
			} else {
				$.messager.alert("获取失败！", "未知错误导致失败，请重试！", "warning");
				$(".messager-window").css("z-index",10000);
			}
		}
	});

	$("#salaryModifyButton").click(function(){ 
		if ($("#salaryEditForm").form("validate")) {
			$("#salaryEditForm").form({
			    url: backURL + getVisitPath("Salary") + "/update",
			    onSubmit: function(){
					if($("#salaryEditForm").form("validate"))  {
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
			$("#salaryEditForm").submit();
		} else {
			$.messager.alert("错误提示","你输入的信息还有错误！","warning");
			$(".messager-window").css("z-index",10000);
		}
	});
});
