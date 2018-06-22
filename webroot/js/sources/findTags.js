
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

/*
$(':button').click(function(){
    thisurl = '/bookmarks/tagged'
    button = $(':button')
    for (i =0;i <button.length;i++)
    {
        if ($(":button:eq("+i+")").css('background-color')!="rgb(221, 221, 221)"){
            thisurl +='/'+ $(":button:eq("+i+")").val();
        }
    }
    $.ajax({
        url: thisurl,
        success:function(data){
            $('#content').html(data);
        }
    });
});
*/
$('#list').change(function(){
    var list_value = $('#list').val();
    for (i=0;i<$('.sorting').length;i++)
    {
        for (j=i+1;j<$('.sorting').length;j++)
            swap($('.sorting:eq('+i+')'),$('.sorting:eq('+j+')'),list_value);
    }
});
$('.sort').change(function(){
    for (i=0;i<$('.sort').length;i++)
    {
        if($(this).val()!=$('.sort:eq('+i+')').val())
        {
            $('.sort:eq('+i+')').prop('checked',false);
            $('.sort:eq('+i+')').attr('disabled',false);
        }
    }
    $(this).attr('disabled',true);

    var list_value = $(this).val();
    for (i=0;i<$('.sorting').length;i++)
    {
        for (j=i+1;j<$('.sorting').length;j++)
            swap($('.sorting:eq('+i+')'),$('.sorting:eq('+j+')'),list_value);
    }
});

function swap(a,b,attribute){
    if (attribute=='id')
    {
        vara=parseInt(a.attr(attribute));
        varb = parseInt(b.attr(attribute));
    }
    else if (attribute=='title')
    {
        vara = a.attr(attribute);
        varb = b.attr(attribute);
    }
    else 
    {
        vara = Date.parse(a.attr(attribute));
        varb = Date.parse(b.attr(attribute));
    }
    if (vara>varb){
        clonea = a.clone();
        cloneb = b.clone();
        a.replaceWith(cloneb);
        b.replaceWith(clonea);
    }
}

$(window).on("scroll", function() {
	var scrollHeight = $(document).height();
	var scrollPosition = $(window).height() + $(window).scrollTop();
	if ((scrollHeight - scrollPosition) / scrollHeight === 0) {
	    alert("Done");
	}
});
