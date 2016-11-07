UpyunFile
=========

又拍云文件管理插件Typecho版

####插件简介：

  基于Typecho 0.9原上传接口开发，继承原上传所有（上传、修改和删除）功能，有效分流网站流量，减轻系统负载。([更多...](http://pengzhiyong.com/blog/192.html "UpyunFile详情介绍"))
  
####插件功能：

  1. 上传、修改和删除功能（基于原上传功能）；
  2. CDN内容分发功能，承接又拍云强大的CDN内容分发；
  3. 绑定域名后，享受特有的文件URL路径，加快静态文件加载速度。

####使用方法：

  1. 下载此插件，上传至网站的/usr/plugins/目录下；
  2. 启用该插件，填写好Upyun空间信息，保存即可。

####注意事项：

  1. 本插件功能仅在启用并正确设置插件后才有效，在Typecho 0.9下测试完全正常，其它Typecho版本暂未测试；
  2. 未使用本插件之前所上传之文件，启用本插件后仍按照原URL路径
  3. 本插件文件在Upyun空间生成目录结构有两种模式：Typecho原生态目录结构(形如/usr/uploads/年/月/文件名)和精简模式(/年/月/文件名)，使用者可根据需要选择其中一种模式，文件URL路径为：绑定域名+目录结构。
  4. 禁用该插件后，因Typecho仍然保存Upyun文件路径，为保证您的网站正常浏览，请不要变更Upyun空间名及绑定域名，或者搬移至其它空间，但仍然使用当前的文件目录结构。
  5. 本插件为用户免费自由使用，作者力求插件功能完善，但对使用者涉及的文件内容不承担任何责任。

####更新记录：

**2014-01-19：**添加目录结构模式，使用者可根据需要选择喜好的模式。

####联系作者：

  1. 作者：codesee 
  2. 网址：<http://pengzhiyong.com>
  3. 邮箱：codesee(###)gmail.com