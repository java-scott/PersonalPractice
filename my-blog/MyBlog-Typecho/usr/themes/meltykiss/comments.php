<?php $this->comments()->to($comments); ?>

<?php if ($comments->have()): ?>

<h3 id="comments"><a href="#commentform" title="Add a comment."><?php $this->commentsNum(_t('No comment so far.'), _t('1 comment so far.'), _t('%d comment so far.')); ?></a></h3>



<?php $comments->listComments(); ?>



<?php $comments->pageNav(); ?>



<?php endif; ?>







<?php if($this->allow('comment')): ?>

<div id="respond_box">

<div id="respond">



<h3>添加评论</h3>

<div class="cancel-comment-reply"><small id="cancel-comment-reply"><?php $comments->cancelReply('点这里取消回复'); ?></small></div>



<form method="post" action="<?php $this->commentUrl() ?>" id="commentform">



<?php if($this->user->hasLogin()): ?>

<p><?php print '登陆为：'; ?><a href="<?php $this->options->profileUrl(); ?>"><?php $this->user->screenName(); ?></a>&nbsp;&nbsp;<a href="<?php $this->options->logoutUrl(); ?>" title="Logout"><?php _e('[ 退出 ]'); ?></a>

</p>

<?php else: ?>

<div id="comment-author-info">

<p>

<input type="text" name="author" id="author" class="text" value="<?php $this->remember('author'); ?>" required placeholder="必填" />

<label for="author" style="font-size:14px;">昵称 *</label>

</p>

<p>

<input type="email" name="mail" id="mail" class="text" value="<?php $this->remember('mail'); ?>"<?php if ($this->options->commentsRequireMail): ?> required<?php endif; ?> placeholder="必填，不会公开"  />

<label for="email" style="font-size:14px;">邮箱<?php if ($this->options->commentsRequireMail): ?> *<?php endif; ?> </label>

</p>

<p>

<input type="url" name="url" id="url" class="text" placeholder="<?php _e('http://'); ?>" value="<?php $this->remember('url'); ?>"<?php if ($this->options->commentsRequireURL): ?> required placeholder="必填" <? else : ?> placeholder="选填" <?php endif; ?> />

<label for="url" style="font-size:14px;">网址<?php if ($this->options->commentsRequireURL): ?> *"<?php endif; ?></label>

</p>

</div>

<?php endif; ?>

<div class="clear"></div>



<p>

<textarea rows="8" cols="50" name="text" id="textarea" class="textarea" required ><?php $this->remember('text'); ?></textarea>

</p>

<p>
<?php Smilies_Plugin::output(); ?>
</p>

<p>

<input class="submit" name="submit" type="submit" id="submit" tabindex="5" value="[ 提交评论 ]"/>

<input class="reset" name="reset" type="reset" id="reset" tabindex="6" value="[ 清空 ]" />

</p>



</form>

</div>

<?php else: ?>

<h4><?php _e('评论已关闭'); ?></h4>

<?php endif; ?>

</div>