<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:90:"C:\xampp\htdocs\phpsystem\public/../application/front\view\employee\employee_frontAdd.html";i:1568787272;s:77:"C:\xampp\htdocs\phpsystem\public/../application/front\view\common\header.html";i:1568810888;s:77:"C:\xampp\htdocs\phpsystem\public/../application/front\view\common\footer.html";i:1538061378;}*/ ?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1 , user-scalable=no">
<title>员工添加</title>
<link href="__PUBLIC__/plugins/bootstrap.css" rel="stylesheet">
<link href="__PUBLIC__/plugins/bootstrap-dashen.css" rel="stylesheet">
<link href="__PUBLIC__/plugins/font-awesome.css" rel="stylesheet">
<link href="__PUBLIC__/plugins/animate.css" rel="stylesheet">
<link href="__PUBLIC__/plugins/bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen">
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

	<div class="col-md-12 wow fadeInLeft">
		<ul class="breadcrumb">
  			<li><a href="__PUBLIC__/index.php">首页</a></li>
  			<li><a href="__PUBLIC__/Employee/frontlist">员工管理</a></li>
  			<li class="active">添加员工</li>
		</ul>
		<div class="row">
			<div class="col-md-10">
		      	<form class="form-horizontal" name="employeeAddForm" id="employeeAddForm" enctype="multipart/form-data" method="post"  class="mar_t15">
				  <div class="form-group">
					 <label for="employee_bianhao" class="col-md-2 text-right">员工编号:</label>
					 <div class="col-md-8"> 
					 	<input type="text" id="employee_bianhao" name="employee_bianhao" class="form-control" placeholder="请输入员工编号">
					 </div>
				  </div> 
				  <div class="form-group">
				  	 <label for="employee_mima" class="col-md-2 text-right">密码:</label>
				  	 <div class="col-md-8">
					    <input type="text" id="employee_mima" name="employee_mima" class="form-control" placeholder="请输入密码">
					 </div>
				  </div>
				  <div class="form-group">
				  	 <label for="employee_xingming" class="col-md-2 text-right">姓名:</label>
				  	 <div class="col-md-8">
					    <input type="text" id="employee_xingming" name="employee_xingming" class="form-control" placeholder="请输入姓名">
					 </div>
				  </div>
				  <div class="form-group">
				  	 <label for="employee_xingbie" class="col-md-2 text-right">性别:</label>
				  	 <div class="col-md-8">
                     	<select id="employee_xingbie" name="employee_xingbie" class="form-control">
                        	<option value="男">男</option>
                            <option value="女">女</option>
                        </select> 
					 </div>
				  </div>
				  <div class="form-group">
				  	 <label for="employee_bumenObj_bumenbianhao" class="col-md-2 text-right">部门:</label>
				  	 <div class="col-md-8">
					    <select id="employee_bumenObj_bumenbianhao" name="employee.bumenObj.bumenbianhao" class="form-control">
					    </select>
				  	 </div>
				  </div>
				  <div class="form-group">
				  	 <label for="employee_danrenzhiwu" class="col-md-2 text-right">担任职务:</label>
				  	 <div class="col-md-8">
					    <input type="text" id="employee_danrenzhiwu" name="employee_danrenzhiwu" class="form-control" placeholder="请输入担任职务">
					 </div>
				  </div>
				  <div class="form-group">
				  	 <label for="employee_minzu" class="col-md-2 text-right">民族:</label>
				  	 <div class="col-md-8">
					    <input type="text" id="employee_minzu" name="employee_minzu" class="form-control" placeholder="请输入民族">
					 </div>
				  </div>
				  <div class="form-group">
				  	 <label for="employee_chushengriqiDiv" class="col-md-2 text-right">出生日期:</label>
				  	 <div class="col-md-8">
		                <div id="employee_chushengriqiDiv" class="input-group date employee_chushengriqi col-md-12" data-link-field="employee_chushengriqi" data-link-format="yyyy-mm-dd">
		                    <input class="form-control" id="employee_chushengriqi" name="employee_chushengriqi" size="16" type="text" value="" placeholder="请选择出生日期" readonly>
		                    <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
		                    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
		                </div>
				  	 </div>
				  </div>
				  <div class="form-group">
				  	 <label for="employee_shenfenzhenghao" class="col-md-2 text-right">身份证号:</label>
				  	 <div class="col-md-8">
					    <input type="text" id="employee_shenfenzhenghao" name="employee_shenfenzhenghao" class="form-control" placeholder="请输入身份证号">
					 </div>
				  </div>
				  <div class="form-group">
				  	 <label for="employee_jiguan" class="col-md-2 text-right">籍贯:</label>
				  	 <div class="col-md-8">
					    <input type="text" id="employee_jiguan" name="employee_jiguan" class="form-control" placeholder="请输入籍贯">
					 </div>
				  </div>
				  <div class="form-group">
				  	 <label for="employee_wenhuachengdu" class="col-md-2 text-right">文化程度:</label>
				  	 <div class="col-md-8">
					    <input type="text" id="employee_wenhuachengdu" name="employee_wenhuachengdu" class="form-control" placeholder="请输入文化程度">
					 </div>
				  </div>
				  <div class="form-group">
				  	 <label for="employee_zhengzhimianmao" class="col-md-2 text-right">政治面貌:</label>
				  	 <div class="col-md-8">
					    <input type="text" id="employee_zhengzhimianmao" name="employee_zhengzhimianmao" class="form-control" placeholder="请输入政治面貌">
					 </div>
				  </div>
				  <div class="form-group">
				  	 <label for="employee_hunyinqingkuang" class="col-md-2 text-right">婚姻状况:</label>
				  	 <div class="col-md-8">
					    <input type="text" id="employee_hunyinqingkuang" name="employee_hunyinqingkuang" class="form-control" placeholder="请输入婚姻状况">
					 </div>
				  </div>
				  <div class="form-group">
				  	 <label for="employee_biyeyuanxiao" class="col-md-2 text-right">毕业院校:</label>
				  	 <div class="col-md-8">
					    <input type="text" id="employee_biyeyuanxiao" name="employee_biyeyuanxiao" class="form-control" placeholder="请输入毕业院校">
					 </div>
				  </div>
				  <div class="form-group">
				  	 <label for="employee_zhuanye" class="col-md-2 text-right">专业:</label>
				  	 <div class="col-md-8">
					    <input type="text" id="employee_zhuanye" name="employee_zhuanye" class="form-control" placeholder="请输入专业">
					 </div>
				  </div>
				  <div class="form-group">
				  	 <label for="employee_biyeshijianDiv" class="col-md-2 text-right">毕业时间:</label>
				  	 <div class="col-md-8">
		                <div id="employee_biyeshijianDiv" class="input-group date employee_biyeshijian col-md-12" data-link-field="employee_biyeshijian" data-link-format="yyyy-mm-dd">
		                    <input class="form-control" id="employee_biyeshijian" name="employee_biyeshijian" size="16" type="text" value="" placeholder="请选择毕业时间" readonly>
		                    <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
		                    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
		                </div>
				  	 </div>
				  </div>
				  <div class="form-group">
				  	 <label for="employee_shoujihao" class="col-md-2 text-right">手机号:</label>
				  	 <div class="col-md-8">
					    <input type="text" id="employee_shoujihao" name="employee_shoujihao" class="form-control" placeholder="请输入手机号">
					 </div>
				  </div>
				  <div class="form-group">
				  	 <label for="employee_jibengongzi" class="col-md-2 text-right">基本工资:</label>
				  	 <div class="col-md-8">
					    <input type="text" id="employee_jibengongzi" name="employee_jibengongzi" class="form-control" placeholder="请输入基本工资">
					 </div>
				  </div>
				  <div class="form-group">
				  	 <label for="employee_xianzhuzhi" class="col-md-2 text-right">现住址:</label>
				  	 <div class="col-md-8">
					    <input type="text" id="employee_xianzhuzhi" name="employee_xianzhuzhi" class="form-control" placeholder="请输入现住址">
					 </div>
				  </div>
				  <div class="form-group">
				  	 <label for="employee_zhaopian" class="col-md-2 text-right">照片:</label>
				  	 <div class="col-md-8">
					    <img  class="img-responsive" id="employee_zhaopianImg" border="0px"/><br/>
					    <input type="hidden" id="employee_zhaopian" name="employee_zhaopian"/>
					    <input id="zhaopianFile" name="zhaopianFile" type="file" size="50" />
				  	 </div>
				  </div>
				  <div class="form-group">
				  	 <label for="employee_beizhu" class="col-md-2 text-right">备注:</label>
				  	 <div class="col-md-8">
					    <textarea id="employee_beizhu" name="employee_beizhu" rows="8" class="form-control" placeholder="请输入备注"></textarea>
					 </div>
				  </div>
				  <div class="form-group" style="display:none;">
				  	 <label for="employee_addtimeDiv" class="col-md-2 text-right">添加时间:</label>
				  	 <div class="col-md-8">
		                <div id="employee_addtimeDiv" class="input-group date employee_addtime col-md-12" data-link-field="employee_addtime">
		                    <input class="form-control" id="employee_addtime" name="employee_addtime" size="16" type="text" value="" placeholder="请选择添加时间" readonly>
		                    <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
		                    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
		                </div>
				  	 </div>
				  </div>
		          <div class="form-group">
		             <span class="col-md-2"></span>
		             <span onclick="ajaxEmployeeAdd();" class="btn btn-primary bottom5 top5">员工注册</span>
		          </div> 
		          <style>#employeeAddForm .form-group {margin:5px;}  </style>  
				</form> 
			</div>
			<div class="col-md-2"></div> 
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
<script src="__PUBLIC__/plugins/bootstrapvalidator/js/bootstrapValidator.min.js"></script>
<script type="text/javascript" src="__PUBLIC__/plugins/bootstrap-datetimepicker.min.js" charset="UTF-8"></script>
<script type="text/javascript" src="__PUBLIC__/plugins/locales/bootstrap-datetimepicker.zh-CN.js" charset="UTF-8"></script>
<script>
	//提交添加员工信息
	function ajaxEmployeeAdd() { 
		//提交之前先验证表单
		$("#employeeAddForm").data('bootstrapValidator').validate();
		if(!$("#employeeAddForm").data('bootstrapValidator').isValid()){
			return;
		}
		jQuery.ajax({
			type : "post",
			url : "<?php echo url('Employee/frontAdd'); ?>",
			dataType : "json" , 
			data: new FormData($("#employeeAddForm")[0]),
			success : function(obj) {
				if(obj.success){ 
					alert("保存成功！");
					$("#employeeAddForm").find("input").val("");
					$("#employeeAddForm").find("textarea").val("");
				} else {
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
	//验证员工添加表单字段
	$('#employeeAddForm').bootstrapValidator({
		feedbackIcons: {
			valid: 'glyphicon glyphicon-ok',
			invalid: 'glyphicon glyphicon-remove',
			validating: 'glyphicon glyphicon-refresh'
		},
		fields: {
			"employee_bianhao": {
				validators: {
					notEmpty: {
						message: "员工编号不能为空",
					}
				}
			},
			"employee_mima": {
				validators: {
					notEmpty: {
						message: "密码不能为空",
					}
				}
			},
			"employee_xingming": {
				validators: {
					notEmpty: {
						message: "姓名不能为空",
					}
				}
			},
			"employee_xingbie": {
				validators: {
					notEmpty: {
						message: "性别不能为空",
					}
				}
			},
			"employee_danrenzhiwu": {
				validators: {
					notEmpty: {
						message: "担任职务不能为空",
					}
				}
			},
			"employee_minzu": {
				validators: {
					notEmpty: {
						message: "民族不能为空",
					}
				}
			},
			"employee_chushengriqi": {
				validators: {
					notEmpty: {
						message: "出生日期不能为空",
					}
				}
			},
			"employee_shenfenzhenghao": {
				validators: {
					notEmpty: {
						message: "身份证号不能为空",
					}
				}
			},
			"employee_jiguan": {
				validators: {
					notEmpty: {
						message: "籍贯不能为空",
					}
				}
			},
			"employee_wenhuachengdu": {
				validators: {
					notEmpty: {
						message: "文化程度不能为空",
					}
				}
			},
			"employee_zhengzhimianmao": {
				validators: {
					notEmpty: {
						message: "政治面貌不能为空",
					}
				}
			},
			"employee_hunyinqingkuang": {
				validators: {
					notEmpty: {
						message: "婚姻状况不能为空",
					}
				}
			},
			"employee_biyeyuanxiao": {
				validators: {
					notEmpty: {
						message: "毕业院校不能为空",
					}
				}
			},
			"employee_zhuanye": {
				validators: {
					notEmpty: {
						message: "专业不能为空",
					}
				}
			},
			"employee_biyeshijian": {
				validators: {
					notEmpty: {
						message: "毕业时间不能为空",
					}
				}
			},
			"employee_shoujihao": {
				validators: {
					notEmpty: {
						message: "手机号不能为空",
					}
				}
			},
			"employee_jibengongzi": {
				validators: {
					notEmpty: {
						message: "基本工资不能为空",
					},
					numeric: {
						message: "基本工资不正确"
					}
				}
			},
			"employee_xianzhuzhi": {
				validators: {
					notEmpty: {
						message: "现住址不能为空",
					}
				}
			},
			 
		}
	}); 
	//初始化部门下拉框值 
	$.ajax({
		url: "<?php echo url('Bumen/listAll'); ?>",
		type: "get",
		dataType : "json" ,
		success: function(bumens,response,status) { 
			$("#employee_bumenObj_bumenbianhao").empty();
			var html="";
    		$(bumens).each(function(i,bumen){
    			html += "<option value='" + bumen.bumenbianhao + "'>" + bumen.bumenmingcheng + "</option>";
    		});
    		$("#employee_bumenObj_bumenbianhao").html(html);
    	}
	});
	//出生日期组件
	$('#employee_chushengriqiDiv').datetimepicker({
		language:  'zh-CN',  //显示语言
		format: 'yyyy-mm-dd',
		minView: 2,
		weekStart: 1,
		todayBtn:  1,
		autoclose: 1,
		minuteStep: 1,
		todayHighlight: 1,
		startView: 2,
		forceParse: 0
	}).on('hide',function(e) {
		//下面这行代码解决日期组件改变日期后不验证的问题
		$('#employeeAddForm').data('bootstrapValidator').updateStatus('employee_chushengriqi', 'NOT_VALIDATED',null).validateField('employee_chushengriqi');
	});
	//毕业时间组件
	$('#employee_biyeshijianDiv').datetimepicker({
		language:  'zh-CN',  //显示语言
		format: 'yyyy-mm-dd',
		minView: 2,
		weekStart: 1,
		todayBtn:  1,
		autoclose: 1,
		minuteStep: 1,
		todayHighlight: 1,
		startView: 2,
		forceParse: 0
	}).on('hide',function(e) {
		//下面这行代码解决日期组件改变日期后不验证的问题
		$('#employeeAddForm').data('bootstrapValidator').updateStatus('employee_biyeshijian', 'NOT_VALIDATED',null).validateField('employee_biyeshijian');
	});
	//添加时间组件
	$('#employee_addtimeDiv').datetimepicker({
		language:  'zh-CN',  //显示语言
		format: 'yyyy-mm-dd hh:ii:ss',
		weekStart: 1,
		todayBtn:  1,
		autoclose: 1,
		minuteStep: 1,
		todayHighlight: 1,
		startView: 2,
		forceParse: 0
	}).on('hide',function(e) {
		//下面这行代码解决日期组件改变日期后不验证的问题
		$('#employeeAddForm').data('bootstrapValidator').updateStatus('employee_addtime', 'NOT_VALIDATED',null).validateField('employee_addtime');
	});
})
</script>
</body>
</html>
