<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>CMS内容管理系统</title>
<link rel="stylesheet" type="text/css" href="style/feedback.css" />
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
{include file='header.tpl'}
<div id="feedback">
    <h2>评论列表</h2>
    {if $AllComment}
        {foreach $AllComment(key,value)}
    <dl>
        <dt><img src="images/{@value->face}" alt="{@value->user}"/></dt>
        <dd><em>{@value->date} 发表</em><span>{@value->user}</span></dd>
        <dd class="info">[{@value->manner}]{@value->content}</dd>
        <dd class="bottom"><a href="###">[0]支持</a> <a href="###">[0]反对</a></dd>
    </dl>
        {/foreach}
    {else}
    <dl>
        <dd>没有任何数据!</dd>
    </dl>
    {/if}
    <div id="page">{$page}</div>
</div>
<div id="sidebar">
    <h2>热评文档</h2>
    <ul>
        <li><em>06-20</em><a href="###">银监会否认首套房贷首付将提至...</a></li>
        <li><em>04-02</em><a href="###">发改委曝房价违规开发商名单央...</a></li>
        <li><em>02-13</em><a href="###">社科院预测更严厉楼市政策年内...</a></li>
        <li><em>05-05</em><a href="###">比亚迪拟“缩水”回归A股 以缓解...</a></li>
        <li><em>07-11</em><a href="###">第一线：北京限制高价盘预售证...</a></li>
        <li><em>03-18</em><a href="###">电网主辅分离或年内完成 葛洲坝...</a></li>
        <li><em>05-02</em><a href="###">京沪高铁将于6月9日起试运行10...</a></li>
    </ul>
</div>
{include file='footer.tpl'}
</body>
</html>