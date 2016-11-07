<!DOCTYPE HTML>

<?php function cdnUrl($content){

    echo 'http://uniqueml.qiniudn.com/' . $content;

}

?>

<html>

<head>

<!--[if IE]>

<meta http-equiv="X-UA-Compatible" content="IE=edge" />

<![endif]-->

<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

<title><?php $this->archiveTitle(array(

            'category'  =>  _t('分类 %s 下的文章'),

            'search'    =>  _t('包含关键字 %s 的文章'),

            'tag'       =>  _t('标签 %s 下的文章'),

            'author'    =>  _t('%s 发布的文章')

        ), '', ' - '); ?><?php $this->options->title(); ?><?php if($this->is('index')): ?> &raquo; <?php $this->options->description() ?><?php endif; ?></title>

<link rel="author" href="<?php $this->options->siteUrl(); ?>" />

<link rel="copyright" href="<?php $this->options->siteUrl(); ?>" />

<link rel="icon" href="<?php $this->options->themeUrl('favicon.ico'); ?>" type="images/x-icon" />

<link rel="stylesheet" type="text/css" media="all" href="<?php $this->options->themeUrl('style.css'); ?>" />

<script type="text/javascript" src="<?php $this->options->themeUrl('jquery.min.js'); ?>"></script>

<script type="text/javascript" src="<?php $this->options->themeUrl('pace.min.js'); ?>"></script>

<script type="text/javascript" src="<?php $this->options->themeUrl('tagcanvas.min.js'); ?>"></script>

<script type="text/javascript" src="<?php $this->options->themeUrl('unique.js'); ?>"></script>

<?php $this->header('generator=&template=&pingback=&xmlrpc=&wlw='); ?>

<meta name="baidu-site-verification" content="1Ggwn5AJnJ" />

<meta name="viewport" content="width=device-width, initial-scale=1">

</head>



<body>

<header class="hd-top">

<h1 id="logo" ><a href="<?php $this->options->siteUrl(); ?>" title="<?php $this->options->description() ?>"><?php $this->options->title() ?></a></h1>



<nav class="header-nav">

<ul>

<li <?php if($this->is('index')): ?>class="current-menu-item"<?php endif; ?>><a href="<?php $this->options->siteUrl(); ?>"><?php _e('首页'); ?></a></li>



<?php $this->widget('Widget_Contents_Page_List')->to($pages); ?>

<?php while($pages->next()): ?>

<li <?php if($this->is('page', $pages->slug)): ?>class="current-menu-item"<?php endif; ?>><a href="<?php $pages->permalink(); ?>" title="<?php $pages->title(); ?>"><?php $pages->title(); ?></a></li>

<?php endwhile; ?>

</ul>



</nav>

<div class="clear"></div>

</header>