<?
require_once '../../../init.php';
error_reporting(0); 
if (ISLOGIN === false) {
	  echo "access deined!";
}else{
    include('upyun_config.php');
    include('upyun.class.php');
    $upyun = new UpYun($bucket, $operator, $opasswd);
    if(!empty($_POST['udsubmit'])){
        $path=$_POST['udfile'];
        $upyun->deleteFile($path);
    };
    try {
        $list = $upyun->getList($sdir);
        function array_sort($arr,$keys,$type='asc'){ 
              $keysvalue = $new_array =$new_array2 = array();
              foreach ($arr as $k=>$v){
                  $keysvalue[$k] = $v[$keys];
              }
              if($type == 'asc'){
                  asort($keysvalue);
              }else{
                  arsort($keysvalue);
              }
              reset($keysvalue);
              foreach ($keysvalue as $k=>$v){
                  $new_array[$k] = $arr[$k];
              }
              foreach ($new_array as $v){
                  array_push($new_array2, $v);
              }
              return $new_array2; 
          } 
      $list = array_sort($list,"time",desc); 
         }
    catch(Exception $e) {
      if($e->getMessage()=="File Not Found"){
          echo "连接成功，但是空间无图片，无法显示";
          return false;
      }
      elseif($e->getCode()=="404"){
        echo "空间还没有图片，请上传图片<br />";
        return false;
      }
      elseif($e->getCode()=="401"){
        echo "空间名，操作员和操作员密码其中填写有误<br />";
        return false;
    }else{
           echo "未知错误，请联系开发者";
           echo '<br/>错误代码'.$e->getCode();
           echo '<br/>错误信息'.$e->getMessage();
           return false;
          }
    }
    ?>
    <script type="text/javascript" src="./jquery-1.7.1.js"></script>
    <script type="text/javascript" src="<?php echo BLOG_URL;?>content/plugins/upyun/upyun.js"></script>
    <link href="<?php echo BLOG_URL;?>content/plugins/upyun/ustyle.css" rel="stylesheet" type="text/css" />
    <div id="ulistmain">
    <?
    for($i=0;$i<12;$i++)
          {
     ?>
              <div id="uimgdiv">	
                  <img src="
                    <?php
                    if (!empty($list[$i]['name'])=="") {
                        echo "./img/u_nothing.jpg";
                        $list[$i]['name']="u_nothing.jpg";
                    }else{
                        echo "http://".$url.$sdir.$list[$i]['name']."!180100";
                    };
                    ?>"  
                  width="180px" height="100px"/>
                  <span id="unavgb"></span>
                  <a id="udelico" value="<?php echo $sdir.$list[$i]['name']?>"><img src="./img/del.png" witdh='25px' height='25px'></a>
              </div>
        <?
          };
        ?>
        <div id="udellay">
        <form action="" method="post">
        <input id="udfile" type="hidden" value="" name="udfile">
        <span id="tips">确定要删除此图片</span>
        <input id="udelsubmit" type="submit" name="udsubmit"/>
        <a class='uabutton' id='udconfirm'><img src="./img/confirm.jpg" ></a><a class='uabutton' id='udcancel'><img src="./img/cancel.jpg" ></a>
        </form>
        </div>
    </div>
<?
};
?>