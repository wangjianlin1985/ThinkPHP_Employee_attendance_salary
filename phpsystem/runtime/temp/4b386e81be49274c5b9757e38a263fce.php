<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:85:"C:\xampp\htdocs\phpsystem\public/../application/front\view\kaohe\kaohe_frontlist.html";i:1568642069;s:77:"C:\xampp\htdocs\phpsystem\public/../application/front\view\common\header.html";i:1568791515;s:77:"C:\xampp\htdocs\phpsystem\public/../application/front\view\common\footer.html";i:1538061378;}*/ ?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1 , user-scalable=no">
<title>员工考核查询</title>
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
            <a href="__PUBLIC__/index.php" class="navbar-brand">php设计网</a>
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
			    	<li role="presentation" class="active"><a href="#kaoheListPanel" aria-controls="kaoheListPanel" role="tab" data-toggle="tab">员工考核列表</a></li>
			    	<li role="presentation" ><a href="<?php echo url('Kaohe/frontAdd'); ?>" style="display:none;">添加员工考核</a></li>
				</ul>
			  	<!-- Tab panes -->
			  	<div class="tab-content">
				    <div role="tabpanel" class="tab-pane active" id="kaoheListPanel">
				    		<div class="row">
				    			<div class="col-md-12 top5">
				    				<div class="table-responsive">
				    				<table class="table table-condensed table-hover">
				    					<tr class="success bold"><td>序号</td><td>姓名</td><td>部门</td><td>职务</td><td>年份</td><td>月份</td><td>考核结果</td><td>考核部门</td><td>添加时间</td><td>操作</td></tr>
				    					<?php
				    						/*计算起始序号*/
				    	            		$startIndex = ($currentPage-1) * $rows;
				    	            		$currentIndex = $startIndex+1;
				    	            		/*遍历记录*/
				    					if(is_array($kaoheRs) || $kaoheRs instanceof \think\Collection): $i = 0; $__LIST__ = $kaoheRs;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$kaohe): $mod = ($i % 2 );++$i;?>
 										<tr>
 											<td><?php echo $currentIndex++; ?></td>
 											<td><?php echo $kaohe['xingmingF']['xingming']; ?></td>
 											<td><?php echo $kaohe['bumenObjF']['bumenmingcheng']; ?></td>
 											<td><?php echo $kaohe['zhiwu']; ?></td>
 											<td><?php echo $kaohe['nianfen']; ?></td>
 											<td><?php echo $kaohe['yuefen']; ?></td>
 											<td><?php echo $kaohe['kaohejieguo']; ?></td>
 											<td><?php echo $kaohe['kaohebumenF']['bumenmingcheng']; ?></td>
 											<td><?php echo $kaohe['addtime']; ?></td>
 											<td>
 												<a href="<?php echo url('Kaohe/frontshow',array('kaoheId'=>$kaohe['kaoheId'])); ?>"><i class="fa fa-info"></i>&nbsp;查看</a>&nbsp;
 												<a href="#" onclick="kaoheEdit('<?php echo $kaohe['kaoheId']; ?>');" style="display:none;"><i class="fa fa-pencil fa-fw"></i>编辑</a>&nbsp;
 												<a href="#" onclick="kaoheDelete('<?php echo $kaohe['kaoheId']; ?>');" style="display:none;"><i class="fa fa-trash-o fa-fw"></i>删除</a>
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
    		<h1>员工考核查询</h1>
		</div>
		<form name="kaoheQueryForm" id="kaoheQueryForm" action="<?php echo url('Kaohe/frontlist'); ?>" class="mar_t15" method="post">
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
            	<label for="bumenObj_bumenbianhao">部门：</label>
                <select id="bumenObj_bumenbianhao" name="bumenObj_bumenbianhao" class="form-control">
                	<option value="">不限制</option>
	 				<?php
	 				foreach($bumenList as $bumen) {
	 					$selected = "";
 					if($bumenObj['bumenbianhao'] == $bumen['bumenbianhao'])
 						$selected = "selected";
	 				?>
 				 <option value="<?php echo $bumen['bumenbianhao']; ?>" <?php echo $selected; ?>><?php echo $bumen['bumenmingcheng']; ?></option>
	 				<?php
	 				}
	 				?>
 			</select>
            </div>
			<div class="form-group">
				<label for="yuefen">月份:</label>
				<input type="text" id="yuefen" name="yuefen" value="<?php echo $yuefen; ?>" class="form-control" placeholder="请输入月份">
			</div>
            <input type=hidden name=currentPage id="currentPage" value="<%=currentPage %>" />
            <button type="submit" class="btn btn-primary" onclick="$('#currentPage').val(1);return true;">查询</button>
        </form>
	</div>

		</div>
	</div> 
<div id="kaoheEditDialog" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><i class="fa fa-edit"></i>&nbsp;员工考核信息编辑</h4>
      </div>
      <div class="modal-body" style="height:450px; overflow: scroll;">
      	<form class="form-horizontal" name="kaoheEditForm" id="kaoheEditForm" enctype="multipart/form-data" method="post"  class="mar_t15">
		  <div class="form-group">
			 <label for="kaohe_kaoheId_edit" class="col-md-3 text-right">考核id:</label>
			 <div class="col-md-9"> 
			 	<input type="text" id="kaohe_kaoheId_edit" name="kaohe.kaoheId" class="form-control" placeholder="请输入考核id" readOnly>
			 </div>
		  </div> 
		  <div class="form-group">
		  	 <label for="kaohe_xingming_bianhao_edit" class="col-md-3 text-right">姓名:</label>
		  	 <div class="col-md-9">
			    <select id="kaohe_xingming_bianhao_edit" name="kaohe_xingming_bianhao" class="form-control">
			    </select>
		  	 </div>
		  </div>
		  <div class="form-group">
		  	 <label for="kaohe_bumenObj_bumenbianhao_edit" class="col-md-3 text-right">部门:</label>
		  	 <div class="col-md-9">
			    <select id="kaohe_bumenObj_bumenbianhao_edit" name="kaohe_bumenObj_bumenbianhao" class="form-control">
			    </select>
		  	 </div>
		  </div>
		  <div class="form-group">
		  	 <label for="kaohe_zhiwu_edit" class="col-md-3 text-right">职务:</label>
		  	 <div class="col-md-9">
			    <input type="text" id="kaohe_zhiwu_edit" name="kaohe_zhiwu" class="form-control" placeholder="请输入职务">
			 </div>
		  </div>
		  <div class="form-group">
		  	 <label for="kaohe_nianfen_edit" class="col-md-3 text-right">年份:</label>
		  	 <div class="col-md-9">
			    <input type="text" id="kaohe_nianfen_edit" name="kaohe_nianfen" class="form-control" placeholder="请输入年份">
			 </div>
		  </div>
		  <div class="form-group">
		  	 <label for="kaohe_yuefen_edit" class="col-md-3 text-right">月份:</label>
		  	 <div class="col-md-9">
			    <input type="text" id="kaohe_yuefen_edit" name="kaohe_yuefen" class="form-control" placeholder="请输入月份">
			 </div>
		  </div>
		  <div class="form-group">
		  	 <label for="kaohe_kaohejieguo_edit" class="col-md-3 text-right">考核结果:</label>
		  	 <div class="col-md-9">
			    <textarea id="kaohe_kaohejieguo_edit" name="kaohe_kaohejieguo" rows="8" class="form-control" placeholder="请输入考核结果"></textarea>
			 </div>
		  </div>
		  <div class="form-group">
		  	 <label for="kaohe_kaohejiangli_edit" class="col-md-3 text-right">考核奖励:</label>
		  	 <div class="col-md-9">
			    <textarea id="kaohe_kaohejiangli_edit" name="kaohe_kaohejiangli" rows="8" class="form-control" placeholder="请输入考核奖励"></textarea>
			 </div>
		  </div>
		  <div class="form-group">
		  	 <label for="kaohe_kaohebumen_bumenbianhao_edit" class="col-md-3 text-right">考核部门:</label>
		  	 <div class="col-md-9">
			    <select id="kaohe_kaohebumen_bumenbianhao_edit" name="kaohe_kaohebumen_bumenbianhao" class="form-control">
			    </select>
		  	 </div>
		  </div>
		  <div class="form-group">
		  	 <label for="kaohe_kaoheren_edit" class="col-md-3 text-right">考核人:</label>
		  	 <div class="col-md-9">
			    <input type="text" id="kaohe_kaoheren_edit" name="kaohe_kaoheren" class="form-control" placeholder="请输入考核人">
			 </div>
		  </div>
		  <div class="form-group">
		  	 <label for="kaohe_kaoheneirong_edit" class="col-md-3 text-right">考核内容:</label>
		  	 <div class="col-md-9">
			    <textarea id="kaohe_kaoheneirong_edit" name="kaohe_kaoheneirong" rows="8" class="form-control" placeholder="请输入考核内容"></textarea>
			 </div>
		  </div>
		  <div class="form-group">
		  	 <label for="kaohe_addtime_edit" class="col-md-3 text-right">添加时间:</label>
		  	 <div class="col-md-9">
                <div class="input-group date kaohe_addtime_edit col-md-12" data-link-field="kaohe_addtime_edit">
                    <input class="form-control" id="kaohe_addtime_edit" name="kaohe_addtime" size="16" type="text" value="" placeholder="请选择添加时间" readonly>
                    <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                </div>
		  	 </div>
		  </div>
		</form> 
	    <style>#kaoheEditForm .form-group {margin-bottom:5px;}  </style>
      </div>
      <div class="modal-footer"> 
      	<button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
      	<button type="button" class="btn btn-primary" onclick="ajaxKaoheModify();">提交</button>
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
    document.kaoheQueryForm.currentPage.value = currentPage;
    document.kaoheQueryForm.submit();
}

/*可以直接跳转到某页*/
function changepage(totalPage)
{
    var pageValue=document.kaoheQueryForm.pageValue.value;
    if(pageValue>totalPage) {
        alert('你输入的页码超出了总页数!');
        return ;
    }
    document.kaoheQueryForm.currentPage.value = pageValue;
    documentkaoheQueryForm.submit();
}

/*弹出修改员工考核界面并初始化数据*/
function kaoheEdit(kaoheId) {
	$.ajax({
		url :  "<?php echo url('Kaohe/update'); ?>?kaoheId=" + kaoheId ,
		type : "get",
		dataType: "json",
		success : function (kaohe, response, status) {
			if (kaohe) {
				$("#kaohe_kaoheId_edit").val(kaohe.kaoheId);
				$.ajax({
					url: "<?php echo url('Kaohe/listAll'); ?>",
					type: "get",
					dataType: "json",
					success: function(employees,response,status) { 
						$("#kaohe_xingming_bianhao_edit").empty();
						var html="";
		        		$(employees).each(function(i,employee){
		        			html += "<option value='" + employee.bianhao + "'>" + employee.xingming + "</option>";
		        		});
		        		$("#kaohe_xingming_bianhao_edit").html(html);
		        		$("#kaohe_xingming_bianhao_edit").val(kaohe.xingming);
					}
				});
				$.ajax({
					url: "<?php echo url('Kaohe/listAll'); ?>",
					type: "get",
					dataType: "json",
					success: function(bumens,response,status) { 
						$("#kaohe_bumenObj_bumenbianhao_edit").empty();
						var html="";
		        		$(bumens).each(function(i,bumen){
		        			html += "<option value='" + bumen.bumenbianhao + "'>" + bumen.bumenmingcheng + "</option>";
		        		});
		        		$("#kaohe_bumenObj_bumenbianhao_edit").html(html);
		        		$("#kaohe_bumenObj_bumenbianhao_edit").val(kaohe.bumenObj);
					}
				});
				$("#kaohe_zhiwu_edit").val(kaohe.zhiwu);
				$("#kaohe_nianfen_edit").val(kaohe.nianfen);
				$("#kaohe_yuefen_edit").val(kaohe.yuefen);
				$("#kaohe_kaohejieguo_edit").val(kaohe.kaohejieguo);
				$("#kaohe_kaohejiangli_edit").val(kaohe.kaohejiangli);
				$.ajax({
					url: "<?php echo url('Kaohe/listAll'); ?>",
					type: "get",
					dataType: "json",
					success: function(bumens,response,status) { 
						$("#kaohe_kaohebumen_bumenbianhao_edit").empty();
						var html="";
		        		$(bumens).each(function(i,bumen){
		        			html += "<option value='" + bumen.bumenbianhao + "'>" + bumen.bumenmingcheng + "</option>";
		        		});
		        		$("#kaohe_kaohebumen_bumenbianhao_edit").html(html);
		        		$("#kaohe_kaohebumen_bumenbianhao_edit").val(kaohe.kaohebumen);
					}
				});
				$("#kaohe_kaoheren_edit").val(kaohe.kaoheren);
				$("#kaohe_kaoheneirong_edit").val(kaohe.kaoheneirong);
				$("#kaohe_addtime_edit").val(kaohe.addtime);
				$('#kaoheEditDialog').modal('show');
			} else {
				alert("获取信息失败！");
			}
		}
	});
}

/*删除员工考核信息*/
function kaoheDelete(kaoheId) {
	if(confirm("确认删除这个记录")) {
		$.ajax({
			type : "POST",
			url: "<?php echo url('Kaohe/deletes'); ?>",
			data : {
				kaoheIds : kaoheId,
			},
			dataType: "json",
			success : function (obj) {
				if (obj.success) {
					alert("删除成功");
					$("#kaoheQueryForm").submit();
					//location.href="<?php echo url('Kaohe/frontlist'); ?>";
				}
				else 
					alert(obj.message);
			},
		});
	}
}

/*ajax方式提交员工考核信息表单给服务器端修改*/
function ajaxKaoheModify() {
	$.ajax({
		url :  "<?php echo url('Kaohe/update'); ?>",
		type : "post",
		dataType: "json",
		data: new FormData($("#kaoheEditForm")[0]),
		success : function (obj, response, status) {
            if(obj.success){
                alert("信息修改成功！");
                $("#kaoheQueryForm").submit();
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

    /*添加时间组件*/
    $('.kaohe_addtime_edit').datetimepicker({
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

