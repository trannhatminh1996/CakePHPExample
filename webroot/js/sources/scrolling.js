var starting_point=0;
var limit=2;

function displaymore(a,b){
    $.ajax({
        url: '/bookmarks/randomdisplay/'+a+'/'+b,
        success:function(data){
            $('#content').append(data);
            $('#text').hide();
        }
    });
}

interval= setInterval(function(){
    if($(document).height()<=$(window).height())
    {
        displaymore(starting_point,limit);
        starting_point+=limit;
    }
},800);

clear_interval = setInterval(function(){
    if ($(document).height()>$(window).height())
    {
        clearInterval(interval);
        clearInterval(clear_interval);
    }
},1);

$(window).on("scroll", function() {
    var scrollHeight = $(document).height();
    var scrollPosition = $(window).height() + $(window).scrollTop();
    if (scrollHeight - scrollPosition ===0 && starting_point<$('#text').attr('count') && !$('#text').is(':visible')) {
        $('#text').show();
        displaymore(starting_point,limit);
        starting_point+=limit;
    }
});