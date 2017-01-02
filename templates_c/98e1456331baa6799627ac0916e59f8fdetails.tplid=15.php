<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>CMS内容管理系统</title>
    <link rel="stylesheet" type="text/css" href="style/basic.css" />
    <link rel="stylesheet" type="text/css" href="style/details.css" />
    <script type="text/javascript" src="config/static.php?id=<?php echo $this->_vars['id'];?>&type=details"></script>
</head>
<body>
<?php $_tpl->create('header.tpl');?>
<div id="details">
    <h2>当前位置 &gt; <?php echo $this->_vars['nav'];?></h2>
    <h3><?php echo $this->_vars['title'];?></h3>
    <div class="d1">时间：<?php echo $this->_vars['date'];?> 来源：<?php echo $this->_vars['source'];?> 作者：<?php echo $this->_vars['author'];?> 点击量：<?php echo $this->_vars['count'];?></div>
    <div class="d2"><?php echo $this->_vars['info'];?></div>
    <div class="d3"><?php echo $this->_vars['content'];?></div>
    <div class="d4">TAG标签：<?php echo $this->_vars['tag'];?></div>
    <div class="d5">
        <form method="post" action="feedback.php?id=<?php echo $this->_vars['id'];?>" target="_blank">
            <p>你对本文的态度：<input type="radio" name="manner" value="1" checked="checked"/>支持
                              <input type="radio" name="manner" value="0"/>中立
                              <input type="radio" name="manner" value="-1"/>反对
            </p>
            <p class="red">请遵守互联网规则，不要发表有关政治，色情，反动之类的评论</p>
            <p><textarea name="content"></textarea></p>
            <p>
                验证码：<input type="text" class="text" name="code"/>
                <img src="config/code.php" onclick="javascript:this.src='config/code.php?tm='+Math.random();" class="code" />
                <input type="submit" class="submit" name="send" value="提交评论"/>
            </p>
        </form>
    </div>

</div>
<div id="sidebar">
    <div class="right">
        <h2>本类推荐</h2>
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
    <div class="right">
        <h2>本类热点</h2>
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
    <div class="right">
        <h2>本类图文</h2>
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
</div>
<?php $_tpl->create('footer.tpl');?>
</body>
</html>