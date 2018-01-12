(function (){
document.addEventListener('DOMContentLoaded',function () {


var select0 = document.getElementById('select0');
var select1 = document.getElementById('select1');
var select2 = document.getElementById('select2');
var select3 = document.getElementById('select3');
var select4 = document.getElementById('select4');
var select5 = document.getElementById('select5');


select0.addEventListener('change',function(event){
  //console.log(event.target.value);
  var req = new XMLHttpRequest();
  req.open('POST', 'select_logic0.php', true);
  req.setRequestHeader('content-type','application/x-www-form-urlencoded;charset=UTF-8');
  var sendData = "year="+ encodeURIComponent(event.target.value);
  sendData += "&teachercd="+ encodeURIComponent(select0.value);
  sendData += "&semester="+ encodeURIComponent(select2.value);
  sendData += "&subjectcd="+ encodeURIComponent(select3.value);
  sendData += "&grade="+ encodeURIComponent(select4.value);
  sendData += "&cls="+ encodeURIComponent(select5.value);
  req.send(sendData);

  req.onreadystatechange = function(){
    if(req.readyState == 4){
      if(req.status == 200){
        console.log(req.responseText);
        var data = JSON.parse(req.responseText);
        // console.log(data["semester"]);
        // console.log(data["semester"][0]);


        //select1
        for(var i = select1.length; i >= 0 ; i--){
             select1.remove(i);
        }
        var i=0;
        while(i<data["year"].length){
          select1.add(new Option(data["year"][i],data["year"][i]));
          i++;
        }
        //select2
        for(var i = select2.length; i >= 0 ; i--){
             select2.remove(i);
        }
        var i=0;
        while(i<data["semester"].length){
          select2.add(new Option(data["semester"][i],data["semester"][i]));
          i++;
        }
        //select3
        for(var i = select3.length; i >= 0 ; i--){
             select3.remove(i);
        }
        i=0;
        while(i<data["subjectcd"].length){
          select3.add(new Option(data["subjectcd"][i],data["subjectcd"][i]));
          i++;
        }
        //select4
        for(var i = select4.length; i >= 0 ; i--){
             select4.remove(i);
        }
        i=0;
        while(i<data["grade"].length){
          select4.add(new Option(data["grade"][i],data["grade"][i]));
          i++;
        }
        //select5
        for(var i = select5.length; i >= 0 ; i--){
             select5.remove(i);
        }
        i=0;
        while(i<data["cls"].length){
          select5.add(new Option(data["cls"][i],data["cls"][i]));
          i++;
        }

      }
    }
  }

});

select1.addEventListener('change',function(event){
  //console.log(event.target.value);

  var req = new XMLHttpRequest();
  req.open('POST', 'select_logic.php', true);
  req.setRequestHeader('content-type','application/x-www-form-urlencoded;charset=UTF-8');
  var sendData = "year="+ encodeURIComponent(event.target.value);
  sendData += "&teachercd="+ encodeURIComponent(select0.value);
  sendData += "&semester="+ encodeURIComponent(select2.value);
  sendData += "&subjectcd="+ encodeURIComponent(select3.value);
  sendData += "&grade="+ encodeURIComponent(select4.value);
  sendData += "&cls="+ encodeURIComponent(select5.value);
  req.send(sendData);

  req.onreadystatechange = function(){
    if(req.readyState == 4){
      if(req.status == 200){
        console.log(req.responseText);
        var data = JSON.parse(req.responseText);
        // console.log(data["semester"]);
        // console.log(data["semester"][0]);

        //select2
        for(var i = select2.length; i >= 0 ; i--){
             select2.remove(i);
        }
        var i=0;
        while(i<data["semester"].length){
          select2.add(new Option(data["semester"][i],data["semester"][i]));
          i++;
        }
        //select3
        for(var i = select3.length; i >= 0 ; i--){
             select3.remove(i);
        }
        i=0;
        while(i<data["subjectcd"].length){
          select3.add(new Option(data["subjectcd"][i],data["subjectcd"][i]));
          i++;
        }
        //select4
        for(var i = select4.length; i >= 0 ; i--){
             select4.remove(i);
        }
        i=0;
        while(i<data["grade"].length){
          select4.add(new Option(data["grade"][i],data["grade"][i]));
          i++;
        }
        //select5
        for(var i = select5.length; i >= 0 ; i--){
             select5.remove(i);
        }
        i=0;
        while(i<data["cls"].length){
          select5.add(new Option(data["cls"][i],data["cls"][i]));
          i++;
        }

      }
    }
  }
});




select2.addEventListener('change',function(event){
  //console.log(event.target.value);

  var req = new XMLHttpRequest();
  req.open('POST', 'select_logic2.php', true);
  req.setRequestHeader('content-type','application/x-www-form-urlencoded;charset=UTF-8');
  var sendData = "year="+ encodeURIComponent(select1.value);
  sendData += "&teachercd="+ encodeURIComponent(select0.value);
  sendData += "&semester="+ encodeURIComponent(select2.value);
  sendData += "&subjectcd="+ encodeURIComponent(select3.value);
  sendData += "&grade="+ encodeURIComponent(select4.value);
  sendData += "&cls="+ encodeURIComponent(select5.value);
  req.send(sendData);

  req.onreadystatechange = function(){
    if(req.readyState == 4){
      if(req.status == 200){
        console.log(req.responseText);
        var data = JSON.parse(req.responseText);
        //select3
        for(var i = select3.length; i >= 0 ; i--){
             select3.remove(i);
        }
        i=0;
        while(i<data["subjectcd"].length){
          select3.add(new Option(data["subjectcd"][i],data["subjectcd"][i]));
          i++;
        }
        //select4
        for(var i = select4.length; i >= 0 ; i--){
             select4.remove(i);
        }
        i=0;
        while(i<data["grade"].length){
          select4.add(new Option(data["grade"][i],data["grade"][i]));
          i++;
        }
        //select5
        for(var i = select5.length; i >= 0 ; i--){
             select5.remove(i);
        }
        i=0;
        while(i<data["cls"].length){
          select5.add(new Option(data["cls"][i],data["cls"][i]));
          i++;
        }
      }
    }
  }
});

select3.addEventListener('change',function(event){
  var req = new XMLHttpRequest();
  req.open('POST', 'select_logic3.php', true);
  req.setRequestHeader('content-type','application/x-www-form-urlencoded;charset=UTF-8');
  var sendData = "year="+ encodeURIComponent(select1.value);
  sendData += "&teachercd="+ encodeURIComponent(select0.value);
  sendData += "&semester="+ encodeURIComponent(select2.value);
  sendData += "&subjectcd="+ encodeURIComponent(select3.value);
  sendData += "&grade="+ encodeURIComponent(select4.value);
  sendData += "&cls="+ encodeURIComponent(select5.value);
  req.send(sendData);

  req.onreadystatechange = function(){
    if(req.readyState == 4){
      if(req.status == 200){
        console.log(req.responseText);
        var data = JSON.parse(req.responseText);
        //select4
        for(var i = select4.length; i >= 0 ; i--){
             select4.remove(i);
        }
        i=0;
        while(i<data["grade"].length){
          select4.add(new Option(data["grade"][i],data["grade"][i]));
          i++;
        }
        //select5
        for(var i = select5.length; i >= 0 ; i--){
             select5.remove(i);
        }
        i=0;
        while(i<data["cls"].length){
          select5.add(new Option(data["cls"][i],data["cls"][i]));
          i++;
        }
      }
    }
  }
});


select4.addEventListener('change',function(event){
  var req = new XMLHttpRequest();
  req.open('POST', 'select_logic4.php', true);
  req.setRequestHeader('content-type','application/x-www-form-urlencoded;charset=UTF-8');
  var sendData = "year="+ encodeURIComponent(select1.value);
  sendData += "&teachercd="+ encodeURIComponent(select0.value);
  sendData += "&semester="+ encodeURIComponent(select2.value);
  sendData += "&subjectcd="+ encodeURIComponent(select3.value);
  sendData += "&grade="+ encodeURIComponent(select4.value);
  req.send(sendData);

  req.onreadystatechange = function(){
    if(req.readyState == 4){
      if(req.status == 200){
        console.log(req.responseText);
        var data = JSON.parse(req.responseText);
        //select5
        for(var i = select5.length; i >= 0 ; i--){
             select5.remove(i);
        }
        i=0;
        while(i<data["cls"].length){
          select5.add(new Option(data["cls"][i],data["cls"][i]));
          i++;
        }
      }
    }
  }
});


var selectAnswer1 = document.getElementById("selectAnswer1");
selectAnswer1.addEventListener('click',function(){
  var select0_ = document.getElementById('select0');
  console.log(select0_.value);
  var select1_ = document.getElementById('select1');
  console.log(select1_.value);
  var select2_= document.getElementById('select2');
  console.log(select2_.value);
  var select3_ = document.getElementById('select3');
  console.log(select3_.value);
  var select4_ = document.getElementById('select4');
  console.log(select4_.value);
  var select5_ = document.getElementById('select5');
  console.log(select5_.value);

  var list1Contents = document.getElementById('list1Contents');


  var req = new XMLHttpRequest();
  req.open('POST', 'selectAnswer1.php', true);
  req.setRequestHeader('content-type','application/x-www-form-urlencoded;charset=UTF-8');
  var sendData = "year="+ encodeURIComponent(select1_.value);
  sendData += "&teachercd="+ encodeURIComponent(select0.value);
  sendData += "&semester="+ encodeURIComponent(select2_.value);
  sendData += "&subjectcd="+ encodeURIComponent(select3_.value);
  sendData += "&grade="+ encodeURIComponent(select4_.value);
  sendData += "&cls="+ encodeURIComponent(select5_.value);
  req.send(sendData);

  req.onreadystatechange = function(){
    if(req.readyState == 4){
      if(req.status == 200){
        console.log(req.responseText);

        if(Number(req.responseText) == 1){//エラー
          $("#error").remove();
          $("#list1Contents_h").empty();
          $("#list1Contents").empty();
          $("#list2Contents_h").empty();
          $("#list2Contents").empty();
          $("#chart_div0_h").empty();
          $("#chart_div0").empty();
          $("#chart_div1_h").empty();
          $("#chart_div1").empty();
          $('#chart_div0').css('border','none');
          $('#chart_div1').css('border','none');
          $("#list_display").prepend("<div id=\"error\">ERROR-001:データを取得できませんでした。</div>");
          //errorflg = 1;
        }else{
          $("#error").remove();


        var data = JSON.parse(req.responseText);
        // console.log(data["number"][0]);
        // console.log(data["question"][0]);

        //削除処理
        var node1 = document.getElementById('qd');
        if(node1 != null){
          node1.parentNode.removeChild(node1);
        }
        var node2 = document.getElementById('list1');
        if(node2 != null){
          node2.parentNode.removeChild(node2);
        }

        var questionnaireDesc = document.getElementById('questionnaireDesc');
        var qd = document.createElement('span');//span
        qd.id = "qd";
        qd.textContent = data["resultDesc"][0]
        +"/"+data["resultDesc"][1]
        +"/"+data["resultDesc"][2]
        +"/"+data["resultDesc"][3]
        +"/"+data["resultDesc"][4];
        //questionnaireDesc.appendChild(qd);//日付を追加、コメントアウト

        $('#list1Contents_h').text('アンケート集計結果');

        var add1 = document.createElement('table');
        add1.id = "list1";
        list1Contents.appendChild(add1);

        var table = document.getElementById('list1');
        var newtr = table.insertRow();

        var newtd = newtr.insertCell();
        newtd.appendChild(document.createTextNode('番号'));
        var newtd = newtr.insertCell();
        newtd.appendChild(document.createTextNode('項目'));
        var newtd = newtr.insertCell();
        newtd.colSpan=3;
        newtd.appendChild(document.createTextNode('評価'));
        var newtd = newtr.insertCell();
        newtd.appendChild(document.createTextNode('平均'));

        for(var k=0;k<data["number"].length;k++){
          var newtr = table.insertRow();
          // for(var i=0;i<6;i++){
          //   var newtd = newtr.insertCell();
          //   newtd.appendChild(document.createTextNode(''));
          // }
          var newtd = newtr.insertCell();
          newtd.appendChild(document.createTextNode(data["number"][k]));
          var newtd = newtr.insertCell();
          newtd.appendChild(document.createTextNode(data["question"][k]));
          var newtd = newtr.insertCell();
          newtd.appendChild(document.createTextNode(data["good"][k]));
          var newtd = newtr.insertCell();
          newtd.appendChild(document.createTextNode(data["medium"][k]));
          var newtd = newtr.insertCell();
          newtd.appendChild(document.createTextNode(data["bad"][k]));
          var newtd = newtr.insertCell();
          newtd.appendChild(document.createTextNode(data["avg"][k]));
        }




        var req2 = new XMLHttpRequest();
        req2.open('POST', 'index2.php', true);
        req2.setRequestHeader('content-type','application/x-www-form-urlencoded;charset=UTF-8');
        var sendData = "year="+ encodeURIComponent(select1_.value);
        sendData += "&teachercd="+ encodeURIComponent(select0_.value);
        sendData += "&semester="+ encodeURIComponent(select2_.value);
        sendData += "&subjectcd="+ encodeURIComponent(select3_.value);
        sendData += "&grade="+ encodeURIComponent(select4_.value);
        sendData += "&cls="+ encodeURIComponent(select5_.value);
        req2.send(sendData);
        req2.onreadystatechange = function(){
          if(req2.readyState == 4){
            if(req2.status == 200){
              //var node3 = document.getElementById('');
              //var node3 = document.getElementsByClassName('list2Cs');
              // $(function(){
              //   $('#list2Contents').empty();
              // });
              $('#list2Contents').empty();
              // if(node3 != null){
              //   node3.parentNode.removeChild(node3);
              // }

              $('#list2Contents_h').text('記述式アンケート回答結果');

              var list2Contents = document.getElementById('list2Contents');
              console.log(req2.responseText);
              var data = JSON.parse(req2.responseText);

              console.log(typeof(data["answer"]));
              if(typeof(data["answer"])!='undefined'){//error対策
                for(var m=0;m<data["answer_content"].length;m++){
                  var add2 = document.createElement('table');
                  add2.id = "list2_"+m;
                  add2.classList.add('list2Cs');//
                  list2Contents.appendChild(add2);
                  var table = document.getElementById('list2_'+m);
                  var newtr = table.insertRow();
                  var newtd = newtr.insertCell();
                  newtd.appendChild(document.createTextNode(data["answer_content"][m]));
                  for(var p=0;p<data["answer"][m].length;p++){
      //              console.log("AAA"+data["answer"][m][p]);

                    var newtr = table.insertRow();
                    var newtd = newtr.insertCell();
                    newtd.appendChild(document.createTextNode(data["answer"][m][p]));
                  }
                }
              }
            }
          }
        }



        var req3 = new XMLHttpRequest();
        req3.open('POST', 'test4.php', true);
        req3.setRequestHeader('content-type','application/x-www-form-urlencoded;charset=UTF-8');
        var sendData = "year="+ encodeURIComponent(select1_.value);
        sendData += "&teachercd="+ encodeURIComponent(select0_.value);
        sendData += "&semester="+ encodeURIComponent(select2_.value);
        sendData += "&subjectcd="+ encodeURIComponent(select3_.value);
        sendData += "&grade="+ encodeURIComponent(select4_.value);
        sendData += "&cls="+ encodeURIComponent(select5_.value);
        req3.send(sendData);
        req3.onreadystatechange = function(){
          if(req3.readyState == 4){
            if(req3.status == 200){
              console.log(req3.responseText);
              var resdata = JSON.parse(req3.responseText);

              $('#chart_div0').css('border','1px solid #000');
              $('#chart_div1').css('border','1px solid #000');
              $('#chart_div0_h').text('項目別評価比率');
              $('#chart_div1_h').text('年度別評価推移');

              var aryAll0 = [['number', 'good', 'medium', 'bad']];
              for(var y=0;y<resdata["g1"]["number"].length;y++){
                var arrayN = [];
                arrayN.push(resdata["g1"]["number"][y]);
                arrayN.push(Number(resdata["g1"]["good"][y]));
                arrayN.push(Number(resdata["g1"]["medium"][y]));
                arrayN.push(Number(resdata["g1"]["bad"][y]));
                aryAll0.push(arrayN);
              }

              var arrayK = [['Year', 'Semester1', 'Semester2']];
              for(var y=0;y<resdata["g2"]["year"].length;y++){
                var arrayT = [];
                arrayT.push(resdata["g2"]["year"][y]);
                arrayT.push(Number(resdata["g2"]["semester1"][y]));
                arrayT.push(Number(resdata["g2"]["semester2"][y]));
                arrayK.push(arrayT);
              }

                google.charts.load('current', {packages: ['corechart', 'bar']});
                google.charts.setOnLoadCallback(drawStacked);
                function drawStacked() {
                  var data = google.visualization.arrayToDataTable(aryAll0);
                  var options = {
                    chartArea:{left:20,top:10,width:'82%',height:'87%'},
                    bar: { groupWidth: '35%' },
                    isStacked: true,
                    hAxis: {
                            minValue: 0,
                            ticks: [0, 0.2, 0.4, 0.6, 0.8, 1.0],
                          },
                    colors:['#000000','#7c7c7c','#bfbfbf'],
                  };
                      var chart = new google.visualization.BarChart(document.getElementById('chart_div0'));
                      chart.draw(data, options);
                }

                google.charts.load('current', {'packages':['bar']});
                google.charts.setOnLoadCallback(drawChart);
                function drawChart() {
                  var data = google.visualization.arrayToDataTable(arrayK);
                  var options = {
                    colors:['#000000'],
                    bar: { groupWidth: '25%'},
                    hAxis: {
                            minValue: 0,
                            ticks: [0, 0.2, 0.4, 0.6, 0.8, 1.0],
                          },
                  };
                  var chart = new google.charts.Bar(document.getElementById('chart_div1'));
                  chart.draw(data, google.charts.Bar.convertOptions(options));
                }
            }
          }
        }


      }//error閉じ



      }
    }
  }



});





});
})();
