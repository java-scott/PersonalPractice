<?php
/**
 * Typecho 侧栏工具箱
 * 
 * @package Typecho Kit
 * @author 冰剑
 * @version 1.1.0
 * @link http://www.binjoo.net
 */
class TeKit_Plugin implements Typecho_Plugin_Interface
{
    /**
     * 激活插件方法,如果激活失败,直接抛出异常
     * 
     * @access public
     * @return void
     * @throws Typecho_Plugin_Exception
     */
    public static function activate() {}

    /**
     * 禁用插件方法,如果禁用失败,直接抛出异常
     * 
     * @static
     * @access public
     * @return void
     * @throws Typecho_Plugin_Exception
     */
    public static function deactivate(){}
    
    /**
     * 获取插件配置面板
     * 
     * @access public
     * @param Typecho_Widget_Helper_Form $form 配置面板
     * @return void
     */
    public static function config(Typecho_Widget_Helper_Form $form){
    }
    
    /**
     * 个人用户的配置面板
     * 
     * @access public
     * @param Typecho_Widget_Helper_Form $form
     * @return void
     */
    public static function personalConfig(Typecho_Widget_Helper_Form $form){}
    
    /**
     * 字符串参数转化为数组形式
     *
     * $args 字符串参数
     * $defaults 默认数组
     */
    public static function te_parse_args($args, $defaults)
    {
        parse_str($args, $args);//把字符串参数转换成数组
        if(is_array($defaults)){
            return array_merge($defaults, $args);//将args中的键值覆盖到defaults
        }
        return $defaults;
    }
    /**
     * 随机日志

     * {permalink} 地址
     * {title} 标题

     */
    public static function tekit_random_posts($args=null)
    {
        $defaults = array(
            'number' => 10,
            'before' => '<ul>',
            'after' => '</ul>',
            'xformat' => '<li><a href="{permalink}">{title}</a></li>'
        );
        if($args != null){
            $defaults = self::te_parse_args($args, $defaults);
        }

        $db = Typecho_Db::get();

        $sql = $db->select()->from('table.contents')
            ->where('status = ?','publish')
            ->limit($defaults['number'])
            ->order('RAND()');
        
        $result = $db->fetchAll($sql);
        echo $defaults['before'];
        foreach($result as $val){
			$val = Typecho_Widget::widget('Widget_Abstract_Contents')->filter($val);
            echo str_replace(array('{permalink}', '{title}'),array($val['permalink'], $val['title']), $defaults['xformat']);
        }
        echo $defaults['after'];
    }
    
    /**
     * N天内评论最多的日志

     * {permalink} 地址
     * {title} 标题
     * {commentsNum} 评论数量

     */
    public static function tekit_most_commented_posts($args=null)
    {
        $defaults = array(
            'days' => 30,
            'number' => 10,
            'before' => '<ul>',
            'after' => '</ul>',
            'xformat' => '<li><a href="{permalink}">[{commentsNum}]{title}</a></li>'
        );
        if($args != null){
            $defaults = self::te_parse_args($args, $defaults);
        }

        $time = time() - (24 * 60 * 60 * $defaults['days']);
        $db = Typecho_Db::get();

        $sql = $db->select()->from('table.contents')
            ->where('created >= ?', $time)
            ->limit($defaults['number'])
            ->order('commentsNum',Typecho_Db::SORT_DESC);
        $result = $db->fetchAll($sql);
        echo $defaults['before'];
        foreach($result as $val){
			$val = Typecho_Widget::widget('Widget_Abstract_Contents')->filter($val);
            echo str_replace(array('{permalink}', '{title}', '{commentsNum}'), array($val['permalink'], $val['title'], $val['commentsNum']), $defaults['xformat']);
        }
        echo $defaults['after'];
    }

    /**
     * N天内评论最多的访客
     * 
     * @access public
     * @return void

     * {permalink} 地址
     */
    public static function tekit_most_active_commentors($args=null)
    {
        $defaults = array(
            'days' => 30,
            'number' => 10,
            'ignore' => true,
            'before' => '<ul>',
            'after' => '</ul>',
            'xformat' => '<li><a href="{url}">[{cnt}]{author}({mail})</a></li>'
        );
        if($args != null){
            $defaults = self::te_parse_args($args, $defaults);
        }

        $time = time() - (24 * 60 * 60 * $defaults['days']);
        $db = Typecho_Db::get();
        $sql = $db->select('author, mail, url, count(author) as cnt')->from('table.comments')
            ->where('status = ?','approved')
            ->where('created >= ?', $time)
            ->group('author')
            ->limit($defaults['number'])
            ->order('cnt',Typecho_Db::SORT_DESC);
        if($defaults['ignore'] == true){
            $sql->where('ownerId <> authorId');
        }
        $result = $db->fetchAll($sql);
        echo $defaults['before'];
        foreach($result as $val){
            echo str_replace(array('{url}', '{author}', '{cnt}', '{mail}'), array($val['url'], $val['author'], $val['cnt'], $val['mail']), $defaults['xformat']);
        }
        echo $defaults['after'];
    }

    /**
     * N天内坐沙发最多的访客
     * 
     * @access public
     * @return void

     * {permalink} 地址
     */
    public static function tekit_most_sofa_commentors($args=null)
    {
        $defaults = array(
            'days' => -1,
            'number' => 10,
            'before' => '<ul>',
            'after' => '</ul>',
            'xformat' => '<li><a href="{url}">[{cnt}]{author}({mail})</a></li>'
        );
        if($args != null){
            $defaults = self::te_parse_args($args, $defaults);
        }

        $time = time() - (24 * 60 * 60 * $defaults['days']);
        $db = Typecho_Db::get();
        $sql = "select author, url, mail, count(*) as cnt from (SELECT author, url, mail, min(a.created) FROM typecho_comments a, typecho_contents b WHERE b.status = 'publish' and b.type = 'post' and b.commentsNum <> 0 ";
        if($defaults['days'] != -1){
            $sql = $sql."and a.created >= '".$time."' ";
        }
        $sql = $sql."and a.cid = b.cid group by a.cid) c group by c.author order by cnt desc limit ".$defaults['number'];

        $result = $db->fetchAll($sql);
        echo $defaults['before'];
        foreach($result as $val){
            echo str_replace(array('{url}', '{author}', '{cnt}', '{mail}'), array($val['url'], $val['author'], $val['cnt'], $val['mail']), $defaults['xformat']);
        }
        echo $defaults['after'];
    }

    /**
     * 获得最近30天的评论总数
     * 
     * @access public
     * @return void

     * {permalink} 地址
     */
    public static function tekit_comments_num($email = "")
    {
        if(empty($author) || empty($email)) return 0;
        $time = time() - (24 * 60 * 60 * 30);
        $db = Typecho_Db::get();
        $sql = $db->select('COUNT(mail) as emailnum')->from('table.comments')
            ->where('status = ?','approved')
            ->where('mail = ?',$email)
            ->where('created > ?',$time);
        $result = $db->fetchAll($sql);
        print_r($result[0]['emailnum']);
    }
}
