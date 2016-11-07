<?php
/** Get Browser Infomations */
function get_browsers($ua){
	$title = 'unknow';
	$icon = 'unknow';	
        if (preg_match('#MSIE ([a-zA-Z0-9.]+)#i', $ua, $matches)) {
		$title = 'Internet Explorer '. $matches[1];
		if ( strpos($matches[1], '7') !== false || strpos($matches[1], '8') !== false)
			$icon = 'ie8';
		elseif ( strpos($matches[1], '9') !== false)
			$icon = 'ie9';
		elseif ( strpos($matches[1], '10') !== false)
			$icon = 'ie10';
		else
			$icon = 'ie';
        }elseif (preg_match('#Firefox/([a-zA-Z0-9.]+)#i', $ua, $matches)){
		$title = 'Firefox '. $matches[1];
                $icon = 'firefox';
	}elseif (preg_match('#CriOS/([a-zA-Z0-9.]+)#i', $ua, $matches)){
		$title = 'Chrome for iOS '. $matches[1];
		$icon = 'crios';
	}elseif (preg_match('#LBBROWSER#i', $ua, $matches)){
                $title = '猎豹安全浏览器';
                $icon = 'liebaosafe';
        }elseif (preg_match('#Chrome/([a-zA-Z0-9.]+)#i', $ua, $matches)) {
		$title = 'Google Chrome '. $matches[1];
		$icon = 'chrome';
		if (preg_match('#OPR/([a-zA-Z0-9.]+)#i', $ua, $matches)) {
			$title = 'Opera '. $matches[1];
			$icon = 'opera15';
			if (preg_match('#opera mini#i', $ua)) $title = 'Opera Mini'. $matches[1];
		}
	}elseif (preg_match('#UCWEB/([a-zA-Z0-9.]+)#i', $ua, $matches)) {
		$title = 'UCWEB '. $matches[1];
		$icon = 'ucweb';
        }elseif (preg_match('#UCBrowser/([a-zA-Z0-9.]+) U([0-9])/([a-zA-Z0-9.]+)#i', $ua, $matches)){
                $title = 'UCBrowser '. $matches[1] . ' U' . $matches[2] . ' ' . $matches[3];
                $icon = 'ucbrowser';
        }elseif (preg_match('#UCBrowser/([a-zA-Z0-9.]+)#i', $ua, $matches)){
                $title = 'UCBrowser ' . $matches[1];
                $icon = 'ucbrowser';
        }elseif (preg_match('#MQQBrowser/([a-zA-Z0-9.]+)#i', $ua, $matches)){
                $title = 'QQBrowser '. $matches[1];
                $icon = 'qqbrowser';
        }elseif (preg_match('#LieBaoFast/([a-zA-Z0-9.]+)#i', $ua, $matches)){
                $title = 'LieBaoFast '. $matches[1];
                $icon = 'liebaofast';
        }elseif (preg_match('#Safari/([a-zA-Z0-9.]+)#i', $ua, $matches)) {
		$title = 'Safari '. $matches[1];
		$icon = 'safari';
	}elseif (preg_match('#Opera.(.*)Version[ /]([a-zA-Z0-9.]+)#i', $ua, $matches)) {
		$title = 'Opera '. $matches[2];
		$icon = 'opera';
		if (preg_match('#opera mini#i', $ua)) $title = 'Opera Mini'. $matches[2];		
	}elseif (preg_match('#Maxthon( |\/)([a-zA-Z0-9.]+)#i', $ua,$matches)) {
		$title = 'Maxthon '. $matches[2];
		$icon = 'maxthon';
	}elseif (preg_match('#360([a-zA-Z0-9.]+)#i', $ua, $matches)) {
		$title = '360 Browser '. $matches[1];
		$icon = '360se';
	}elseif (preg_match('#SE 2([a-zA-Z0-9.]+)#i', $ua, $matches)) {
		$title = 'SouGou Browser 2'.$matches[1];
		$icon = 'sogou';
	}elseif(preg_match('#rv:([a-zA-Z0-9.]+)#i', $ua, $matches)) {
                $title = 'Internet Explorer '. $matches[1];
                if ( strpos($matches[1], '11') !== false)
			$icon = 'ie11';
        }
	return array(
		$title,
		$icon
	);
}

function get_os($ua){
	$title = 'unknow';
	$icon = 'unknow';
	if (preg_match('/win/i', $ua)) {
		if (preg_match('/Windows NT 6.1/i', $ua)) {
                        $title = "Windows 7";
			$icon = "windows_win7";
                        if(preg_match('/WOW64/i', $ua)){
                                $title .= ' x64';
                        }
		}elseif (preg_match('/Windows NT 5.1/i', $ua)) {
			$title = "Windows XP";
			$icon = "windows";
		}elseif (preg_match('/Windows NT 6.2/i', $ua)) {
			$title = "Windows 8";
			$icon = "windows_win8";
		}elseif(preg_match('/Windows NT 6.3/i', $ua)){
                        $title = "Windows 8.1";
			$icon = "windows_win8";
                }elseif (preg_match('/Windows NT 6.0/i', $ua)) {
			$title = "Windows Vista/Windows Server 2008";
			$icon = "windows_vista";
		}elseif (preg_match('/Windows NT 5.2/i', $ua)) {
			if (preg_match('/Win64/i', $ua)) {
				$title = "Windows XP 64 bit";
			} else {
				$title = "Windows Server 2003";
			}
			$icon = 'windows';
		}elseif (preg_match('/Windows Phone/i', $ua)) {
			$matches = explode(';',$ua);
			$title = $matches[2];
			$icon = "windows_phone";
		}
	}elseif (preg_match('#iPod.*.CPU.([a-zA-Z0-9.( _)]+)#i', $ua, $matches)) {
		$title = "iPod".$matches[1];
		$icon = "iphone";
	} elseif (preg_match('#iPhone.*.CPU.([a-zA-Z0-9.( _)]+)#i', $ua, $matches)) {
		$title = $matches[1];
		$icon = "iphone";
	} elseif (preg_match('#iPad.*.CPU.([a-zA-Z0-9. _]+)#i', $ua, $matches)) {
		$title = "iPad".$matches[1];
		$icon = "ipad";
	} elseif (preg_match('/Mac OS X.([0-9. _]+)/i', $ua, $matches)) {
		if(count(explode(7,$matches[1]))>1) $matches[1] = 'Lion '.$matches[1];
		elseif(count(explode(8,$matches[1]))>1) $matches[1] = 'Mountain Lion '.$matches[1];
		$title = "Mac OSX ".$matches[1];
		$icon = "macos";
	} elseif (preg_match('/Macintosh/i', $ua)) {
		$title = "Mac OS";
		$icon = "macos";
	} elseif (preg_match('/CrOS/i', $ua)){
		$title = "Google Chrome OS";
		$icon = "chrome";
	}elseif (preg_match('/Linux/i', $ua)) {
		$title = 'Linux';
		$icon = 'linux';
		if (preg_match('/Android.([0-9. _]+)/i',$ua, $matches)) {
			$title= $matches[0];
			$icon = "android";
		}elseif (preg_match('#Ubuntu#i', $ua)) {
			$title = "Ubuntu Linux";
			$icon = "ubuntu";
		}elseif(preg_match('#Debian#i', $ua)) {
			$title = "Debian GNU/Linux";
			$icon = "debian";
		}elseif (preg_match('#Fedora#i', $ua)) {
			$title = "Fedora Linux";
			$icon = "fedora";
		}
	}
	return array(
		$title,
		$icon
	);
}

function get_useragent($ua){
	// 修改此处的图片路径
	$url = Helper::options()->siteUrl . 'usr/themes/meltykiss/images/browsers/';
	$browser = get_browsers($ua);
	$os = get_os($ua);
        echo '<img src="'.$url.$browser[1].'.png" class="fillOpacity" style="border:0px;" alt="'.$browser[0].'"/>'. $browser[0].' / ' . '<img src="'.$url.$os[1].'.png" class="fillOpacity" style="border:0px;" alt="'.$os[0].'"/>' . $os[0]; 
}
function getPermalinkFromCoid($coid) {   
    $db       = Typecho_Db::get();   
    $options  = Typecho_Widget::widget('Widget_Options');   
    $contents = Typecho_Widget::widget('Widget_Abstract_Contents');   
    
    $row = $db->fetchRow($db->select('cid, type, author, text')->from('table.comments')   
              ->where('coid = ? AND status = ?', $coid, 'approved'));   
    
    if (empty($row)) return 'Comment not found!';   
    $cid = $row['cid'];   
    
    $select = $db->select('coid, parent')->from('table.comments')   
              ->where('cid = ? AND status = ?', $cid, 'approved')->order('coid');   
    
    if ($options->commentsShowCommentOnly)   
        $select->where('type = ?', 'comment');   
    
    $comments = $db->fetchAll($select);   
    
    if ($options->commentsOrder == 'DESC')   
        $comments = array_reverse($comments);   
    
    foreach ($comments as $key => $val)   
        $array[$val['coid']] = $val['parent'];   
    
    $i = $coid;   
    while ($i != 0) {   
        $break = $i;   
        $i = $array[$i];   
    }   
    
    $count = 0;   
    foreach ($array as $key => $val) {   
        if ($val == 0) $count++;    
        if ($key == $break) break;    
    }   
    
    $parentContent = $contents->push($db->fetchRow($contents->select()->where('table.contents.cid = ?', $cid)));   
    $permalink = rtrim($parentContent['permalink'], '/');   
    
    $page = ($options->commentsPageBreak)   
          ? '/comment-page-' . ceil($count / $options->commentsPageSize)   
          : ( substr($permalink, -5, 5) == '.html' ? '' : '/' );   
    
    return array(   
        "author" => $row['author'],   
        "text" => $row['text'],   
        "href" => "{$permalink}{$page}#{$row['type']}-{$coid}"
    );   
}      
	
    function threadedComments($comments,$singleCommentOptions) {
            $author = '<a href="'.$comments->url.'" rel="external nofollow" target="_blank">'.$comments->author.'</a>';
        ?>
	<li id="<?php $comments->theId(); ?>">
	<div id="div-comment-<?php $comments->theId(); ?>" class="comment-body">

		<div class="comment-author vcard"><?php $comments->gravatar('40',''); ?>
			<cite class="fn"><?php echo $author; ?></cite>
                        <span class="user-agent"><?php get_useragent($comments->agent);?>  </span>
				<?php  
                    if($comments->parent){   
                        $p_comment = getPermalinkFromCoid($comments->parent);   
                        $p_author = $p_comment['author'];   
                        $p_text = mb_strimwidth(strip_tags($p_comment['text']), 0, 100,"...");   
                        $p_href = $p_comment['href'];   
                        echo "<span>回复</span><a href='$p_href' title='$p_text'>$p_author</a>";   
                    }   
                ?>  
                <!-- END-->  
		</div>
<div class="text">
		<?php $comments->content(); ?>
</div>
		<div class="clear"></div><span class="datetime"><?php $comments->date('Y-m-d H:i:s') ?> </span><span class="reply"><?php $comments->reply('[ 回复 ]') ?></span>
  </div>
  <div class="children">
                <?php if ($comments->children) { ?><?php $comments->threadedComments($singleCommentOptions); ?><?php } ?>
    </div>
	</li>
	

<?php } ?>