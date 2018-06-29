$(document).ready(function(){
    
    var pathname = window.location.pathname; 
    $('h2').each(function(){
        $(this).append('<input style="width:25px;height:25px;"type="button" value="Reply" class="reply_button" id="'+$(this).attr('id')+'"/>');
        checkToShowHideButton($(this));
        showchilren($(this));
    });

    clickHideButton($('.hide_button'));
    clickReplyButton($('.reply_button'));
    $('.post_button').click(function(){
        if ($(this).next().attr('class')!='form')
        {
            $('.form').remove();
            savedocumentHeight=$(document).height();
            $(this).after('<form method="post" accept-charset="utf-8" class="form" action="'+pathname+'"><div style="display:none;"><input type="hidden" name="_method" value="POST"></div> <textarea class="commenttext" type="textarea" rows="2" name="inputcomment" placeholder="Write a comment..." id='+0+'" style="width:500px;margin-left:0px;"/><input type="text" name="parentcomment" value="0" style="display:none;"/><input type="text" name="bookmarkid" value="'+$(this).attr('bookmarkid')+'" style="display:none;"/><div class="submit"><input type="submit" id="submit_button" value="Submit" style="margin-left:0px;" ></div></form> ');
            checkform($(this).next(),$(this),'head');
           
            if (($(this).offset().top - $(window).scrollTop())/$(window).height()>=0.9){
                testingscroll($(document).height()-savedocumentHeight);
            }
        }
        else 
        {
            $(this).next().remove();
        }
    })

    $(window).keydown(function(event){
        if(event.target.tagName != 'TEXTAREA') {
            if(event.keyCode == 13) {
              event.preventDefault();
              return false;
            }
          }
    });

    function checkform(focusform,focush2,type){
        if (type=='normal')
        {
            focusform.submit(function(e){
                if ((jQuery.trim(focusform.find('.commenttext').val())).length!=0)
                {
                    e.preventDefault();
                    inputcomment = focusform.find('.commenttext').val();
                    bookmarkid = focusform.find('input[name="bookmarkid"]').val();
                    parentcomment = focusform.find('[input[name="parentcomment"]').val();
                    margin_left = parseInt($(focush2).css('margin-left'))+50;
                    focush2.parent().append('<div class="'+focush2.attr('id')+'"></div>');
                    focusform.remove();
                    $.ajax({
                        url: '/autosavebookmark/'+inputcomment+'/'+bookmarkid+'/'+ parentcomment,
                        type: 'POST',
                        data: {passinputcomment:inputcomment,passbookmarkid:bookmarkid,passparentcomment:parentcomment},
                        success:function(data){
                            getid = parseInt(data);
                            focush2.parent().find('div').last().append('<h2 style="margin-left:'+margin_left+'px;" bookmark="'+focush2.attr("bookmark")+'" id="'+getid+'">'+inputcomment+'<span style="display:inline-block;font-size:35%"> by '+$('#name').text()+'</span></h2>')
                            focush2.parent().find('div').last().find('h2').append('<input style="width:25px;height:25px;"type="button" value="Reply" class="reply_button" id="'+focush2.parent().find('div').last().find('h2').attr('id')+'"/>');
                            button=focush2.parent().find('div').last().find('h2').last().find('input[type="button"]');
                            clickReplyButton(button);
                            if (focush2.has('.hide_button').length==0)
                            {
                                focush2.append('<input class="hide_button" type="button" value="Hide" id="'+focush2.attr('id')+'"/>');
                                clickHideButton($('.hide_button[id='+focush2.attr('id')+']'));
                            }
                            if (focush2.has('text').length>0)
                            {
                                count = parseInt($(focush2).find('text').attr('count'))+1;
                                $(focush2).find('text').text(count+ ' childrens');
                                $(focush2).find('text').attr('count',count);
                            }
                            else 
                            {
                                focush2.append('<text id="children" count="'+1+'"style="font-size:50%;">'+1+'childrens </text>');
                            }
                        }
                    });
                }
                else 
                {
                    e.preventDefault();
                    alert("Can't leave empty space")
                }
            })
        }
        else 
        {
            focusform.submit(function(e){
                if ((jQuery.trim(focusform.find('.commenttext').val())).length!=0)
                {
                    e.preventDefault();
                    inputcomment = focusform.find('.commenttext').val();
                    bookmarkid = focusform.find('input[name="bookmarkid"]').val();
                    parentcomment = focusform.find('[input[name="parentcomment"]').val();
                    focush2.parent().append('<div class="0"></div>')
                    focusform.remove();
                    $.ajax({
                        url: '/autosavebookmark/'+inputcomment+'/'+bookmarkid+'/'+ parentcomment,
                        type: 'POST',
                        data: {passinputcomment:inputcomment,passbookmarkid:bookmarkid,passparentcomment:parentcomment},
                        success:function(data){
                            getid = parseInt(data);
                            focush2.parent().find('div').last().append('<h2 style="margin-left:0px;" id="'+getid+'" bookmark="'+focush2.attr('bookmarkid')+'">'+inputcomment+'<span style="display:inline-block;font-size:35%"> by '+$('#name').text()+'</div></h2>')
                            focush2.parent().find('div').last().find('h2').append('<input style="width:25px;height:25px;"type="button" value="Reply" class="reply_button" id="'+focush2.parent().find('div').last().find('h2').attr('id')+'"/>')
                            button=focush2.parent().find('div').last().find('h2').last().find('input[type="button"]');
                            clickReplyButton(button);
                        }
        
                    });
                }
                else 
                {
                    e.preventDefault();
                    alert("Can't leave empty space");
                }
            });
        }
    }


    function checkToShowHideButton(target){
        id= target.attr('id');
        check = false;
        $('div').each(function(){
            if ($(this).attr('class')== id)
                check = true;
        })
        if (check)
        {
            target.append('<input class="hide_button" type="button" value="Show" id="'+id+'"/>');
        }
    }

    function clickHideButton(focusButton){
        $(focusButton).click(function(){
            id = $(this).attr('id');
            if ($(this).attr('value')=="Hide")
            {
                button = $(this);
                $('div [class='+id+']').hide(300,function(){
                    button.attr('value','Show');
                });
            }
            else 
            {
                savedocumentHeight= $(document).height();
                button = $(this);
                $('div [class='+id+']').show(300,function(){
                    button.attr('value','Hide');
                    if ((button.offset().top - $(window).scrollTop())/$(window).height()>=0.9){
                        testingscroll($(document).height()-savedocumentHeight);
                    }
                });
            }
        });
    }
    function testingscroll(distance){
        holder = $(window).scrollTop()+distance;
        once = parseFloat(distance/5);
        count=0;
        thisInterval= setInterval(function(){
            if (count>=5)
            {
                clearInterval(thisInterval);
            }
            else
            {
                count++;
                $(window).scrollTop($(window).scrollTop()+once);
            }
        },50);
    }
    function clickReplyButton(focusButton){
        $(focusButton).click(function(){
            id = $(this).attr('id');
            margin_left = parseInt($('h2[id='+id+']').css('margin-left'))+50;
            check = $('h2[id='+id+']').next();
            if (check.attr('class')!='form')
            {
                $('.form').remove();
                savedocumentHeight=$(document).height();
                $('h2[id='+id+']').after('<form method="post" accept-charset="utf-8" class="form" action="'+pathname+'"><div style="display:none;"><input type="hidden" name="_method" value="POST"></div> <textarea class="commenttext" type="textarea" rows="2" name="inputcomment" placeholder="Write a comment..." id='+id+'" style="width:500px;margin-left:'+margin_left+'px;"/><input type="text" name="parentcomment" value="'+$('h2[id='+id+']').attr('id')+'" style="display:none;"/><input type="text" name="bookmarkid" value="'+$('h2[id='+id+']').attr('bookmark')+'" style="display:none;"/><div class="submit"><input type="submit" id="submit_button" value="Submit" style="margin-left:'+margin_left+'px;" ></div></form> ');
                checkform($('h2[id='+id+']').next(),$('h2[id='+id+']'),'normal');

                if (($(this).offset().top - $(window).scrollTop())/$(window).height()>=0.9){
                    testingscroll($(document).height()-savedocumentHeight);
                }
                
            }
            else 
                $(check).remove();
            autosize($('textarea'));
        });
    }


    
    function showchilren(focush2){
        count=0;
        $('div').each(function(){
            if ($(this).attr('class')==focush2.attr('id'))
            {
                count+=1;
            }
        })
        if (count>0)
        {
            if (focush2.has('text').length==0)
            {
                //create the text to show the children
                focush2.append('<text id="children" count="'+count+'"style="font-size:50%;">'+count+'chilrens </text>');
            }
            else 
            {
                //show no of children if there exists one
                focush2.has('text[id="chilren"]').text(count+' childrens');
            }
        }
    
    }
});



