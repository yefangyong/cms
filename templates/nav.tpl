<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>main</title>
    <link rel="stylesheet" type="text/css" href="../style/admin.css" />
    <script type="text/javascript" src="../js/admin_manage.js"></script>
    <script type="text/javascript" src="../js/admin_nav.js"></script>
</head>
<body id="main">
<div class="map">
    内容管理 &gt;&gt; 设置网站导航 &gt;&gt; <strong id="title">{$title}</strong>
</div>
<ol>
    <li><a href="nav.php?action=show" class="selected">导航列表</a></li>
    <li><a href="nav.php?action=add">添加导航</a></li>
    {if $update}
    <li><a href="nav.php?action=update">修改导航</a></li>
    {/if}
    {if $showChild}
        <li><a href="nav.php?action=showChild&id={$id}">子导航列表</a></li>
    {/if}
    {if $addChild}
        <li><a href="nav.php?action=addChild&id={$id}">新增子导航</a></li>
    {/if}
</ol>
{if $show}
    <form method="post" action="nav.php?action=sort">
<table>
    <tr><th>编号</th><th>导航名称</th><th>描述</th><th>子类</th><th>操作</th><th>排序</th></tr>
    {if $Alllevel}
    {foreach $Alllevel(key,value)}
    <tr>
        <td><script type="text/javascript">document.write({@key+1}+{$num});</script></td>
        <td>{@value->nav_name}</td>
        <td>{@value->nav_info}</td>
        <td><a href="nav.php?action=showChild&id={@value->id}">查看</a> | <a href="nav.php?action=addChild&id={@value->id}">增加子类</a> </td>
        <td><a href="nav.php?action=update&id={@value->id}">修改</a> | <a href="nav.php?action=delete&id={@value->id}">删除</a></td>
        <td><input type="text" name="sort[{@value->id}]" value="{@value->sort}" class="sort"/> </td>
    </tr>
    {/foreach}
        {else}
        <tr><td colspan="6">对不起，没有任何数据!</td></tr>
    {/if}
    <tr><td></td><td></td><td></td><td></td><td></td><td><input type="submit" name="send" value="排序" style="cursor: pointer;"/> </td></tr>
</table>
    </form>
    <div id="page">{$page}</div>

{/if}

{if $add}
    <form method="post" name="add">
        <table class="left" cellspacing="0">
            <tr><td>导航名称：<input type="text" name="nav_name" class="text"/>(* 导航名称不得小于2位，不得大于20位) </td></tr>
            <tr><td><textarea name="nav_info"></textarea>(* 描述信息不得大于200位！)</td></tr>
            <tr><td><input type="submit" value="新增导航" name="send" onclick="return checkForm();" class="submit level"/>[ <a href="{$prev_url}">返回列表</a> ] </td></tr>
        </table>
    </form>
{/if}

{if $update}
    <form method="post" name="add">
        <input type="hidden" value="{$id}" name="id"/>
        <input type="hidden" value="{$prev_url}" name="prev_url"/>
        <table class="left" cellspacing="0">
            <tr><td>导航名称：<input type="text" name="nav_name" value="{$nav_name}" class="text"/>(* 导航名称不得小于2位，不得大于20位) </td></tr>
            <tr><td><textarea name="nav_info">{$nav_info}</textarea>(* 描述信息不得大于200位！)</td></tr>
            <tr><td><input type="submit" value="修改导航" name="send" onclick="return checkForm();" class="submit level"/>[ <a href="{$prev_url}">返回列表</a> ] </td></tr>
        </table>
    </form>
{/if}

{if $showChild}
<form method="post" action="nav.php?action=sort">
    <table>
        <tr><th>编号</th><th>导航名称</th><th>描述</th><th>操作</th><th>排序</th></tr>
        {if $AllChildNav}
            {foreach $AllChildNav(key,value)}
                <tr>
                    <td><script type="text/javascript">document.write({@key+1}+{$num});</script></td>
                    <td>{@value->nav_name}</td>
                    <td>{@value->nav_info}</td>
                    <td><a href="nav.php?action=update&id={@value->id}">修改</a> | <a href="nav.php?action=delete&id={@value->id}" onclick="return confirm('你真的要删除这个导航吗？');">删除</a></td>
                    <td><input type="text" name="sort[{@value->id}]" value="{@value->sort}" class="sort"/> </td>
                </tr>
            {/foreach}
        {else}
            <tr><td colspan="5">对不起，没有任何数据!</td></tr>
        {/if}
        <tr><td></td><td></td><td></td><td></td><td><input type="submit" name="send" value="排序" style="cursor: pointer;"/> </td></tr>
        <tr><td colspan="5">本类隶属：<strong>{$prev_name}</strong> [ <a href="nav.php?action=addChild&id={$id}">增加本类</a> ] [ <a href="{$prev_url}">返回列表</a> ]</td></tr>
    </table>
    </form>
    <div id="page">{$page}</div>

{/if}
{if $addChild}
    <form method="post" name="add">
        <input type="hidden" name="pid" value="{$id}"/>
        <table class="left" cellspacing="0">
            <tr><td>上级导航：<input type="text" name="prev_name" value="{$prev_name}"/> </td></tr>
            <tr><td>导航名称：<input type="text" name="nav_name"/>(* 导航名称不得小于2位，不得大于20位) </td></tr>
            <tr><td><textarea name="nav_info"></textarea>(* 描述信息不得大于200位！)</td></tr>
            <tr><td><input type="submit" value="新增导航" name="send" onclick="return checkForm();" class="submit level"/>[ <a href="{$prev_url}">返回列表</a> ] </td></tr>
        </table>
    </form>
{/if}

</body>
</html>
