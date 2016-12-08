<?php
!defined('EMLOG_ROOT') && exit('access deined!');
function plugin_setting_view()
		{
		include(EMLOG_ROOT.'/content/plugins/upyun/upyun_config.php');
		?>
		<div class="containertitle"><b>又拍云设置</b><?php if(isset($_GET['setting'])):?><span class="actived">设置成功</span><?php endif;?></div>
		<div class=line></div>
		<form action="./plugin.php?plugin=upyun&action=setting" method="POST">
		<p>空间域名(必填):&nbsp;<input style="margin-left:7px;" type="text" name="url" value="<?php echo $url ;?>" /> 例如：xxxx.b0.upaiyun.com</p>
		<p>空间名(必填)：&nbsp;&nbsp;<input style="margin-left:7px;" type="text" name="bucket" value="<?php echo $bucket;?>" /></p> 
		<p>API密钥(必填)：<input style="margin-left:7px;" type="password" name="apikey" value="<?php echo $apikey; ?>" /></p>
		<p>操作员(选填):&nbsp;&nbsp;&nbsp;&nbsp;<input style="margin-left:7px;" type="text" name="operator" value="<?php echo $operator;?>" />&nbsp;&nbsp;操作员密码(选填):<input style="margin-left:7px;" type="password" name="opasswd" value="<?php echo $opasswd;?>" /></p> 
		<p>图片宽度(选填):&nbsp;<input style="margin-left:7px;" class="jud" type="text" name="picwidth" value="<?php if($picwidth==""){echo "580px";}else{echo $picwidth;};?>" />&nbsp;&nbsp;保存目录(选填):&nbsp;&nbsp;&nbsp;<input style="margin-left:7px;" class="jud" type="text" name="sdir" value="<?php if($sdir==""){echo "/emlog/";}else{echo $sdir;};?>" /> </p>
		<p>文件命名格式(选填):
		<label><input name="format" type="radio" value="time" <?php if($format=='time' ||$format==''){echo 'checked';} ?>/>时间类</label> 
		<label><input name="format" type="radio" value="filename" <?php if($format=='filename'){echo 'checked';} ?>/>文件名</label> 
		<label><input name="format" type="radio" value="md5" <?php if($format=='md5'){echo 'checked';} ?>/>文件md5</label>
		<label><input name="format" type="radio" value="random" <?php if($format=='random'){echo 'checked';} ?>/>随机</label>
		</p>
		<p><input id="ysubmit" type="submit" value="保存设置" style="padding:5px;font-size:10px;"/></p>
        </form>
		<br/>
		<div class="containertitle"><b>使用说明</b></div>
		<div class=line></div>
		<br/>又拍云：<br>
		申请账号---创建空间---开启表单功能（api）---自定义版本,创建缩略图版本
		<br/>（版本名称：180100；缩略方式：固定高度和宽度；限定尺寸：180px&nbsp;&nbsp;&nbsp;&nbsp;x&nbsp;&nbsp;&nbsp;&nbsp;100px）
		<br/>后台: <br>
		后台下载开启插件---填入空间域名,空间名,api
		<br/><a href="http://www.xuejiajun.net/post-399.html" target="_blank">图文说明</a>
		<br/><br/>
		<div class="containertitle"><b>图片管理</b></div>
		<div class=line></div>
		<?php
		    if(!$operator=='' || !$opasswd=='')
		       {
		?>
			   <div style="width:782px;height:302px;border:1px solid #abcdef;">
			   <iframe src="<?echo BLOG_URL;?>content/plugins/upyun/upyun_getlist.php" width="780px" height="300px" scrolling="no"></iframe>
			   </div><br /><br />
		<?php
		        }
		}
function plugin_setting(){
		$newConfig = '<?php
		$url ="'.$_POST["url"].'";
		$bucket ="'.$_POST["bucket"].'";
		$apikey ="'.$_POST["apikey"].'";
		$operator ="'.$_POST["operator"].'";
		$opasswd ="'.$_POST["opasswd"].'";
		$picwidth ="'.$_POST["picwidth"].'";
		$sdir ="'.$_POST["sdir"].'";
		$format ="'.$_POST["format"].'";
		?>
		';
		@file_put_contents(EMLOG_ROOT.'/content/plugins/upyun/upyun_config.php', $newConfig);
}
?>
