<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>CMS内容管理系统</title>
<link rel="stylesheet" type="text/css" href="style/index.css" />
<link rel="stylesheet" type="text/css" href="style/basic.css" />
<script type="text/javascript" src="js/reg.js"></script>
<script type="text/javascript" src="js/jquery-1.7.min.js"></script>
<script>
    //ajax技术请求会员信息
    $.ajax({
        type : "GET",
        url: "http://c.com/cms/config/static.php?type=index",
        dataType : "json",
        success: function(data){
            // 如果数据请求成功
            InfoData(data);
        }
    });

    //将数据填充到html节点
    var InfoData = function(data) {
        if(data !=undefined) {
            var $_member = '';
            $_member += '<h2>会员信息</h2>';
            $_member += '<div class="a">您好，<strong>'+data.user+'</strong> 欢迎光临</div>';
            $_member += '<div class="b">';
            $_member += '<img src="images/'+data.face+'" alt="'+data.user+'" />';
            $_member += '<a href="###">个人中心</a>';
            $_member += '<a href="###">我的评论</a>';
            $_member += '<a href="register.php?action=logout">退出登录</a>';
            $_member += '</div>';

            $("#info").html($_member);
        }else {
            var $_member='';
            $_member += '<h2>会员登录</h2>';
            $_member += '<form method="post" name="login" action="register.php?action=login">';
            $_member += '<label>用户名：<input type="text" name="user" class="text" /></label>';
            $_member += '<label>密　码：<input type="pass" name="pass" class="text" /></label>';
            $_member += '<label class="yzm">验证码：<input type="text" name="code" class="text code" /></label> <dd><img src="config/code.php" onclick=javascript:this.src="config/code.php?tm="+Math.random(); class="code" /></dd>';
            $_member += '<p><input type="submit" name="send" onclick="return checkLog();" value="登录" class="submit" /> <a href="register.php?action=reg">注册会员</a> <a href="###">忘记密码?</a></p></form>';
            $("#info").html($_member);
        }
    }
</script>
</head>
<body>
<?php $_tpl->create('header.tpl');?>
feedback
<?php $_tpl->create('footer.tpl');?>
</body>
</html>