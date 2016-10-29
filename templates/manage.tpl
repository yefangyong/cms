<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>main</title>
    <link rel="stylesheet" type="text/css" href="../style/admin.css" />
    <script type="text/javascript" src="../js/admin_manage.js"></script>
    <script type="text/javascript" src="../js/admin_level.js"></script>
</head>
<body id="main">
<div class="map">
    管理首页&gt;&gt;管理员管理&gt;&gt;<strong id="title">{$title}</strong>
</div>
<ol>
    <li><a href="manage.php?action=show" class="selected">管理员列表</a></li>
    <li><a href="manage.php?action=add">添加管理员</a></li>
    {if $update}
    <li><a href="manage.php?action=update">修改管理员</a></li>
    {/if}
</ol>
{if $show}
<table>
    <tr><th>编号</th><th>用户名</th><th>等级</th><th>登录次数</th><th>最近登录ip</th><th>最近登录时间</th><th>操作</th></tr>
    {foreach $AllManage(key,value)}
    <tr>
        <td><script type="text/javascript">document.write({@key+1}+{$num});</script></td>
        <td>{@value->admin_user}</td>
        <td>{@value->level_name}</td>
        <td>{@value->login_count}</td>
        <td>{@value->last_ip}</td>
        <td>{@value->last_time}</td>
        <td><a href="manage.php?action=update&id={@value->id}">修改</a> | <a href="manage.php?action=delete&id={@value->id}">删除</a></td>
    </tr>
    {/foreach}
</table>
    <div id="page">{$page}</div>

{/if}
{if $add}
    <form method="post" name="add">
        <table class="left" cellspacing="0">
            <tr><td>用 户 名：<input type="text" name="admin_user" class="text" /> (* 不得小于两位，不得大于20位)</td></tr>
            <tr><td>密　　码：<input type="password" name="admin_pass" class="text" /> (* 不得小于六位)</td></tr>
            <tr><td>密码确认：<input type="password" name="admin_notpass" class="text" /> (* 必须同密码一致)</td></tr>
            <tr><td>等　　级：<select name="level">
                        {foreach $allLevel(key,value)}
                            <option value="{@value->id}">{@value->level_name}</option>
                        {/foreach}
                    </select></td></tr>
            <tr><td><input type="submit" value="新增管理员" name="send" onclick="return checkAddForm();" class="submit"/>[ <a href="{$prev_url}">返回列表</a> ] </td></tr>
        </table>
    </form>
{/if}
{if $update}
    <form method="post" name="update">
        <input type="hidden" id="level" value="{$level}"/>
        <input type="hidden" value="{$id}" name="id"/>
        <input type="hidden" value="{$admin_pass}" name="pass"/>
        <input type="hidden" value="{$prev_url}" name="prev_url"/>
        <table class="left" cellspacing="0">
            <tr><td>用户名：<input type="text" name="admin_user" value="{$admin_user}" class="text"/> </td></tr>
            <tr><td>密　码：<input type="password" name="admin_pass" class="text"/> </td></tr>
            <tr><td>等　级：<select name="level">
                        {foreach $allLevel(key,value)}
                            <option value="{@value->id}">{@value->level_name}</option>
                        {/foreach}
                    </select></td></tr>
            <tr><td><input type="submit" value="修改管理员" name="send" onclick="return checkUpdateForm();" class="submit"/>[ <a href="{$prev_url}">返回列表</a> ] </td></tr>
        </table>
    </form>
{/if}
{if $delete}
    删除页面
{/if}
</body>
</html>
