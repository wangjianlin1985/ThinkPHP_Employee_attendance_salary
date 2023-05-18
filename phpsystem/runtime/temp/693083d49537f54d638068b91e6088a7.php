<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:97:"C:\xampp\htdocs\phpsystem\public/../application/front\view\employee\employee_frontSelfModify.html";i:1568791541;s:77:"C:\xampp\htdocs\phpsystem\public/../application/front\view\common\header.html";i:1568810888;s:77:"C:\xampp\htdocs\phpsystem\public/../application/front\view\common\footer.html";i:1538061378;}*/ ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1 , user-scalable=no">
  <TITLE>修改员工信息</TITLE>
  <link href="__PUBLIC__/plugins/bootstrap.css" rel="stylesheet">
  <link href="__PUBLIC__/plugins/bootstrap-dashen.css" rel="stylesheet">
  <link href="__PUBLIC__/plugins/font-awesome.css" rel="stylesheet">
  <link href="__PUBLIC__/plugins/animate.css" rel="stylesheet"> 
</head>
<body style="margin-top:70px;"> 
<div class="container">
<!--导航开始-->
<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container">
        <!--小屏幕导航按钮和logo-->
        <div class="navbar-header">
            <button class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a href="__PUBLIC__/index.php" class="navbar-brand">php员工管理网</a>
        </div>
        <!--小屏幕导航按钮和logo-->
        <!--导航-->
        <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-left">
                <li><a href="<?php echo url('Bumen/frontlist'); ?>">部门信息</a></li>
                <li><a href="<?php echo url('Employee/frontlist'); ?>">员工风采</a></li>
                <li><a href="<?php echo url('Diaodong/frontlist'); ?>">员工调动</a></li>
                <li><a href="<?php echo url('Salary/frontlist'); ?>">员工工资</a></li>
                <li><a href="<?php echo url('Kaohe/frontlist'); ?>">员工考核</a></li>
                <li><a href="<?php echo url('Kaoqin/frontlist'); ?>">员工考勤</a></li>
                <li><a href="<?php echo url('Peixun/frontlist'); ?>">公司培训</a></li>

            </ul>

            <ul class="nav navbar-nav navbar-right">
                <?php if(\think\Session::get('user_name') == null): ?>
                <li><a href="<?php echo url('Employee/frontAdd'); ?>"><i class="fa fa-sign-in"></i>&nbsp;&nbsp;注册</a></li>
                <li><a href="#" onclick="login();"><i class="fa fa-user"></i>&nbsp;&nbsp;登录</a></li>
                    <?php else: ?>
                <li class="dropdown">
                    <a id="dLabel" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <?php echo \think\Session::get('user_name'); ?>
                        <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="dLabel">
                        <li><a href="<?php echo url('Diaodong/empFrontlist'); ?>"><span class="glyphicon glyphicon-screenshot"></span>&nbsp;&nbsp;我的调动记录</a></li>
                        <li><a href="<?php echo url('Salary/empFrontlist'); ?>"><span class="glyphicon glyphicon-user"></span>&nbsp;&nbsp;我的工资信息</a></li>
                        <li><a href="<?php echo url('Kaohe/empFrontlist'); ?>"><span class="glyphicon glyphicon-cog"></span>&nbsp;&nbsp;我的考核记录</a></li>
                        <li><a href="<?php echo url('Kaoqin/empFrontlist'); ?>"><span class="glyphicon glyphicon-heart"></span>&nbsp;&nbsp;我的考勤信息</a></li>
                         <li><a href="<?php echo url('Employee/frontSelfModify'); ?>"><span class="glyphicon glyphicon-credit-card"></span>&nbsp;&nbsp;修改个人资料</a></li>
                    </ul>
                </li>
                <li><a href="<?php echo url('Index/logout'); ?>"><span class="glyphicon glyphicon-off"></span>&nbsp;&nbsp;退出</a></li>
                <?php endif; ?>
            </ul>

        </div>
        <!--导航-->
    </div>
</nav>
<!--导航结束-->


<div id="loginDialog" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><i class="fa fa-key"></i>&nbsp;系统登录</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" name="loginForm" id="loginForm" enctype="multipart/form-data" method="post"  class="mar_t15">

                    <div class="form-group">
                        <label for="userName" class="col-md-3 text-right">用户名:</label>
                        <div class="col-md-9">
                            <input type="text" id="userName" name="userName" class="form-control" placeholder="请输入用户名">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="password" class="col-md-3 text-right">密码:</label>
                        <div class="col-md-9">
                            <input type="password" id="password" name="password" class="form-control" placeholder="登录密码">
                        </div>
                    </div>

                </form>
                <style>#bookTypeAddForm .form-group {margin-bottom:10px;}  </style>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                <button type="button" class="btn btn-primary" onclick="ajaxLogin();">登录</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->





<div id="registerDialog" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><i class="fa fa-sign-in"></i>&nbsp;用户注册</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" name="registerForm" id="registerForm" enctype="multipart/form-data" method="post"  class="mar_t15">



                </form>
                <style>#bookTypeAddForm .form-group {margin-bottom:10px;}  </style>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                <button type="button" class="btn btn-primary" onclick="ajaxRegister();">注册</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->






<script>

    function register() {
        $("#registerDialog input").val("");
        $("#registerDialog textarea").val("");
        $('#registerDialog').modal('show');
    }
    function ajaxRegister() {
        $("#registerForm").data('bootstrapValidator').validate();
        if(!$("#registerForm").data('bootstrapValidator').isValid()){
            return;
        }

        jQuery.ajax({
            type : "post" ,
            url : basePath + "UserInfo/add",
            dataType : "json" ,
            data: new FormData($("#registerForm")[0]),
            success : function(obj) {
                if(obj.success){
                    alert("注册成功！");
                    $("#registerForm").find("input").val("");
                    $("#registerForm").find("textarea").val("");
                }else{
                    alert(obj.message);
                }
            },
            processData: false,
            contentType: false,
        });
    }


    function login() {
        $("#loginDialog input").val("");
        $('#loginDialog').modal('show');
    }
    function ajaxLogin() {
        $.ajax({
            url : "<?php echo url('Index/frontLogin'); ?>",
            type : 'post',
            dataType: "json",
            data : {
                "userName" : $('#userName').val(),
                "password" : $('#password').val(),
            },
            success : function (obj, response, status) {
                if (obj.success) {
                    location.href = "__PUBLIC__/index.php";
                } else {
                    alert(obj.message);
                }
            }
        });
    }


</script>

	<div class="col-md-9 wow fadeInLeft">
	<ul class="breadcrumb">
  		<li><a href="__PUBLIC__/index.php">首页</a></li>
  		<li class="active">员工信息修改</li>
	</ul>
		<div class="row"> 
      	<form class="form-horizontal" name="employeeEditForm" id="employeeEditForm" enctype="multipart/form-data" method="post"  class="mar_t15">
		  <div class="form-group">
			 <label for="employee_bianhao_edit" class="col-md-3 text-right">员工编号:</label>
			 <div class="col-md-9"> 
			 	<input type="text" id="employee_bianhao_edit" name="employee_bianhao" class="form-control" placeholder="请输入员工编号" readOnly>
			 </div>
		  </div> 
		  <div class="form-group">
		  	 <label for="employee_mima_edit" class="col-md-3 text-right">密码:</label>
		  	 <div class="col-md-9">
			    <input type="text" id="employee_mima_edit" name="employee_mima" class="form-control" placeholder="请输入密码">
			 </div>
		  </div>
		  <div class="form-group">
		  	 <label for="employee_xingming_edit" class="col-md-3 text-right">姓名:</label>
		  	 <div class="col-md-9">
			    <input type="text" id="employee_xingming_edit" name="employee_xingming" class="form-control" placeholder="请输入姓名">
			 </div>
		  </div>
		  <div class="form-group">
		  	 <label for="employee_xingbie_edit" class="col-md-3 text-right">性别:</label>
		  	 <div class="col-md-9">
			    <input type="text" id="employee_xingbie_edit" name="employee_xingbie" class="form-control" placeholder="请输入性别">
			 </div>
		  </div>
		  <div class="form-group">
		  	 <label for="employee_bumenObj_bumenbianhao_edit" class="col-md-3 text-right">部门:</label>
		  	 <div class="col-md-9">
			    <select id="employee_bumenObj_bumenbianhao_edit" name="employee_bumenObj_bumenbianhao" class="form-control">
			    </select>
		  	 </div>
		  </div>
		  <div class="form-group">
		  	 <label for="employee_danrenzhiwu_edit" class="col-md-3 text-right">担任职务:</label>
		  	 <div class="col-md-9">
			    <input type="text" id="employee_danrenzhiwu_edit" name="employee_danrenzhiwu" class="form-control" placeholder="请输入担任职务">
			 </div>
		  </div>
		  <div class="form-group">
		  	 <label for="employee_minzu_edit" class="col-md-3 text-right">民族:</label>
		  	 <div class="col-md-9">
			    <input type="text" id="employee_minzu_edit" name="employee_minzu" class="form-control" placeholder="请输入民族">
			 </div>
		  </div>
		  <div class="form-group">
		  	 <label for="employee_chushengriqi_edit" class="col-md-3 text-right">出生日期:</label>
		  	 <div class="col-md-9">
                <div class="input-group date employee_chushengriqi_edit col-md-12" data-link-field="employee_chushengriqi_edit" data-link-format="yyyy-mm-dd">
                    <input class="form-control" id="employee_chushengriqi_edit" name="employee_chushengriqi" size="16" type="text" value="" placeholder="请选择出生日期" readonly>
                    <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                </div>
		  	 </div>
		  </div>
		  <div class="form-group">
		  	 <label for="employee_shenfenzhenghao_edit" class="col-md-3 text-right">身份证号:</label>
		  	 <div class="col-md-9">
			    <input type="text" id="employee_shenfenzhenghao_edit" name="employee_shenfenzhenghao" class="form-control" placeholder="请输入身份证号">
			 </div>
		  </div>
		  <div class="form-group">
		  	 <label for="employee_jiguan_edit" class="col-md-3 text-right">籍贯:</label>
		  	 <div class="col-md-9">
			    <input type="text" id="employee_jiguan_edit" name="employee_jiguan" class="form-control" placeholder="请输入籍贯">
			 </div>
		  </div>
		  <div class="form-group">
		  	 <label for="employee_wenhuachengdu_edit" class="col-md-3 text-right">文化程度:</label>
		  	 <div class="col-md-9">
			    <input type="text" id="employee_wenhuachengdu_edit" name="employee_wenhuachengdu" class="form-control" placeholder="请输入文化程度">
			 </div>
		  </div>
		  <div class="form-group">
		  	 <label for="employee_zhengzhimianmao_edit" class="col-md-3 text-right">政治面貌:</label>
		  	 <div class="col-md-9">
			    <input type="text" id="employee_zhengzhimianmao_edit" name="employee_zhengzhimianmao" class="form-control" placeholder="请输入政治面貌">
			 </div>
		  </div>
		  <div class="form-group">
		  	 <label for="employee_hunyinqingkuang_edit" class="col-md-3 text-right">婚姻状况:</label>
		  	 <div class="col-md-9">
			    <input type="text" id="employee_hunyinqingkuang_edit" name="employee_hunyinqingkuang" class="form-control" placeholder="请输入婚姻状况">
			 </div>
		  </div>
		  <div class="form-group">
		  	 <label for="employee_biyeyuanxiao_edit" class="col-md-3 text-right">毕业院校:</label>
		  	 <div class="col-md-9">
			    <input type="text" id="employee_biyeyuanxiao_edit" name="employee_biyeyuanxiao" class="form-control" placeholder="请输入毕业院校">
			 </div>
		  </div>
		  <div class="form-group">
		  	 <label for="employee_zhuanye_edit" class="col-md-3 text-right">专业:</label>
		  	 <div class="col-md-9">
			    <input type="text" id="employee_zhuanye_edit" name="employee_zhuanye" class="form-control" placeholder="请输入专业">
			 </div>
		  </div>
		  <div class="form-group">
		  	 <label for="employee_biyeshijian_edit" class="col-md-3 text-right">毕业时间:</label>
		  	 <div class="col-md-9">
                <div class="input-group date employee_biyeshijian_edit col-md-12" data-link-field="employee_biyeshijian_edit" data-link-format="yyyy-mm-dd">
                    <input class="form-control" id="employee_biyeshijian_edit" name="employee_biyeshijian" size="16" type="text" value="" placeholder="请选择毕业时间" readonly>
                    <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                </div>
		  	 </div>
		  </div>
		  <div class="form-group">
		  	 <label for="employee_shoujihao_edit" class="col-md-3 text-right">手机号:</label>
		  	 <div class="col-md-9">
			    <input type="text" id="employee_shoujihao_edit" name="employee_shoujihao" class="form-control" placeholder="请输入手机号">
			 </div>
		  </div>
		  <div class="form-group">
		  	 <label for="employee_jibengongzi_edit" class="col-md-3 text-right">基本工资:</label>
		  	 <div class="col-md-9">
			    <input type="text" id="employee_jibengongzi_edit" name="employee_jibengongzi" class="form-control" placeholder="请输入基本工资">
			 </div>
		  </div>
		  <div class="form-group">
		  	 <label for="employee_xianzhuzhi_edit" class="col-md-3 text-right">现住址:</label>
		  	 <div class="col-md-9">
			    <input type="text" id="employee_xianzhuzhi_edit" name="employee_xianzhuzhi" class="form-control" placeholder="请输入现住址">
			 </div>
		  </div>
		  <div class="form-group">
		  	 <label for="employee_zhaopian_edit" class="col-md-3 text-right">照片:</label>
		  	 <div class="col-md-9">
			    <img  class="img-responsive" id="employee_zhaopianImg" border="0px"/><br/>
			    <input type="hidden" id="employee_zhaopian_edit" name="employee_zhaopian"/>
			    <input id="zhaopianFile" name="zhaopianFile" type="file" size="50" />
		  	 </div>
		  </div>
		  <div class="form-group">
		  	 <label for="employee_beizhu_edit" class="col-md-3 text-right">备注:</label>
		  	 <div class="col-md-9">
			    <textarea id="employee_beizhu_edit" name="employee_beizhu" rows="8" class="form-control" placeholder="请输入备注"></textarea>
			 </div>
		  </div>
		  <div class="form-group" style="display:none;">
		  	 <label for="employee_addtime_edit" class="col-md-3 text-right">添加时间:</label>
		  	 <div class="col-md-9">
                <div class="input-group date employee_addtime_edit col-md-12" data-link-field="employee_addtime_edit">
                    <input class="form-control" id="employee_addtime_edit" name="employee_addtime" size="16" type="text" value="" placeholder="请选择添加时间" readonly>
                    <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                </div>
		  	 </div>
		  </div>
			  <div class="form-group">
			  	<span class="col-md-3"></span>
			  	<span onclick="ajaxEmployeeModify();" class="btn btn-primary bottom5 top5">修改</span>
			  </div>
		</form> 
	    <style>#employeeEditForm .form-group {margin-bottom:5px;}  </style>
      </div>
   </div>
</div>


<!--footer-->
<footer>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <a href="http://www.baidu.com" target=_blank>© 大神开发网 from 2020</a> |
                <a href="http://www.baidu.com">本站招聘</a> |
                <a href="http://www.baidu.com">联系站长</a> |
                <a href="http://www.baidu.com">意见与建议</a> |
                <a href="http://www.baidu.com" target=_blank>蜀ICP备0343346号</a> |
                <a href="__PUBLIC__/back/login">后台登录</a>
            </div>
        </div>
    </div>
</footer>
<!--footer-->





<script src="__PUBLIC__/plugins/jquery.min.js"></script>
<script src="__PUBLIC__/plugins/bootstrap.js"></script>
<script src="__PUBLIC__/plugins/wow.min.js"></script>
<script src="__PUBLIC__/plugins/bootstrap-datetimepicker.min.js"></script>
<script src="__PUBLIC__/plugins/locales/bootstrap-datetimepicker.zh-CN.js"></script>
<script type="text/javascript" src="__PUBLIC__/js/jsdate.js"></script>
<script>
/*弹出修改员工界面并初始化数据*/
function employeeEdit(bianhao) {
	$.ajax({
		url :  "<?php echo url('Employee/update'); ?>?bianhao=" + bianhao,
		type : "get",
		dataType: "json",
		success : function (employee, response, status) {
			if (employee) {
				$("#employee_bianhao_edit").val(employee.bianhao);
				$("#employee_mima_edit").val(employee.mima);
				$("#employee_xingming_edit").val(employee.xingming);
				$("#employee_xingbie_edit").val(employee.xingbie);
				$.ajax({
					url: "<?php echo url('Bumen/listAll'); ?>",
					type: "get",
					dataType: "json",
					success: function(bumens,response,status) { 
						$("#employee_bumenObj_bumenbianhao_edit").empty();
						var html="";
		        		$(bumens).each(function(i,bumen){
		        			html += "<option value='" + bumen.bumenbianhao + "'>" + bumen.bumenmingcheng + "</option>";
		        		});
		        		$("#employee_bumenObj_bumenbianhao_edit").html(html);
		        		$("#employee_bumenObj_bumenbianhao_edit").val(employee.bumenObj);
					}
				});
				$("#employee_danrenzhiwu_edit").val(employee.danrenzhiwu);
				$("#employee_minzu_edit").val(employee.minzu);
				$("#employee_chushengriqi_edit").val(employee.chushengriqi);
				$("#employee_shenfenzhenghao_edit").val(employee.shenfenzhenghao);
				$("#employee_jiguan_edit").val(employee.jiguan);
				$("#employee_wenhuachengdu_edit").val(employee.wenhuachengdu);
				$("#employee_zhengzhimianmao_edit").val(employee.zhengzhimianmao);
				$("#employee_hunyinqingkuang_edit").val(employee.hunyinqingkuang);
				$("#employee_biyeyuanxiao_edit").val(employee.biyeyuanxiao);
				$("#employee_zhuanye_edit").val(employee.zhuanye);
				$("#employee_biyeshijian_edit").val(employee.biyeshijian);
				$("#employee_shoujihao_edit").val(employee.shoujihao);
				$("#employee_jibengongzi_edit").val(employee.jibengongzi);
				$("#employee_xianzhuzhi_edit").val(employee.xianzhuzhi);
				$("#employee_zhaopian_edit").val(employee.zhaopian);
				$("#employee_zhaopianImg").attr("src", "__PUBLIC__/" +　employee.zhaopian);
				$("#employee_beizhu_edit").val(employee.beizhu);
				$("#employee_addtime_edit").val(employee.addtime);
			} else {
				alert("获取信息失败！");
			}
		}
	});
}

/*ajax方式提交员工信息表单给服务器端修改*/
function ajaxEmployeeModify() {
	$.ajax({
		url :  "<?php echo url('Employee/update'); ?>",
		type : "post",
		dataType: "json",
		data: new FormData($("#employeeEditForm")[0]),
		success : function (obj, response, status) {
            if(obj.success){
                alert("信息修改成功！");
                location.reload(true);
                $("#employeeQueryForm").submit();
            }else{
                alert(obj.message);
            } 
		},
		processData: false,
		contentType: false,
	});
}

$(function(){
        /*小屏幕导航点击关闭菜单*/
        $('.navbar-collapse a').click(function(){
            $('.navbar-collapse').collapse('hide');
        });
        new WOW().init();
    /*出生日期组件*/
    $('.employee_chushengriqi_edit').datetimepicker({
    	language:  'zh-CN',  //语言
    	format: 'yyyy-mm-dd',
    	minView: 2,
    	weekStart: 1,
    	todayBtn:  1,
    	autoclose: 1,
    	minuteStep: 1,
    	todayHighlight: 1,
    	startView: 2,
    	forceParse: 0
    });
    /*毕业时间组件*/
    $('.employee_biyeshijian_edit').datetimepicker({
    	language:  'zh-CN',  //语言
    	format: 'yyyy-mm-dd',
    	minView: 2,
    	weekStart: 1,
    	todayBtn:  1,
    	autoclose: 1,
    	minuteStep: 1,
    	todayHighlight: 1,
    	startView: 2,
    	forceParse: 0
    });
    /*添加时间组件*/
    $('.employee_addtime_edit').datetimepicker({
    	language:  'zh-CN',  //语言
    	format: 'yyyy-mm-dd hh:ii:ss',
    	weekStart: 1,
    	todayBtn:  1,
    	autoclose: 1,
    	minuteStep: 1,
    	todayHighlight: 1,
    	startView: 2,
    	forceParse: 0
    });
    employeeEdit("<?php echo $bianhao; ?>");
 })
 </script> 
</body>
</html>

