<script>

	// ajax请求热门排行数据
	$.ajax({
		type : "GET",
		url: "http://c.com/cms/config/static.php?type=header",
		dataType : "json",
		success: function(data){
			// 如果数据请求成功
				hotHtml(data.user);
		}
	});

	//将数据填充到html节点
	var hotHtml = function(data) {
        if(data !=undefined) {
		var html='';
		html += '"'+data+'"，您好！ <a href=\"register.php?action=logout\">退出</a>';

		$("#hothtml").html(html);
	}else {
            var html='';
            html +='<a href="register.php?action=reg" class="user">注册</a> <a href="register.php?action=login" class="user">登录</a>';
            $("#hothtml").html(html);
        }
    }
</script>
<div id="top">
	<span id="hothtml"></span>
	<a href="###" class="adv">这里可以放置文字广告1</a>
	<a href="###" class="adv">这里可以放置文字广告2</a>
</div>
<div id="header">
	<h1><a href="###">瓢城Web俱乐部</a></h1>
	<div class="adver"><a href="###"><img src="images/adver.png" alt="广告图" /></a></div>
</div>
<div id="nav">
	<ul>
		<li><a href="###">首页</a></li>
		{if $frontNav}
			{foreach $frontNav(key,value)}
			<li><a href="list.php?id={@value->id}">{@value->nav_name}</a></li>
		    {/foreach}
		{/if}
	</ul>
</div>
<div id="search">
	<form>
		<select name="search">
			<option selected="selected">按标题</option>
			<option>按关键字</option>
			<option>全局查询</option>
		</select>
		<input type="text" name="keyword" class="text" />
		<input type="submit" name="send" class="submit" value="搜索" />
	</form>
	<strong>TAG标签：</strong>
	<ul>
		<li><a href="###">基金(3)</a></li>
		<li><a href="###">美女(1)</a></li>
		<li><a href="###">白兰地(3)</a></li>
		<li><a href="###">音乐(1)</a></li>
		<li><a href="###">体育(1)</a></li>
		<li><a href="###">直播(1)</a></li>
		<li><a href="###">会晤(1)</a></li>
		<li><a href="###">韩日(1)</a></li>
		<li><a href="###">警方(1)</a></li>
		<li><a href="###">广州(1)</a></li>
	</ul>
</div>