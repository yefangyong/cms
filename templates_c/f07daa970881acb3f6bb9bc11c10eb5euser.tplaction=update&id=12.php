<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>main</title>
    <link rel="stylesheet" type="text/css" href="../style/admin.css" />
    <script type="text/javascript" src="../js/admin_manage.js"></script>
    <script type="text/javascript" src="../js/admin_user.js"></script>
</head>
<body id="main">
<div class="map">
    内容管理 &gt;&gt; 设置网站导航 &gt;&gt; <strong id="title"><?php echo $this->_vars['title'];?></strong>
</div>
<ol>
    <li><a href="user.php?action=show" class="selected">会员列表</a></li>
    <li><a href="user.php?action=add">新增会员</a></li>
    <?php if ($this->_vars['update']) {?>
        <li><a href="user.php?action=update&id=<?php echo $this->_vars['id'];?>">修改会员</a></li>
    <?php } ?>
</ol>
<?php if ($this->_vars['show']) {?>
<table>
    <tr><th>编号</th><th>用户名</th><th>电子邮件</th><th>状态</th><th>操作</th></tr>
    <?php if ($this->_vars['allUser']) {?>
    <?php foreach ($this->_vars['allUser'] as $key=>$value) { ?>
    <tr>
        <td><script type="text/javascript">document.write(<?php echo $key+1?>+<?php echo $this->_vars['num'];?>);</script></td>
        <td><?php echo $value->user?></td>
        <td><?php echo $value->email?></td>
        <td><?php echo $value->state?></td>
        <td><a href="user.php?action=update&id=<?php echo $value->id?>">修改</a> | <a href="user.php?action=delete&id=<?php echo $value->id?>" onclick="return confirm('你真的要删除这个会员吗？') ? true : false">删除</a></td>
    </tr>
    <?php } ?>
        <?php } else { ?>
        <tr><td colspan="6">对不起，没有任何数据!</td></tr>
    <?php } ?>
</table>
    </form>
    <div id="page"><?php echo $this->_vars['page'];?></div>

<?php } ?>

<?php if ($this->_vars['add']) {?>
    <form method="post" name="reg">
        <table cellspacing="0" class="user">
            <tr><td>用 户 名：<input type="text" class="text" name="user" /> <span class="red">[必填]</span> ( *用户名在2到20位之间 )</td></tr>
            <tr><td>密　　码：<input type="password" class="text" name="pass" /> <span class="red">[必填]</span> ( *密码不得小于6位 )</td></tr>
            <tr><td>密码确认：<input type="password" class="text" name="notpass" /> <span class="red">[必填]</span> ( *密码确认和密码一致 )</td></tr>
            <tr><td>电子邮件：<input type="text" class="text" name="email" /> <span class="red">[必填]</span> ( *每个电子邮件只能注册一个ID )</td></tr>
            <tr><td>选择头像：<select name="face" onchange="sface();">
                        <?php foreach ($this->_vars['OptionFaceOne'] as $key=>$value) { ?>
                            <option value="0<?php echo $value?>.gif">0<?php echo $value?>.gif</option>
                        <?php } ?>
                        <?php foreach ($this->_vars['OptionFaceTwo'] as $key=>$value) { ?>
                            <option value="<?php echo $value?>.gif"><?php echo $value?>.gif</option>
                        <?php } ?>
                    </select>
                </td></tr>
            <tr><td><img name="faceimg" src="../images/01.gif" class="face" alt="01.gif" /></td></tr>
            <tr><td>安全问题：<select name="question">
                        <option value="">没有任何安全问题</option>
                        <option value="您父亲的姓名？">您父亲的姓名？</option>
                        <option value="您母亲的职业？">您母亲的职业？</option>
                        <option value="您配偶的性别？">您配偶的性别？</option>
                    </select>
                </td></tr>
            <tr><td>问题答案：<input type="text" class="text" name="answer" /></td></tr>
            <tr><td>权限设置：<input type="radio" name="state" value="0"/>被封杀的会员
                             <input type="radio" name="state" value="1" /> 待审核的会员
                             <input type="radio" name="state" value="2" checked="checked"/>初级会员
                             <input type="radio" name="state" value="3"/>中级会员
                             <input type="radio" name="state" value="4"/>高级会员
                             <input type="radio" name="state" value="5"/>VIP会员
                </td></tr>
            <tr><td><input type="submit" class="submit" name="send" onclick="return checkReg();" value="注册会员" /></td></tr>
        </table>
    </form>
<?php } ?>

<?php if ($this->_vars['update']) {?>
    <form method="post" name="reg">
        <input type="hidden" value="<?php echo $this->_vars['id'];?>" name="id" />
        <input type="hidden" value="<?php echo $this->_vars['pass'];?>" name="ppass" />
        <input type="hidden" value="<?php echo $this->_vars['prev_url'];?>" name="prev_url" />
        <table cellspacing="0" class="user">
            <tr><td>用 户 名：<?php echo $this->_vars['user'];?></td></tr>
            <tr><td>密　　码：<input type="password" class="text" name="pass" /> <span class="red">[必填]</span> ( *留空则不修改 )</td></tr>
            <tr><td>电子邮件：<input type="text"  name="email" value="<?php echo $this->_vars['email'];?>" /> <span class="red">[必填]</span> ( *每个电子邮件只能注册一个ID )</td></tr>
            <tr><td>选择头像：<select name="face" onchange="sface();">
                        <?php echo $this->_vars['face'];?>
                    </select>
                </td></tr>
            <tr><td><img name="faceimg" src="../images/<?php echo $this->_vars['facesrc'];?>" class="face" alt="01.gif" /></td></tr>
            <tr><td>安全问题：<select name="question">
                        <option value="">没有任何安全问题</option>
                        <?php echo $this->_vars['question'];?>
                    </select>
                </td></tr>
            <tr><td>问题答案：<input type="text" class="text" value="<?php echo $this->_vars['answer'];?>" name="answer" /></td></tr>
            <tr><td>权限设置：<?php echo $this->_vars['state'];?>
                </td></tr>
            <tr><td><input type="submit" class="submit" name="send" onclick="return checkReg();" value="注册会员" /></td></tr>
        </table>
    </form>
<?php } ?>


</body>
</html>
