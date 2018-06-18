
$(':button').click(function(){
    //$(this).after("<input type='text' id='"+(title+a)+"' name='"+(title+a)+"' style='display:none;' />");
    if ($(this).css('background-color')=="rgb(221, 221, 221)")
        $(this).css('background-color','blue');
    else 
        $(this).css('background-color','rgb(221, 221, 221)');
});

$('#submit_button').click(function(){
    len = $(':button').length;
    count = 0;
    a = 0;
    title = "Title";
    for (i=0;i<len;i++)
    {
         if ($(":button:eq("+i+")").css('background-color')!="rgb(221, 221, 221)"){
             count++;
             $(this).after("<input type='text' value='"+$(":button:eq("+i+")").val()+"' id='"+(title+a)+"' name='"+(title+a)+"' style='display:none;' />");
             a++;
         }
    }
    $(this).after("<input type='text' name='Title' value='"+count+"' style='display:none;'/>");
});
$(':button').click(function(){
    len = $(':button').length;
    check = true;
    for (i=0;i<len;i++)
    {
        if ($(":button:eq("+i+")").css('background-color')!="rgb(221, 221, 221)"){
            check = false;
        }
    } 
    if (check == false)
    {
        $('#submit_button').attr('value','Find');
    }
    else 
    {
        $('#submit_button').attr('value','Find All');
    }
});