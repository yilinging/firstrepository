<HTML>
  <HEAD>
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script type="text/javascript">

/*
    $(document).ready(function () 
    {
      $.ajax({
        url: 'amsr140_back.php',
        type:'GET',
        dataType: 'json',
        data: { },
        error: function(xhr) {
          //console.log(xhr.responseText);
          console.log(xhr);
          alert('Ajax request 發生錯誤1');

        },
        success: function(response) {
         //$('#msg1').html(response.sqlid[0][0]);
         //$('#msg2').html(response.sqlid[0][1]);

       }
     });


      $('#btn').click(function (){
       $.ajax({
        url: 'amsr140_back.php',
        dataType: 'json',
        type:'GET',
        data: { },
        //data: { sqlselect: $('#sqlselect').val()},
        error: function(xhr) {
          alert('Ajax request 發生錯誤2');
        },
        success: function(response) {
          //$('#msg15').html(response.sqlresult[0]);
         //$('#msg16').html(response.sqlresult[1]);
        }
      });
     });



/*$('#clean').click(function(){
  $('#msg').html("");
});*/

//})


</script>

<style>
table {
  border: 1px solid black;
}
td {

  text-align: center;;

}
td.input {
  border: 1px solid black;
  width: 120px;
  height: 50px;
  text-align: center;;

}
</style>
</HEAD>
<BODY>

  <br><br><br>
  <div align="center">
   條碼列印  <br>
   <table >
    　<tr>
      　<td>索引編號/包裝</td><td>作業員</td><td>姓名</td><td>單重(g)</td><td>秤重(g)</td><td>生產數量</td><td colspan="2">番/機台</td>
    　</tr>
    <tr>
      <td id="wbb01"><input type="text">
      </td><td id="wbb11"><input type="text">
    </td><td id="gen02"><input type="text"></td>
    <td id="wbb081"><input type="text"></td>
      <td id="wbb082"><input type="text"></td>
      <td id="wbb10"><input type="text"></td>
      <td id="ay08" ><input type="text"></td>
      <td id="a" ><input type="text"></td>
    　</tr>
    <tr>
      <td id="wfy04"><input type="text"></td>
      <td id="wbb03"><input type="text"></td>
      <td id="wbb07" colspan="2"><input type="text"></td>
      <td id="wbb12" colspan="2"><input type="text"></td>
      <td id="r" ><input type="text"></td>
    <td id="wbb09" ><input type="text"></td>
  </tr>
</table><br>

</div>
</BODY>
</HTML>