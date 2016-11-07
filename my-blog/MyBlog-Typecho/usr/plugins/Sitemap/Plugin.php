<?php
/**
 * 为博客生成sitemap文件。
 * 
 * @package     Sitemap 
 * @author      caixw <http://www.caixw.com>
 * @link        http://www.caixw.com
 * @copyright   Copyright (C) 2010, http://www.caixw.com
 */
class Sitemap_Plugin implements Typecho_Plugin_Interface
{
    /**
     * 激活插件方法,如果激活失败,直接抛出异常
     * 
     * @access public
     * @return void
     * @throws Typecho_Plugin_Exception
     */
    public static function activate()
    {
        Typecho_Plugin::factory('Widget_Contents_Post_Edit')->write = array('Sitemap_Plugin', 'generater');
    }
    
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
    public static function config(Typecho_Widget_Helper_Form $form)
    {
        require_once 'InputEx.php';
        $dir = new Typecho_Widget_Helper_Form_Element_Text('dir', null, '/', _t('路径'), _t('Sitemap文件存放的路径，请确保此目录可写！'));
        $createIndex = new Typecho_Widget_Helper_Form_Element_Radio('createIndex', array('1'=>_t('是'), '0'=>_t('否')), 0, _t('建立索引文件'), _t('当您的博客内容比较多时，可以为Sitemap文件建立一个索引文件'));

        $chgfreqList = array(
            'always'        =>'总是',
            'hourly'        =>'每小时',
            'daily'         =>'每天',
            'weekly'        =>'每周',
            'monthly'       =>'每月',
            'yearly'        =>'每年',
            'never'         =>'从不更新'
        );

        $postPriority = new Typecho_Widget_Helper_Form_Element_Number('postPriority', null, '8', _t('文章的优先级'), _t('文章和独立页面的优先级别，值为1-10'));
        $postPriority->setInputAttribute('max', '10');
        $postPriority->setInputAttribute('min', '1');

        $postChgfreq = new Typecho_Widget_Helper_Form_Element_Select('postChgfreq', $chgfreqList, 'never', _t('文章的更新频率'), _t('sitemap文件中每个文章或独立页面的changefreq属性的值。'));

        $metaPriority = new Typecho_Widget_Helper_Form_Element_Number('metaPriority', null, '5', _t('类别和标签的优先级'), _t('类别和标签的优先级别，值为1-10'));
        $metaPriority->setInputAttribute('max', '10');
        $metaPriority->setInputAttribute('min', '1');

        $metaChgfreq = new Typecho_Widget_Helper_Form_Element_Select('metaChgfreq', $chgfreqList, 'daily', _t('类别和标签的更新频率'), _t('sitemap文件中每个类别或标签的changefreq属性的值。'));

        $form->addInput($dir);
        $form->addInput($createIndex);
        $form->addInput($postPriority);
        $form->addInput($postChgfreq);
        $form->addInput($metaPriority);
        $form->addInput($metaChgfreq);
    }
    
    /**
     * 个人用户的配置面板
     * 
     * @access public
     * @param Typecho_Widget_Helper_Form $form
     * @return void
     */
    public static function personalConfig(Typecho_Widget_Helper_Form $form){}


    public static function generater($content)
    {
		$options = Typecho_Widget::widget('Widget_Options');
        $config = $options->plugin('Sitemap');
        $db = Typecho_Db::get();

        require_once 'Sitemap.php';
        $dir = __TYPECHO_ROOT_DIR__ . DIRECTORY_SEPARATOR . $config->dir;

        if(!is_writable($dir))
        {
            @chmod($dir, 0777);
            if(!is_writable($dir))
            {   throw new exception('指定的目录不可写');    }
        }

        $url = $options->siteUrl . '/' . ltrim($config->dir, '/');
        $sm = new Silk_Sitemap($dir, $url, $config->createIndex, 1000, Typecho_Common::url('usr/plugins/Sitemap/sitemap.xsl', $options->siteUrl));



        /* posts */
        $posts = $db->fetchAll($db->select()
            ->from('table.contents')
            ->where('table.contents.status = ?', 'publish')
            ->order('table.contents.created', Typecho_Db::SORT_DESC));
        foreach($posts as $p)
        {
            /** 取出所有分类 */
            $p['categories'] = $db->fetchAll($db
            ->select()->from('table.metas')
            ->join('table.relationships', 'table.relationships.mid = table.metas.mid')
            ->where('table.relationships.cid = ?', $p['cid'])
            ->where('table.metas.type = ?', 'category')
            ->order('table.metas.order', Typecho_Db::SORT_ASC));

            /** 取出第一个分类作为slug条件 */
            $p['category'] = current(Typecho_Common::arrayFlatten($p['categories'], 'slug'));

            $p['date'] = new Typecho_Date($p['created']);

            /** 生成日期 */
            $p['year'] = $p['date']->year;
            $p['month'] = $p['date']->month;
            $p['day'] = $p['date']->day;

			$type = $p['type'];
            $routeExists = (NULL != Typecho_Router::get($type));
            $pathinfo = $routeExists ? Typecho_Router::url($type, $p) : '#';
            $permalink = Typecho_Common::url($pathinfo, $options->index);
            $priority = $config->postPriority / 10;
            $sm->add($permalink, $config->postChgfreq, $priority, $p['modified']);
		}

        /* metas */
        $metas = $db->fetchAll($db->select()
            ->from('table.metas')
            ->order('table.metas.order', Typecho_Db::SORT_DESC));
        foreach($metas as $m)
        {
            $type = $m['type'];
            $routeExists = (NULL != Typecho_Router::get($type));
            //$m['slug'] = urlencode($m['slug']); // 需要吗？。
            $permalink = $routeExists ? Typecho_Router::url($type, $m, $options->index) : '#';

            $priority = $config->metaPriority / 10;
            $sm->add($permalink, $config->metaChgfreq, $priority, time());
        }


        $sm->save();

        return $content;
    }

}


