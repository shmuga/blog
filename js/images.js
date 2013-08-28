$(document).ready(function(){
  count=0;
$("img").live('click', function(){

if (count<3)
{
    if ($(this).attr("class")!="checked")
  {
  count++;
  $(this).attr("class","checked");
  }
    else
  {
  $(this).attr("class","unchecked");
  count--;
  }
}
else
{
    if ($(this).attr("class")=="checked")
    {
    $(this).attr("class","unchecked");
    count--;
    }
}
});

$("#send").click( function(){
  $("#send").hide();
    str="";
    $.each($("img"),function(){
  if ($(this).attr("class")=="checked")
  {
      str+=$(this).attr("name")+"|";
  }
    });
    $("#photo").attr("value",str);
    tmp=$("form").serialize();
    alert(tmp);
});
});