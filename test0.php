<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

?>
<button id="selectAnswer1" >送信</button>

<script>
(function (){
document.addEventListener('DOMContentLoaded',function () {


var selectAnswer1 = document.getElementById("selectAnswer1");
selectAnswer1.addEventListener('click',function(){
    console.log("tes");
  var test0 = "hello";

  var req = new XMLHttpRequest();
  req.open('POST', 'test.php', true);
  req.setRequestHeader('content-type','application/x-www-form-urlencoded;charset=UTF-8');
  var sendData = "name="+ test0;
  req.send(sendData);

  req.onreadystatechange = function(){
    if(req.readyState == 4){
      if(req.status == 200){
        console.log(req.responseText);
      }
    }
  }
});
  

});
})();
</script>