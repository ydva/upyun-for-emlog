<?php
/*
Plugin Name: 又拍云插件
Version: 3.1.0
Plugin URL:http://www.xuejiajun.net/post-399.html
Description: 把图片保存到又拍云存储.
ForEmlog:5.0.0到6.0.0
Author: ydva
Author URL: http://www.xuejiajun.net
*/
!defined('EMLOG_ROOT') && exit('access deined!');
function upyun_menu(){
echo '<div class="sidebarsubmenu"><a href="./plugin.php?plugin=upyun">又拍云设置</a></div>';
}
addAction('adm_sidebar_ext', 'upyun_menu');
function save_key(){
  include(EMLOG_ROOT.'/content/plugins/upyun/upyun_config.php');
  switch ($format) {
    case 'time':
      return '{year}{mon}{day}{hour}{min}{sec}{.suffix}';
      break;
    case 'filename':
      return '{filename}{.suffix}';
      break;
    case 'md5':
      return '{filemd5}{.suffix}';
      break;
    case 'random':
      return '{random32}{.suffix}';
      break;
    default:
      return '{year}{mon}{day}{hour}{min}{sec}{.suffix}';
      break;
  }
}
function upyun_from(){
    include('upyun_config.php');
    $options = array();
    $options['bucket'] = $bucket; /// 空间名
    $options['expiration'] = time()+600; /// 授权过期时间
    $options['save-key'] = $sdir.save_key(); /// 文件名生成格式，请参阅 API 文档
    $options['allow-file-type'] = 'jpg,jpeg,gif,png'; /// 控制文件上传的类型，可选
    $options['return-url'] = BLOG_URL.'content/plugins/upyun/upyun_return.php'; /// 页面跳转型回调地址
    $policy = base64_encode(json_encode($options));
    $sign = md5($policy.'&'.$apikey); /// 表单 API 功能的密匙（请访问又拍云管理后台的空间管理页面获取）
    ?>
    <link href="<?php echo BLOG_URL;?>content/plugins/upyun/ustyle.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="<?php echo BLOG_URL;?>content/plugins/upyun/upyun.js"></script>
    <?php 
      if(substr(Option::EMLOG_VERSION,0,1)=='5'){
        echo '<div id="ubglay"></div>';
      }
    ?>
    <div id="uuploaddiv"> 
    <h2>又拍云上传<a href="#" class="uclose">关闭</a></h2> 
    <p id='utips'>请选择图片</p>
    <form action="http://v0.api.upyun.com/<?php echo $bucket?>/" method="post" enctype="Multipart/form-data" target="tarframe" class="uform">
      <input type="hidden" name="policy" value="<?php echo $policy?>">
      <input type="hidden" name="signature" value="<?php echo $sign?>">
      <input id='ufile' type="file" name="file">
      <input type="submit" id="usubmit"/> 
    </form> 
    <div id="uschedulebg"><div id="uschedule"></div><span id="uschedulenum">0</span></div><br />
    <iframe src=""  width="0" height="0" style="display: none;" name="tarframe"></iframe>
    <div>
      <a style='' class='ubuttona' id='uselect' >选 择</a><a style='' class='ubuttona' id='uupload' >上 传</a>
    </div>
    <br>
    </div>
<?
}
addAction('adm_footer', 'upyun_from');
function upyun_button() {
  echo "<span  class=\"ushowadvset\" id=\"upyun\">又拍云上传</span>";
}
addAction('adm_writelog_head', 'upyun_button');
