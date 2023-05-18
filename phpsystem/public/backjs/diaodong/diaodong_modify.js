$(function () {
	$.ajax({
		url :  backURL + getVisitPath("Diaodong") + "/update",
		type : "get",
		data : {
			id : $("#diaodong_id_edit").val(),
		},
		dataType: "json",
		beforeSend : function () {
			$.messager.progress({
				text : "正在获取中...",
			});
		},
		success : function (diaodong, response, status) {
			$.messager.progress("close");
			if (diaodong) { 
				$("#diaodong_id_edit").val(diaodong.id);
				$("#diaodong_id_edit").validatebox({
					required : true,
					missingMessage : "请输入调动id",
					editable: false
				});
				$("#diaodong_xingming_bianhao_edit").combobox({
					url: backURL + getVisitPath("Employee") + "/listAll",
					valueField:"bianhao",
					textField:"xingming",
					panelHeight: "auto",
					editable: false, //不允许手动输入 
					onLoadSuccess: function () { //数据加载完毕事件
						$("#diaodong_xingming_bianhao_edit").combobox("select", diaodong.xingming);
						//var data = $("#diaodong_xingming_bianhao_edit").combobox("getData"); 
						//if (data.length > 0) {
							//$("#diaodong_xingming_bianhao_edit").combobox("select", data[0].bianhao);
						//}
					}
				});
				$("#diaodong_bumenmingcheng_bumenbianhao_edit").combobox({
					url: backURL + getVisitPath("Bumen") + "/listAll",
					valueField:"bumenbianhao",
					textField:"bumenmingcheng",
					panelHeight: "auto",
					editable: false, //不允许手动输入 
					onLoadSuccess: function () { //数据加载完毕事件
						$("#diaodong_bumenmingcheng_bumenbianhao_edit").combobox("select", diaodong.bumenmingcheng);
						//var data = $("#diaodong_bumenmingcheng_bumenbianhao_edit").combobox("getData"); 
						//if (data.length > 0) {
							//$("#diaodong_bumenmingcheng_bumenbianhao_edit").combobox("select", data[0].bumenbianhao);
						//}
					}
				});
				$("#diaodong_danrenzhiwu_edit").val(diaodong.danrenzhiwu);
				$("#diaodong_danrenzhiwu_edit").validatebox({
					required : true,
					missingMessage : "请输入担任职务",
				});
				$("#diaodong_yuanjibengongzi_edit").val(diaodong.yuanjibengongzi);
				$("#diaodong_yuanjibengongzi_edit").validatebox({
					required : true,
					validType : "number",
					missingMessage : "请输入原基本工资",
					invalidMessage : "原基本工资输入不对",
				});
				$("#diaodong_diaodongzhiwei_edit").val(diaodong.diaodongzhiwei);
				$("#diaodong_diaodongzhiwei_edit").validatebox({
					required : true,
					missingMessage : "请输入调动职位",
				});
				$("#diaodong_diaodongbumen_bumenbianhao_edit").combobox({
					url: backURL + getVisitPath("Bumen") + "/listAll",
					valueField:"bumenbianhao",
					textField:"bumenmingcheng",
					panelHeight: "auto",
					editable: false, //不允许手动输入 
					onLoadSuccess: function () { //数据加载完毕事件
						$("#diaodong_diaodongbumen_bumenbianhao_edit").combobox("select", diaodong.diaodongbumen);
						//var data = $("#diaodong_diaodongbumen_bumenbianhao_edit").combobox("getData"); 
						//if (data.length > 0) {
							//$("#diaodong_diaodongbumen_bumenbianhao_edit").combobox("select", data[0].bumenbianhao);
						//}
					}
				});
				$("#diaodong_diaodongriqi_edit").datebox({
					value: diaodong.diaodongriqi,
					required: true,
					showSeconds: true,
				});
				$("#diaodong_xianjibengongzi_edit").val(diaodong.xianjibengongzi);
				$("#diaodong_xianjibengongzi_edit").validatebox({
					required : true,
					validType : "number",
					missingMessage : "请输入现基本工资",
					invalidMessage : "现基本工资输入不对",
				});
				$("#diaodong_diaodongyuanyin_edit").val(diaodong.diaodongyuanyin);
				$("#diaodong_diaodongyuanyin_edit").validatebox({
					required : true,
					missingMessage : "请输入调动原因",
				});
				$("#diaodong_addtime_edit").datetimebox({
					value: diaodong.addtime,
					required: true,
					showSeconds: true,
				});
			} else {
				$.messager.alert("获取失败！", "未知错误导致失败，请重试！", "warning");
				$(".messager-window").css("z-index",10000);
			}
		}
	});

	$("#diaodongModifyButton").click(function(){ 
		if ($("#diaodongEditForm").form("validate")) {
			$("#diaodongEditForm").form({
			    url: backURL + getVisitPath("Diaodong") + "/update",
			    onSubmit: function(){
					if($("#diaodongEditForm").form("validate"))  {
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
			$("#diaodongEditForm").submit();
		} else {
			$.messager.alert("错误提示","你输入的信息还有错误！","warning");
			$(".messager-window").css("z-index",10000);
		}
	});
});
