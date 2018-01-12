$(function(){
    // ページ読み込み時に実行したい処理
    window.onload = function(){
        $("#search_btn").trigger('click');
    };

    //読み込んだクッキーをフォームのvalue値として代入  
    if($.cookie("year") !== null)$('#year').val($.cookie("yaer"));  
    if($.cookie("studentcd") !== null)$('#studentcd').val($.cookie("studentcd"));  
    if($.cookie("name") !== null)$('#name').val($.cookie("name"));   
    if($.cookie("grade") !== null)$('#grade').val($.cookie("grade")); 
    if($.cookie("subjectcd") !== null)$('#subjectcd').val($.cookie("subjectcd")); 
    if($.cookie("cls") !== null)$('#cls').val($.cookie("cls")); 
     
    $('.enter_btn').keypress(function(e){
        if(e.which === 13){
            $("#search_btn").trigger('click');
        }
    });
    // 検索結果
    $('#search_btn').on('click',function(){

        var year = $('#year').val();
        var studentcd = $('#studentcd').val();
        var name = $('#name').val();
        var grade = $('#grade').val();
        var subjectcd = $('#subjectcd').val();
        var cls = $('#cls').val();
        
        // 3分
        date = new Date();
        date.setTime( date.getTime() + ( 3 * 60 * 1000 ));

        //クリックを押したら、クッキーを保存
        $.cookie("year",$('#year').val(),{ expires: date });  
        $.cookie("studentcd",$('#studentcd').val(),{ expires: date });  
        $.cookie("name",$('#name').val(),{ expires: date });  
        $.cookie("grade",$('#grade').val(),{ expires: date });  
        $.cookie("subjectcd",$('#subjectcd').val(),{ expires: date }); 
        $.cookie("cls",$('#cls').val(),{ expires: date }); 

        //POST
        $.ajax({
            type: 'POST',
            url: 'result.php',
        data:{
            year:year,
            studentcd:studentcd,
            name:name,
            grade:grade,
            subjectcd:subjectcd,
            cls:cls
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
    
    //編集中判定
    var flg = 0;
    $(document).on('click','.edit_btn', function() {
        //  trのID取得
        var index = $(this).parent().parent().attr('id');
        
        //  teachercdのクラスを取得 -------------------------------------------------------------------!!!!
        var student = $('tr#' + index).find('td').eq(2).attr('class');

        if(flg === 0){
        //  未編集中   
            $(this).val('編集中');
            
            $(this).css('backgroundColor','red');
            
        //  input内を編集できるようにする
            $('tr#' + index).find(":text").removeAttr("disabled");

            flg = 1;

            //編集中か判定
        }else if($('tr#' + index).find('td.edit').find('input').val() === '編集中' && flg === 1){ 
            
            if(!confirm('編集しますか？')){
                /* キャンセルの時の処理 */
                if(!confirm('編集をキャンセルしますか？')){
                    /* キャンセルの時の処理 */
                    return false;
                }else{
                    // 更新
                    location.reload(); 
                }
            }else{
                /*　OKの時の処理 */
                alert('編集完了しました');
                $(this).val('編集');
                $(this).css('backgroundColor','#668ad8');

//                    trのIDを取得
                var index = $(this).parent().parent().attr('id');

                //  input内のvalを取得 
                var pass = $('tr#' + index).find('td.pass').find('input').val();
                var name = $('tr#' + index).find('td.name').find('input').val();
                var kana = $('tr#' + index).find('td.kana').find('input').val();

                $.ajax({
                    type: 'POST',
                    url: 'edit.php',
                data:{
                    pass:pass,
                    name:name,
                    kana:kana,
                    student:student


                },
                    dataType: 'html'    
                }).done(function(data, status, jqXHR){
                    //inputを無効にする
                    $('tr#' + index).find(":text").attr("disabled","disabled");
                    flg = 0;

                    // 更新
                    location.reload();

                    //  成功log
                    console.log("成功");

                }).fail(function(jqXHR, status, error){
                    console.log("error!!");
                }).always(function(jqXHR, status){
//                    console.log(status);
                });
            }
        }
    });
});