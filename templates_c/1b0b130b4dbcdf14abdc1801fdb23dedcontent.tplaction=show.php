<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>main</title>
    <link rel="stylesheet" type="text/css" href="../style/admin.css" />
    <script type="text/javascript" src="../js/admin_manage.js"></script>
    <script type="text/javascript" src="../js/admin_level.js"></script>
    <script type="text/javascript" src="../js/admin_content.js"></script>
    <script type="text/javascript" src="../ckeditor/ckeditor.js"></script>
</head>
<body id="main">
<div class="map">
    内容管理&gt;&gt;查看文档列表&gt;&gt;<strong id="title"><?php echo $this->_vars['title'];?></strong>
</div>
<ol>
    <li><a href="content.php?action=show" class="selected">文档列表</a></li>
    <li><a href="content.php?action=add">新增文档</a></li>
    <?php if ($this->_vars['update']) {?>
    <li><a href="content.php?action=update">修改管理员</a></li>
    <?php } ?>
</ol>
<?php if ($this->_vars['add']) {?>
    <form name="content" method="post" action="?action=add">
        <table cellspacing="0" class="content">
            <tr><th><strong>发布一条新文档</strong></th></tr>
            <tr><td>文档标题：<input type="text" name="title" /><span class="red">[必填]</span> ( * 标题2-50字符之间) </td></tr>
            <tr><td>栏　　目：<select name="nav"><option value="">请选择一个栏目类别</option><?php echo $this->_vars['nav'];?></select></td></tr>
            <tr><td>定义属性：<input type="checkbox" name="attr[]" value="头条"/>头条
                    <input type="checkbox" name="attr[]" value="推荐"/>推荐
                    <input type="checkbox" name="attr[]" value="加粗"/>加粗
                    <input type="checkbox" name="attr[]" value="跳转"/>跳转
                </td></tr>
            <tr><td>标　　签：<input type="text" name="tag" /> ( * 每个标签用','隔开，总长30位之内)</td></tr>
            <tr><td>关 键 字：<input type="text" name="keyword" /> ( * 每个关键字用','隔开，总长30位之内) </td></tr>
            <tr><td>缩 略 图：<input type="text" name="thumbnail" class="text" readonly="readonly" />
                    <input type="button"  value="上传缩略图" onclick="centerWindow('../templates/upload.html','upfile','400','200')" />
                    <img name="pic" style="display:none;" /> ( * 必须是jpg,gif,png，并且200k内)
                </td></tr>
            <tr><td>文章来源：<input type="text" name="source" /> ( * 文章来源20位之内)</td></tr>
            <tr><td>作　　者：<input type="text" name="author" />  ( * 作者10位之内)
                </td></tr>
            <tr><td><span class="middle">摘要内容：</span><textarea name="info"></textarea> ( * 内容摘要200之内)</td></tr>
            <tr><td><textarea style="width: 100%;" name="area"></textarea></td></tr>
            <script type="text/javascript">
                CKEDITOR.replace('area');
            </script>
            <tr><td>评论选项：<input type="radio" name="commend" value="1" checked="checked" />允许评论
                    <input type="radio" name="commend" value="0" />禁止评论
                    　　　　浏览次数：<input type="text" name="count" value="100" class="small" />
                </td></tr>
            <tr><td>文档排序：<select name="sort">
                        <option>默认排序</option>
                        <option>置顶一天</option>
                        <option>置顶一周</option>
                        <option>置顶一月</option>
                        <option>置顶一年</option>
                    </select>
                    　　　　　　　消费金币：<input type="text" name="gold" value="0" class="small"/>
                </td></tr>
            <tr><td>阅读权限：<select name="limit">
                        <option>开放浏览</option>
                        <option>初级会员</option>
                        <option>中级会员</option>
                        <option>高级会员</option>
                        <option>VIP会员</option>
                    </select>
                    　　　　　　　标题颜色：<select name="color">
                        <option>默认颜色</option>
                        <option style="color:red;" value="red">红色</option>
                        <option style="color:blue;" value="blue">蓝色</option>
                        <option style="color:orange;" value="orange">橙色</option>
                    </select>
                </td></tr>
            <tr><td><input type="submit" name="send" onclick="return checkAddContent();" value="发布文档" /> <input type="reset" value="重置" /></td></tr>
            <tr><td></td></tr>


        </table>
    </form>
<?php } ?>
</body>
</html>
