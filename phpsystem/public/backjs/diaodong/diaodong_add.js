$(function () {
	$("#diaodong_xingming_bianhao").combobox({
	    url: backURL + getVisitPath("Employee") + '/listAll',
	    valueField: "bianhao",
	    textField: "xingming",
	    panelHeight: "auto",
        editable: false, //不允许手动输入
        required : true,
        onLoadSuccess: function () { //数据加载完毕事件
            var data = $("#diaodong_xingming_bianhao").combobox("getData"); 
            if (data.length > 0) {
                $("#diaodong_xingming_bianhao").combobox("select", data[0].bianhao);
            }
        }
	});
	$("#diaodong_bumenmingcheng_bumenbianhao").combobox({
	    url: backURL + getVisitPath("Bumen") + '/listAll',
	    valueField: "bumenbianhao",
	    textField: "bumenmingcheng",
	    panelHeight: "auto",
        editable: false, //不允许手动输入
        required : true,
        onLoadSuccess: function () { //数据加载完毕事件
            var data = $("#diaodong_bumenmingcheng_bumenbianhao").combobox("getData"); 
            if (data.length > 0) {
                $("#diaodong_bumenmingcheng_bumenbianhao").combobox("select", data[0].bumenbianhao);
            }
        }
	});
	$("#diaodong_danrenzhiwu").validatebox({
		required : true, 
		missingMessage : '请输入担任职务',
	});

	$("#diaodong_yuanjibengongzi").validatebox({
		required : true,
		validType : "number",
		missingMessage : '请输入原基本工资',
		invalidMessage : '原基本工资输入不对',
	});

	$("#diaodong_diaodongzhiwei").validatebox({
		required : true, 
		missingMessage : '请输入调动职位',
	});

	$("#diaodong_diaodongbumen_bumenbianhao").combobox({
	    url: backURL + getVisitPath("Bumen") + '/listAll',
	    valueField: "bumenbianhao",
	    textField: "bumenmingcheng",
	    panelHeight: "auto",
        editable: false, //不允许手动输入
        required : true,
        onLoadSuccess: function () { //数据加载完毕事件
            var data = $("#diaodong_diaodongbumen_bumenbianhao").combobox("getData"); 
            if (data.length > 0) {
                $("#diaodong_diaodongbumen_bumenbianhao").combobox("select", data[0].bumenbianhao);
            }
        }
	});
	$("#diaodong_diaodongriqi").datebox({
	    required : true, 
	    showSeconds: true,
	    editable: false
	});

	$("#diaodong_xianjibengongzi").validatebox({
		required : true,
		validType : "number",
		missingMessage : '请输入现基本工资',
		invalidMessage : '现基本工资输入不对',
	});

	$("#diaodong_diaodongyuanyin").validatebox({
		required : true, 
		missingMessage : '请输入调动原因',
	});

	$("#diaodong_addtime").datetimebox({
	    required : true, 
	    showSeconds: true,
	    editable: false
	});

	//单击添加按钮
	$("#diaodongAddButton").click(function () {
		//验证表单 
		if(!$("#diaodongAddForm").form("validate")) {
			$.messager.alert("错误提示","你输入的信息还有错误！","warning");
			$(".messager-window").css("z-index",10000);
		} else {
			$("#diaodongAddForm").form({
			    url: backURL + getVisitPath("Diaodong") + "/add",
			    onSubmit: function(){
					if($("#diaodongAddForm").form("validate"))  { 
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
                        $("#diaodongAddForm").form("clear");
                    }else{
                        $.messager.alert("消息",obj.message);
                        $(".messager-window").css("z-index",10000);
                    }
			    }
			});
			//提交表单
			$("#diaodongAddForm").submit();
		}
	});

	//单击清空按钮
	$("#diaodongClearButton").click(function () { 
		$("#diaodongAddForm").form("clear"); 
	});
});
