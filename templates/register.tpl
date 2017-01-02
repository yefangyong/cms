<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>会员注册</title>
<link rel="stylesheet" type="text/css" href="style/index.css" />
<link rel="stylesheet" type="text/css" href="style/basic.css" />
<link rel="stylesheet" type="text/css" href="style/reg.css" />
    <script type="text/javascript" src="js/reg.js"></script>
</head>
<body>
{include file='header.tpl'}
{if $reg}
<div id="reg">
    <h2>会员注册</h2>
    <form method="post" action="?action=reg" name="reg">
        <dl>
            <dd>用 户 名：<input type="text" class="text" name="user"/><span class="red"> [必填]</span> ( *用户名在2到20位之间 )</dd>
            <dd>密　　码：<input type="password" class="text" name="pass"/><span class="red"> [必填]</span> ( *密码不得小于6位 )</dd>
            <dd>密码确认：<input type="password" class="text" name="notpass"/><span class="red"> [必填]</span> ( *密码确认和密码一致 )</dd>
            <dd>电子邮箱：<input type="text" class="text" name="email"/><span class="red"> [必填]</span> ( *每个电子邮件只能注册一个ID )</dd>
            <dd>安全问题：<select name="question">
                    <option value="没有任何安全问题">没有任何安全问题</option>
                    <option value="您父亲的姓名？">您父亲的姓名？</option>
                    <option value="您母亲的职业?">您母亲的职业?</option>
                    <option value="您配偶的性别">您配偶的性别？</option>
                </select>
            </dd>
            <dd>头像选择：<select name="face" onchange="sface()">
                    {foreach $OptionFaceOne(key,value)}
                    <option value="0{@value}.gif">0{@value}.gif</option>
                    {/foreach}
                    {foreach $OptionFaceTwo(key,value)}
                        <option value="{@value}.gif">{@value}.gif</option>
                    {/foreach}
                </select>
            </dd>
            <dd><img src="images/00.gif" class="face" name="faceing" alt="00.gif"/></dd>
            <dd>问题答案：<input type="text" class="text" name="answer"/></dd>
            <dd>验 证 码：<input type="text" class="text" name="code"/><span class="red"> [必填]</span></dd>
            <dd><img src="config/code.php" onclick="javascript:this.src='config/code.php?tm='+Math.random();" class="code" /></dd>
            <dd><input type="submit" name="send" onclick="return checkReg();" class="submit" value="注册会员"/></dd>
        </dl>
    </form>
</div>
{/if}
{if $login}
<div id="reg">
    <h2>会员注册</h2>
    <form method="post" action="?action=login" name="login">
        <dl>
            <dd>用 户 名：<input type="text" name="user"/><span class="red"> [必填]</span> ( *用户名在2到20位之间 )</dd>
            <dd>密　　码：<input type="password" name="pass"/><span class="red"> [必填]</span> ( *密码不得小于6位 )</dd>
            登录保留：<input type="radio" name="time" value="0" checked="checked"/>不保留
            <input type="radio" name="time" value="86400" />一天
            <input type="radio" name="time" value="604800" />一周
            <input type="radio" name="time" value="2592000" "/>一月
            <dd>验 证 码：<input type="text" class="text" name="code"/><span class="red"> [必填]</span></dd>
            <dd><img src="config/code.php" onclick="javascript:this.src='config/code.php?tm='+Math.random();" class="code" /></dd>
            <dd><input type="submit" name="send" onclick="return checkLog();" class="submit" value="登录"/></dd>

        </dl>
    </form>
{/if}
{include file='footer.tpl'}
</body>
</html>