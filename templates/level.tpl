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
    管理首页&gt;&gt;等级管理&gt;&gt;<strong id="title">{$title}</strong>
</div>
<ol>
    <li><a href="level.php?action=show" class="selected">等级列表</a></li>
    <li><a href="level.php?action=add">添加等级</a></li>
    {if $update}
    <li><a href="level.php?action=update">修改等级</a></li>
    {/if}
</ol>
{if $show}
<table>
    <tr><th>编号</th><th>等级名称</th><th>描述</th><th>操作</th></tr>
    {foreach $AllLevel(key,value)}
    <tr>
        <td><script type="text/javascript">document.write({@key+1}+{$num});</script></td>
        <td>{@value->level_name}</td>
        <td>{@value->level_info}</td>
        <td><a href="level.php?action=update&id={@value->id}">修改</a> | <a href="level.php?action=delete&id={@value->id}">删除</a></td>
    </tr>
    {/foreach}
</table>

{/if}
{if $add}
    <form method="post" name="add">
        <table class="left" cellspacing="0">
            <tr><td>等级名称：<input type="text" name="level_name" class="text"/>(* 等级名称不得小于2位，不得大于20位) </td></tr>
            <tr><td><textarea name="level_info"></textarea>(* 描述信息不得大于200位！)</td></tr>
            <tr><td><input type="submit" value="新增等级" name="send" onclick="return checkForm();" class="submit level"/>[ <a href="{$prev_url}">返回列表</a> ] </td></tr>
        </table>
    </form>
{/if}
{if $update}
    <form method="post" name="add">
        <input type="hidden" name="id" value="{$id}"/>
        <input type="hidden" name="prev_url" value="{$prev_url}"/>
        <table class="left" cellspacing="0">
            <tr><td>等级名称：<input type="text" name="level_name" value="{$level_name}" class="text"/>(* 等级名称不得小于2位，不得大于20位) </td></tr>
            <tr><td><textarea name="level_info">{$level_info}</textarea>(* 描述信息不得大于200位！)</td></tr>
            <tr><td><input type="submit" value="修改等级" name="send" onclick="return checkForm();" class="submit level"/>[ <a href="{$prev_url}">返回列表</a> ] </td></tr>
        </table>
    </form>
{/if}
<div id="page">{$page}</div>
</body>
</html>
