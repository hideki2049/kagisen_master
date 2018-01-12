$(function(){
         
    $('.enter_btn').keypress(function(e){
        if(e.which === 13){
            $("#search_btn").trigger('click');
        }
    });
    // 検索結果
    $('#search_btn').on('click',function(){
        var year = $('#year').val();
        var semester = $('#semester').val();
        var t_name = $('#t_name').val();
        var s_name = $('#s_name').val();
        var questnum = $('#questnum').val();
        var time = $('#time').val();

        var test = year+semester+t_name+s_name+questnum+time;
        console.log(test);
        //POST
        $.ajax({
            type: 'POST',
            url: 'result.php',
        data:{
            year:year,
            semester:semester,
            t_name:t_name,
            s_name:s_name,
            questnum:questnum,
            time:time
            
        },
            dataType: 'html'
        }).done(function(data, status, jqXHR){
            $(".hoge").html(data);
            var len = $(".table_student tbody").children().length;
            if(len !== 0){
                
                var text = "検索結果: " + len + "件";
                $("#tbl_len").html('<center><text>' + text + '</text></center>');
            }else{
                var text = "検索結果: 該当なし";
                $("#tbl_len").html('<center><text>' + text + '</text></center>');      
                $(".hoge").html('');
            }   
            $("#tbl_len").css('color','red');
            $("#tbl_len").css('fontSize','30px');
//            console.log(text);
        }).fail(function(jqXHR, status, error){
            console.log("error!!");
        }).always(function(jqXHR, status){
//            console.log(status);
        });
    });
    

});
