<?php
/**
 * Copy Right
 * 
 * @package TECopyright 
 * @author arest
 * @version 1.0.2
 * @link http://www.blog.kgsoft.cn
 */
class TECopyright_Plugin implements Typecho_Plugin_Interface
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
        Typecho_Plugin::factory('Widget_Abstract_Contents')->contentEx = array('TECopyright_Plugin', 'add');
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
        /** 版权名称 */
        $tips = "自动添加到文章末尾的版权小尾巴<br/>";
        $tips .= "替换规则:<br/>";
        $tips .= "{%post_url} -> 文章链接<br/>";
        $tips .= "{%title} -> 文章标题<br/>";
        $tips .= "{%author} -> 文章作者<br/>";
        $tips .= "{%site} -> 网站链接<br/>";
        $name = new Typecho_Widget_Helper_Form_Element_Text('crname', NULL, _t("转载请注明出处({%post_url})<br/>来源网站:{%site}"), _t($tips));
        $form->addInput($name);
        $rdShowOnPage = new Typecho_Widget_Helper_Form_Element_Checkbox("supportPage", array(1=>_t('是否在独立页面上添加小尾巴')), NULL, NULL, _t("是否在用户自定义页面中文章的末尾添加小尾巴"));
        $form->addInput($rdShowOnPage);
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
     * 插件实现方法
     * 
     * @access public
     * @return void
     */
    public static function add($content, $widget, $lastResult)
    {
    	$content = empty($lastResult)?$content:$lastResult;
        $supportPage = Typecho_Widget::widget('Widget_Options')->plugin('TECopyright')->supportPage;
        //echo $widget->is('single');
        //echo $widget->parameter->type;
        if (! $widget->is('single')) {
            return $content;
        } else if ($widget->parameter->type == "page") {
            if ($supportPage) {
                return self::_addTail($content, $widget);
            } else {
                return $content;
            }
        } else {
            return self::_addTail($content, $widget);
        }
    }

    private static function _addTail($content, $widget) {
        $url = $widget->permalink;
        $wOptions = Typecho_Widget::widget('Widget_Options');
        $siteUrl = $wOptions->siteUrl;
        $sitename = "<a href='$siteUrl'>".$wOptions->title."</a>";
        $articleName = $widget->title;
        $articleAuthor = $widget->author->screenName;
        $url = "<a href='${url}'>${url}</a>";
        $text = $wOptions->plugin('TECopyright')->crname;
        $text = str_replace("{%post_url}", $url, $text);
        $text = str_replace("{%title}", $articleName, $text);
        $text = str_replace("{%author}", $articleAuthor, $text);
        $text = str_replace("{%site}", $sitename, $text);
        return $content."<br><b>".$text."</b>";
    }
}
