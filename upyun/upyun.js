var timeId;
function stopSend(str,picwidth){
    var srcimg=str;
    editorMap['content'].insertHtml('<a href="'+srcimg+'" target="_blank"><img src="'+srcimg+'" title="点击查看原图" style="max-width:'+picwidth+'" /></a>');
    clearInterval(timeId);
    $('#uschedule').css("width","373px");
    $('#uschedulenum').text("图片上传100%");
    $("#ubglay").css("display","none"); 
    $("#uuploaddiv").css("display","none"); 
    clearInterval(timeId);
    $('#uschedule').css("width","0px");
    $('#uschedulenum').text("图片上传0%")
    $('#uschedulebg').hide();
    $('#utips').text('请选择图片');
    $('#ufile').val('');
};
function uError(str){
    alert(str)
    clearInterval(timeId);
    $('#uschedulebg').hide();
};
$(function(){ 
    // upyun.php
    $("#upyun").click(function(){ 
        $("#ubglay").show();
        $("#uuploaddiv").show();
    }); 
    $(".uclose").click(function(){ 
        $("#ubglay").css("display","none"); 
        $("#uuploaddiv").css("display","none"); 
        clearInterval(timeId);
        $('#uschedule').css("width","0px");
        $('#uschedulenum').text("图片上传0%")
        $('#uschedulebg').hide();
        $('#utips').text('请选择图片');
        $('#ufile').val('');
    }); 
    $('#usubmit').click(function(){
        if($('#ufile').val()==''){
          alert('还没选图片呢');
          exit();
        }
        $('#uschedulebg').show();
        $('#uschedule').css("width","0px");
        $('#uschedulenum').text("0%")
        clearInterval(timeId);
        var uschedulenum=0;
        timeId = setInterval(function(){
        uschedulenum +=4;
        $('#uschedule').css({
                'width':'+=4px'
                     });
        var zuschedulenum = 100/400*uschedulenum;
        $('#uschedulenum').text('图片上传'+zuschedulenum+"%");
        if ($('#uschedule').css('width') == '360px')
             {
           clearInterval(timeId);
              };
    },100);
    });
    $('#uselect').click(function(){
      $('#ufile').click();
    });
    $('#ufile').change(function(){
      $('#utips').text($('#ufile').val());
    });
    $('#uupload').click(function(){
      $('#usubmit').click();
    });

  //upyun_getlist.php
  var index;
  re=/u_nothing.jpg$/;
  $('#udelico').live("click", function(){
     var gval=$(this).attr('value');
     $('#udfile').attr({'value':gval});
     index = $(this).parent();
     if(re.test(gval)){
        alert('空图片，不可删除')}
      else{
         $('#udellay').show();
         }
  }); 
  $('#udconfirm').click(function(){
      $('#udelsubmit').click();
  });
  $('#udcancel').click(function(){
    $('#udellay').hide();
  });
  $("#udelsubmit").click(function(){
    $(index).hide();
  $('#udellay').hide();
  });
  $('#ulistmain div:not(#udellay)').live('mouseover',function(){ 
      var index = $(this).index();
      $('#uimgdiv a').eq(index).show();
      $('#uimgdiv span').eq(index).show();
      }).live('mouseout',function(){ 
          var index = $(this).index();
          $('#uimgdiv a').eq(index).hide();
          $('#uimgdiv span').eq(index).hide();
  });
});

 



