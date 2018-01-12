$(function(){
    $('#pass_edit').on('click',function(){
        $('#log').html();
        var userid = $('.event_notice #userid').text();
                
        var old_pass = $('#old_password').val();
        var new_pass = $('#new_password').val();
        var new2_pass = $('#new2_password').val();
        var str = old_pass.length;
        if(old_pass !== null && str !== 0){
            $.ajax({
                type: 'POST',
                url: 'old_pass_check.php',
            data:{
                old_pass:old_pass,
                userid:userid,


            },
                dataType: 'html'
            }).done(function(data, status, jqXHR){
                $('#log').html(data);
            }).fail(function(jqXHR, status, error){
                $('#log').html("error");
            }).always(function(jqXHR, status){
    //            console.log(status);
            });
            
            
        

//            console.log(userid);
//            if(new_pass === new2_pass && new_pass !== null ){
//    //            console.log(new2_pass);
//                        //POST
//                $.ajax({
//                    type: 'POST',
//                    url: 'result.php',
//                data:{
//                    old_pass:old_pass,
//                    new_pass:new_pass,
//                    new2_pass:new2_pass,
//                    userid:userid
//
//                },
//                    dataType: 'html'
//                }).done(function(data, status, jqXHR){
//                    $('#log').html(data);
//                }).fail(function(jqXHR, status, error){
//                    console.log("error!!");
//                }).always(function(jqXHR, status){
//        //            console.log(status);
//                });
//            }
        }else{
            var text = "旧パスワードまたは、新パスワードを入力してください";
            $('#log').html("<center><text>" + text + "</text></center>");
            $('#log').css('color','red');
        }
    
    });
});