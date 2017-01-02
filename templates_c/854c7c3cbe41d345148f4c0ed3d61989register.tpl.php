<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>会员注册</title>
<link rel="stylesheet" type="text/css" href="style/index.css" />
    <link rel="stylesheet" type="text/css" href="style/basic.css" />
    <link rel="stylesheet" type="text/css" href="style/reg.css" />
</head>
<body>
<?php $_tpl->create('header.tpl');?>
<div id="reg">
    <h2>会员注册</h2>
    <form>
        <dl>
            <dd>用 户 名：<input type="text" class="text" name="user"/><span class="red"> [必填]</span> ( *用户名在2到20位之间 )</dd>
            <dd>密　　码：<input type="password" class="text" name="pass"/><span class="red"> [必填]</span> ( *密码不得小于6位 )</dd>
            <dd>密码确认：<input type="password" class="text" name="notpass"/><span class="red"> [必填]</span> ( *密码确认和密码一致 )</dd>
            <dd>电子邮箱：<input type="text" class="text" name="email"/><span class="red"> [必填]</span> ( *每个电子邮件只能注册一个ID )</dd>
            <dd>安全问题：<select name="question">
                    <option>没有任何安全问题</option>
                    <option>您父亲的姓名？</option>
                    <option>您母亲的职业?</option>
                    <option>您配偶的性别？</option>
                </select>
            </dd>
            <dd>问题答案：<input type="text" class="text" name="answer"/></dd>
            <dd>验 证 码：<input type="text" class="text" name="code"/><span class="red"> [必填]</span></dd>
            <dd><img src="config/code.php" onclick="javascript:this.src='config/code.php?tm='+Math.random();" class="code" /></dd>
            <dd><input type="submit" name="send" class="submit" value="注册会员"/></dd>
        </dl>
    </form>
</div>
<?php $_tpl->create('footer.tpl');?>
</body>
</html>