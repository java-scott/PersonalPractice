<aside id="sidebar">

<div id="id-card">

<a href="<?php $this->options->siteUrl(); ?>" title="<?php $this->options->description() ?>"><img src="<?php $this->options->themeUrl('personal48.png'); ?>" /></a>

<?php /*可在获取头像之后存直本地以提高加载速度*/ ?>

<div class="id">

<p class="id-name">Unique</p>

<p class="id-email">289211964@qq.com</p>

</div>

<div class="clear"></div>

</div>



<div id="side-archives" class="space">

<h3 class="side-title">最近发布</h3>

<ul>

<?php $this->widget('Widget_Contents_Post_Recent')

->parse('<li><a href="{permalink}">{title}</a></li>'); ?>

</ul>

<h3 class="side-title">文章分类</h3>

<ul>

<?php $this->widget('Widget_Metas_Category_List')

            ->parse('<li><a href="{permalink}">{name}</a>({count})</li>'); ?>

</ul>

</div>



<!--<div id="side-archives" class="space">

<h3 class="side-title">评论最多日志</h3>

<ul>

    <?php TeKit_Plugin::tekit_most_commented_posts('days=10&number=5'); ?>

</ul>

<h3 class="side-title">评论最多访客</h3>

<ul>

    <?php TeKit_Plugin::tekit_most_active_commentors('days=10&number=5&ignore=false'); ?>

</ul>

</div>-->



<div id="side-meta" class="widget">

<h3 class="side-title">标签云</h3>

<div id="myCanvasContainer">

    <canvas width="270" height="220" id="myCanvas" style="margin:auto;">

        <p>Anything in here will be replaced on browsers that support the canvas element</p>

    </canvas>

</div>

<?php $this->widget('Widget_Metas_Tag_Cloud')->to($tags); ?>

<ul class="tags-list" id="tags">

<?php while($tags->next()): ?>

    <li><a rel="tag" href="<?php $tags->permalink(); ?>" title='<?php $tags->name(); ?>'><?php $tags->name(); ?>(<?php $tags->count(); ?>)</a></li>

<?php endwhile; ?>

</ul>



<div id="side-meta" class="widget">

<h3 class="side-title">友邻Links</h3>

<ul>

    <?php Links_Plugin::output(); ?>

</ul>

</div>



<div id="side-meta" class="widget">

<h3 class="side-title">My Blog</h3>

<ul>

    <li>文章总数：<?php $this->widget('Widget_Stat')->publishedPostsNum(); ?> 篇</li>

    <li>标签总数：<?php $this->widget('Widget_Metas_Tag_Cloud')->length() ; ?> 条</li>

    <li>评论总数：<?php $this->widget('Widget_Stat')->publishedCommentsNum() ; ?> 条</li>

    <li>建站时间：2014年8月31日</li>

    <li>最后更新：<?php $this->widget('Widget_Contents_Post_Recent')->to($post)->next(); $post->date('Y年n月d日'); ?></li>

    <li>运行天数：<?php date_default_timezone_set('Asia/Shanghai'); echo(ceil((time() - strtotime('2014-08-31'))/86400))?> 天</li>

</ul>

</div>



<div id="side-meta" class="widget">

<h3 class="side-title">传送门</h3>

<ul>

<?php if($this->user->hasLogin()): ?>

<li class="last"><a href="<?php $this->options->adminUrl(); ?>"><?php _e('Admin'); ?> 「<?php $this->user->screenName(); ?>」</a></li>

<li><a href="<?php $this->options->logoutUrl(); ?>"><?php _e('Exit'); ?></a></li>

<?php else: ?>

<li class="last"><a href="<?php $this->options->adminUrl('login.php'); ?>"><?php _e('Login'); ?>&nbsp;/&nbsp;Register</a></li>

<?php endif; ?>

</ul>

</div>



<div class="side-search">

<form method="get" id="searchform" class="searchform" action="<?php $this->options->siteUrl(); ?>">

<input type="text" placeholder="Search here" name="s" id="s" size="15"/>

</form>

</div>

</aside>