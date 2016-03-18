//文件插入共用
function ifimg(els){
     for(var el in els){
         var iframe = '<iframe src="img.html?id='+ els[el][0] + '&dir='+els[el][1]+'" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe>';
         document.getElementById(els[el][0]).innerHTML = iframe;
     }
 }

//表单提交
function create_this(o){
    var formData = $(o).serialize();
    layer.msg('正在提交至服务器');
    $.ajax({
        type: 'POST',
        url: 'ajax.php',
        processData:true,
        data:formData,
        success: function(res){
            if(parseInt(res)>0){
            	layer.msg('已提交成功！');
                //window.location.href = window.location.href;
            }else{
            	layer.msg('提交失败，通讯异常!');
            }
        }
    });
}