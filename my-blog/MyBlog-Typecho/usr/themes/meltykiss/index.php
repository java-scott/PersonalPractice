<?php
/** 
 * 跟WordPress样式一样但是因为Typecho限制就没那么多功能的主题罢了
 * @package MeltyKiss
 * @author Eiko
 * @version 2014.05.24
 * @link http://aiir.in
 * 
 */
 
 $this->need('header.php');
?>

<div id="main">
<section id="content">
<!--[if lte IE 9]><span style="color:red;font-size:14px;font-family:黑体">咱能换个浏览器吗？比如<a href="https://www.google.com/intl/zh-cn/chrome/browser/" target="_blank">Chrome</a>或者<a href="http://www.mozilla.org/en-US/firefox/all/#zh-CN" target="_blank">Firefox</a>什么的行吧？</span><![endif]-->
<?php while($this->next()): ?>

    <article class="post">
       <header><h2 class="post-title"><a href="<?php $this->permalink() ?>" title="查看《<?php $this->title() ?>》的全文" rel="bookmark"><?php $this->title() ?></a></h2></header>
		<div class="entry">
		<?php $this->content('阅读剩余部分......'); ?>
		</div>
		<footer class="post-meta">
		<?php $this->date('Y.m.d'); ?> &#47; <?php $this->category(','); ?><span class="post-tags"> &#47; <?php $this->tags(' &bull; ', true, 'none'); ?></span><?php if($this->user->hasLogin()): ?> &#47; <a href="<?php $this->options->adminUrl('write-post.php?cid=' . $this->cid); ?>"><?php _e('[ 编辑 ]'); ?></a><?php endif; ?>
		<span class="post-comment flr"><a href="<?php $this->permalink() ?>#comments"><?php $this->commentsNum('无回应', '1 回应', '%d 回应'); ?></a>&nbsp;/&nbsp;浏览：<?php $this->views() ?></span>
		<div class="clear"></div>
		</footer>
    </article>

<?php endwhile; ?>

<?php $this->pageNav('Prev','Next',3,'...'); ?>

</section>
<?php $this->need('sidebar.php'); ?>
</div>
<div class="clear"></div>
<?php $this->need('footer.php'); ?>