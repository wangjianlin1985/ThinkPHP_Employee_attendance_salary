<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:91:"C:\xampp\htdocs\phpsystem\public/../application/front\view\diaodong\diaodong_frontlist.html";i:1568642067;s:77:"C:\xampp\htdocs\phpsystem\public/../application/front\view\common\header.html";i:1568810888;s:77:"C:\xampp\htdocs\phpsystem\public/../application/front\view\common\footer.html";i:1538061378;}*/ ?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1 , user-scalable=no">
<title>员工调动查询</title>
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

	<div class="row"> 
		<div class="col-md-9 wow fadeInDown" data-wow-duration="0.5s">
			<div>
				<!-- Nav tabs -->
				<ul class="nav nav-tabs" role="tablist">
			    	<li><a href="__PUBLIC__/index.php">首页</a></li>
			    	<li role="presentation" class="active"><a href="#diaodongListPanel" aria-controls="diaodongListPanel" role="tab" data-toggle="tab">员工调动列表</a></li>
			    	<li role="presentation" ><a href="<?php echo url('Diaodong/frontAdd'); ?>" style="display:none;">添加员工调动</a></li>
				</ul>
			  	<!-- Tab panes -->
			  	<div class="tab-content">
				    <div role="tabpanel" class="tab-pane active" id="diaodongListPanel">
				    		<div class="row">
				    			<div class="col-md-12 top5">
				    				<div class="table-responsive">
				    				<table class="table table-condensed table-hover">
				    					<tr class="success bold"><td>序号</td><td>姓名</td><td>部门名称</td><td>担任职务</td><td>原基本工资</td><td>调动职位</td><td>调动部门</td><td>调动日期</td><td>现基本工资</td><td>调动原因</td><td>添加时间</td><td>操作</td></tr>
				    					<?php
				    						/*计算起始序号*/
				    	            		$startIndex = ($currentPage-1) * $rows;
				    	            		$currentIndex = $startIndex+1;
				    	            		/*遍历记录*/
				    					if(is_array($diaodongRs) || $diaodongRs instanceof \think\Collection): $i = 0; $__LIST__ = $diaodongRs;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$diaodong): $mod = ($i % 2 );++$i;?>
 										<tr>
 											<td><?php echo $currentIndex++; ?></td>
 											<td><?php echo $diaodong['xingmingF']['xingming']; ?></td>
 											<td><?php echo $diaodong['bumenmingchengF']['bumenmingcheng']; ?></td>
 											<td><?php echo $diaodong['danrenzhiwu']; ?></td>
 											<td><?php echo $diaodong['yuanjibengongzi']; ?></td>
 											<td><?php echo $diaodong['diaodongzhiwei']; ?></td>
 											<td><?php echo $diaodong['diaodongbumenF']['bumenmingcheng']; ?></td>
 											<td><?php echo $diaodong['diaodongriqi']; ?></td>
 											<td><?php echo $diaodong['xianjibengongzi']; ?></td>
 											<td><?php echo $diaodong['diaodongyuanyin']; ?></td>
 											<td><?php echo $diaodong['addtime']; ?></td>
 											<td>
 												<a href="<?php echo url('Diaodong/frontshow',array('id'=>$diaodong['id'])); ?>"><i class="fa fa-info"></i>&nbsp;查看</a>&nbsp;
 												<a href="#" onclick="diaodongEdit('<?php echo $diaodong['id']; ?>');" style="display:none;"><i class="fa fa-pencil fa-fw"></i>编辑</a>&nbsp;
 												<a href="#" onclick="diaodongDelete('<?php echo $diaodong['id']; ?>');" style="display:none;"><i class="fa fa-trash-o fa-fw"></i>删除</a>
 											</td> 
 										</tr>
 										<?php endforeach; endif; else: echo "" ;endif; ?>
				    				</table>
				    				</div>
				    			</div>
				    		</div>

				    		<div class="row">
					            <div class="col-md-12">
						            <nav class="pull-left">
						                <ul class="pagination">
						                    <li><a href="#" onclick="GoToPage(<%=currentPage-1 %>,<%=totalPage %>);" aria-label="Previous"><span aria-hidden="true">&laquo;</span></a></li>
						                     <?php
						                    	$startPage = $currentPage - 5;
						                    	$endPage = $currentPage + 5;
						                    	if($startPage < 1) $startPage=1;
						                    	if($endPage > $totalPage) $endPage = $totalPage;
						                    	for($i=$startPage;$i<=$endPage;$i++) {
						                    ?>
						                    <li class="<?php echo $currentPage==$i?"active":""; ?>"><a href="#"  onclick="GoToPage(<?php echo $i; ?>,<?php echo $totalPage; ?>);"><?php echo $i; ?></a></li>
						                    <?php } ?>
						                    <li><a href="#" onclick="GoToPage(<?php echo $currentPage + 1; ?>,<?php echo $totalPage; ?>);"><span aria-hidden="true">&raquo;</span></a></li>
						                </ul>
						            </nav>
						            <div class="pull-right" style="line-height:75px;" >共有<?php echo $recordNumber; ?>条记录，当前第<?php echo $currentPage; ?>/<?php echo $totalPage; ?>页</div>
					            </div>
				            </div> 
				    </div>
				</div>
			</div>
		</div>
	<div class="col-md-3 wow fadeInRight">
		<div class="page-header">
    		<h1>员工调动查询</h1>
		</div>
		<form name="diaodongQueryForm" id="diaodongQueryForm" action="<?php echo url('Diaodong/frontlist'); ?>" class="mar_t15" method="post">
            <div class="form-group">
            	<label for="xingming_bianhao">姓名：</label>
                <select id="xingming_bianhao" name="xingming_bianhao" class="form-control">
                	<option value="">不限制</option>
	 				<?php
	 				foreach($employeeList as $employee) {
	 					$selected = "";
 					if($xingming['bianhao'] == $employee['bianhao'])
 						$selected = "selected";
	 				?>
 				 <option value="<?php echo $employee['bianhao']; ?>" <?php echo $selected; ?>><?php echo $employee['xingming']; ?></option>
	 				<?php
	 				}
	 				?>
 			</select>
            </div>
			<div class="form-group">
				<label for="diaodongriqi">调动日期:</label>
				<input type="text" id="diaodongriqi" name="diaodongriqi" class="form-control"  placeholder="请选择调动日期" value="<?php echo $diaodongriqi; ?>" onclick="SelectDate(this,'yyyy-MM-dd')" />
			</div>
			<div class="form-group">
				<label for="diaodongyuanyin">调动原因:</label>
				<input type="text" id="diaodongyuanyin" name="diaodongyuanyin" value="<?php echo $diaodongyuanyin; ?>" class="form-control" placeholder="请输入调动原因">
			</div>
			<div class="form-group">
				<label for="addtime">添加时间:</label>
				<input type="text" id="addtime" name="addtime" class="form-control"  placeholder="请选择添加时间" value="<?php echo $addtime; ?>" onclick="SelectDate(this,'yyyy-MM-dd')" />
			</div>
            <input type=hidden name=currentPage id="currentPage" value="<%=currentPage %>" />
            <button type="submit" class="btn btn-primary" onclick="$('#currentPage').val(1);return true;">查询</button>
        </form>
	</div>

		</div>
	</div> 
<div id="diaodongEditDialog" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><i class="fa fa-edit"></i>&nbsp;员工调动信息编辑</h4>
      </div>
      <div class="modal-body" style="height:450px; overflow: scroll;">
      	<form class="form-horizontal" name="diaodongEditForm" id="diaodongEditForm" enctype="multipart/form-data" method="post"  class="mar_t15">
		  <div class="form-group">
			 <label for="diaodong_id_edit" class="col-md-3 text-right">调动id:</label>
			 <div class="col-md-9"> 
			 	<input type="text" id="diaodong_id_edit" name="diaodong.id" class="form-control" placeholder="请输入调动id" readOnly>
			 </div>
		  </div> 
		  <div class="form-group">
		  	 <label for="diaodong_xingming_bianhao_edit" class="col-md-3 text-right">姓名:</label>
		  	 <div class="col-md-9">
			    <select id="diaodong_xingming_bianhao_edit" name="diaodong_xingming_bianhao" class="form-control">
			    </select>
		  	 </div>
		  </div>
		  <div class="form-group">
		  	 <label for="diaodong_bumenmingcheng_bumenbianhao_edit" class="col-md-3 text-right">部门名称:</label>
		  	 <div class="col-md-9">
			    <select id="diaodong_bumenmingcheng_bumenbianhao_edit" name="diaodong_bumenmingcheng_bumenbianhao" class="form-control">
			    </select>
		  	 </div>
		  </div>
		  <div class="form-group">
		  	 <label for="diaodong_danrenzhiwu_edit" class="col-md-3 text-right">担任职务:</label>
		  	 <div class="col-md-9">
			    <input type="text" id="diaodong_danrenzhiwu_edit" name="diaodong_danrenzhiwu" class="form-control" placeholder="请输入担任职务">
			 </div>
		  </div>
		  <div class="form-group">
		  	 <label for="diaodong_yuanjibengongzi_edit" class="col-md-3 text-right">原基本工资:</label>
		  	 <div class="col-md-9">
			    <input type="text" id="diaodong_yuanjibengongzi_edit" name="diaodong_yuanjibengongzi" class="form-control" placeholder="请输入原基本工资">
			 </div>
		  </div>
		  <div class="form-group">
		  	 <label for="diaodong_diaodongzhiwei_edit" class="col-md-3 text-right">调动职位:</label>
		  	 <div class="col-md-9">
			    <input type="text" id="diaodong_diaodongzhiwei_edit" name="diaodong_diaodongzhiwei" class="form-control" placeholder="请输入调动职位">
			 </div>
		  </div>
		  <div class="form-group">
		  	 <label for="diaodong_diaodongbumen_bumenbianhao_edit" class="col-md-3 text-right">调动部门:</label>
		  	 <div class="col-md-9">
			    <select id="diaodong_diaodongbumen_bumenbianhao_edit" name="diaodong_diaodongbumen_bumenbianhao" class="form-control">
			    </select>
		  	 </div>
		  </div>
		  <div class="form-group">
		  	 <label for="diaodong_diaodongriqi_edit" class="col-md-3 text-right">调动日期:</label>
		  	 <div class="col-md-9">
                <div class="input-group date diaodong_diaodongriqi_edit col-md-12" data-link-field="diaodong_diaodongriqi_edit"  data-link-format="yyyy-mm-dd">
                    <input class="form-control" id="diaodong_diaodongriqi_edit" name="diaodong_diaodongriqi" size="16" type="text" value="" placeholder="请选择调动日期" readonly>
                    <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                </div>
		  	 </div>
		  </div>
		  <div class="form-group">
		  	 <label for="diaodong_xianjibengongzi_edit" class="col-md-3 text-right">现基本工资:</label>
		  	 <div class="col-md-9">
			    <input type="text" id="diaodong_xianjibengongzi_edit" name="diaodong_xianjibengongzi" class="form-control" placeholder="请输入现基本工资">
			 </div>
		  </div>
		  <div class="form-group">
		  	 <label for="diaodong_diaodongyuanyin_edit" class="col-md-3 text-right">调动原因:</label>
		  	 <div class="col-md-9">
			    <input type="text" id="diaodong_diaodongyuanyin_edit" name="diaodong_diaodongyuanyin" class="form-control" placeholder="请输入调动原因">
			 </div>
		  </div>
		  <div class="form-group">
		  	 <label for="diaodong_addtime_edit" class="col-md-3 text-right">添加时间:</label>
		  	 <div class="col-md-9">
                <div class="input-group date diaodong_addtime_edit col-md-12" data-link-field="diaodong_addtime_edit">
                    <input class="form-control" id="diaodong_addtime_edit" name="diaodong_addtime" size="16" type="text" value="" placeholder="请选择添加时间" readonly>
                    <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                </div>
		  	 </div>
		  </div>
		</form> 
	    <style>#diaodongEditForm .form-group {margin-bottom:5px;}  </style>
      </div>
      <div class="modal-footer"> 
      	<button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
      	<button type="button" class="btn btn-primary" onclick="ajaxDiaodongModify();">提交</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
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
/*跳转到查询结果的某页*/
function GoToPage(currentPage,totalPage) {
    if(currentPage==0) return;
    if(currentPage>totalPage) return;
    document.diaodongQueryForm.currentPage.value = currentPage;
    document.diaodongQueryForm.submit();
}

/*可以直接跳转到某页*/
function changepage(totalPage)
{
    var pageValue=document.diaodongQueryForm.pageValue.value;
    if(pageValue>totalPage) {
        alert('你输入的页码超出了总页数!');
        return ;
    }
    document.diaodongQueryForm.currentPage.value = pageValue;
    documentdiaodongQueryForm.submit();
}

/*弹出修改员工调动界面并初始化数据*/
function diaodongEdit(id) {
	$.ajax({
		url :  "<?php echo url('Diaodong/update'); ?>?id=" + id ,
		type : "get",
		dataType: "json",
		success : function (diaodong, response, status) {
			if (diaodong) {
				$("#diaodong_id_edit").val(diaodong.id);
				$.ajax({
					url: "<?php echo url('Diaodong/listAll'); ?>",
					type: "get",
					dataType: "json",
					success: function(employees,response,status) { 
						$("#diaodong_xingming_bianhao_edit").empty();
						var html="";
		        		$(employees).each(function(i,employee){
		        			html += "<option value='" + employee.bianhao + "'>" + employee.xingming + "</option>";
		        		});
		        		$("#diaodong_xingming_bianhao_edit").html(html);
		        		$("#diaodong_xingming_bianhao_edit").val(diaodong.xingming);
					}
				});
				$.ajax({
					url: "<?php echo url('Diaodong/listAll'); ?>",
					type: "get",
					dataType: "json",
					success: function(bumens,response,status) { 
						$("#diaodong_bumenmingcheng_bumenbianhao_edit").empty();
						var html="";
		        		$(bumens).each(function(i,bumen){
		        			html += "<option value='" + bumen.bumenbianhao + "'>" + bumen.bumenmingcheng + "</option>";
		        		});
		        		$("#diaodong_bumenmingcheng_bumenbianhao_edit").html(html);
		        		$("#diaodong_bumenmingcheng_bumenbianhao_edit").val(diaodong.bumenmingcheng);
					}
				});
				$("#diaodong_danrenzhiwu_edit").val(diaodong.danrenzhiwu);
				$("#diaodong_yuanjibengongzi_edit").val(diaodong.yuanjibengongzi);
				$("#diaodong_diaodongzhiwei_edit").val(diaodong.diaodongzhiwei);
				$.ajax({
					url: "<?php echo url('Diaodong/listAll'); ?>",
					type: "get",
					dataType: "json",
					success: function(bumens,response,status) { 
						$("#diaodong_diaodongbumen_bumenbianhao_edit").empty();
						var html="";
		        		$(bumens).each(function(i,bumen){
		        			html += "<option value='" + bumen.bumenbianhao + "'>" + bumen.bumenmingcheng + "</option>";
		        		});
		        		$("#diaodong_diaodongbumen_bumenbianhao_edit").html(html);
		        		$("#diaodong_diaodongbumen_bumenbianhao_edit").val(diaodong.diaodongbumen);
					}
				});
				$("#diaodong_diaodongriqi_edit").val(diaodong.diaodongriqi);
				$("#diaodong_xianjibengongzi_edit").val(diaodong.xianjibengongzi);
				$("#diaodong_diaodongyuanyin_edit").val(diaodong.diaodongyuanyin);
				$("#diaodong_addtime_edit").val(diaodong.addtime);
				$('#diaodongEditDialog').modal('show');
			} else {
				alert("获取信息失败！");
			}
		}
	});
}

/*删除员工调动信息*/
function diaodongDelete(id) {
	if(confirm("确认删除这个记录")) {
		$.ajax({
			type : "POST",
			url: "<?php echo url('Diaodong/deletes'); ?>",
			data : {
				ids : id,
			},
			dataType: "json",
			success : function (obj) {
				if (obj.success) {
					alert("删除成功");
					$("#diaodongQueryForm").submit();
					//location.href="<?php echo url('Diaodong/frontlist'); ?>";
				}
				else 
					alert(obj.message);
			},
		});
	}
}

/*ajax方式提交员工调动信息表单给服务器端修改*/
function ajaxDiaodongModify() {
	$.ajax({
		url :  "<?php echo url('Diaodong/update'); ?>",
		type : "post",
		dataType: "json",
		data: new FormData($("#diaodongEditForm")[0]),
		success : function (obj, response, status) {
            if(obj.success){
                alert("信息修改成功！");
                $("#diaodongQueryForm").submit();
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

    /*调动日期组件*/
    $('.diaodong_diaodongriqi_edit').datetimepicker({
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
    $('.diaodong_addtime_edit').datetimepicker({
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
})
</script>
</body>
</html>

