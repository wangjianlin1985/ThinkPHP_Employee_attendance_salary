<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:74:"C:\xampp\htdocs\phpsystem\public/../application/back\view\index\index.html";i:1568810846;}*/ ?>
﻿<!DOCTYPE html>
<html>
<head>
    <title>信息管理系统</title>
    <meta charset="UTF-8" />
    <link rel="stylesheet" type="text/css" href="__PUBLIC__/easyui/themes/default/easyui.css" />
    <link rel="stylesheet" type="text/css" href="__PUBLIC__/easyui/themes/icon.css" />
    <link rel="stylesheet" type="text/css" href="__PUBLIC__/backcss/admin.css" />
</head>
<body class="easyui-layout">

<div data-options="region:'north',title:'header',split:true,noheader:true" style="height:60px;background-color:#c0a16b;border:0px;">
    <div class="logo">PHP员工管理后台【ThinkPHP5框架】</div>
    <div class="logout">您好，<?php echo \think\Session::get('username'); ?>| <a href="<?php echo url('Login/logout'); ?>">退出</a></div>
</div>
<div data-options="region:'south',title:'footer',split:true,noheader:true" style="height:35px;line-height:30px;text-align:center;border:0px;">
    &copy; Powered by dashen
</div>
<div data-options="region:'west',title:'导航',split:true,iconCls:'icon-world'" style="width:200px;padding:10px;border:0px;">
    <ul id="nav"></ul>
</div>
<div data-options="region:'center'" style="overflow:hidden;border:1px solid #dca7a7;">
    <div id="tabs">
        <div title="起始页" iconCls="icon-house" style="padding:0 10px;display:block;font-size:70px">
            <br/><br/> <center>欢迎来到后台管理系统！</center>
        </div>
    </div>
</div>


<script type="text/javascript" src="__PUBLIC__/easyui/jquery.min.js"></script>
<script type="text/javascript" src="__PUBLIC__/easyui/jquery.easyui.min.js"></script>
<script type="text/javascript" src="__PUBLIC__/easyui/locale/easyui-lang-zh_CN.js" ></script>

<script> var backURL = "__PUBLIC__/index.php/back/";</script>
<script type="text/javascript" src="__PUBLIC__/backjs/admin.js"></script>


</body>
</html>
