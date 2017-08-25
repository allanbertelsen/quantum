var active = 0;


$(document).keydown(function(e){
    reCalculate(e);
    rePosition();
    return false;
});

$(document).on("click", "td", function(){
   active = $(this).closest('table').find('td').index(this);
   rePosition();
});


function reCalculate(e){
    var rows = $('#navigate tr').length;
    var columns = $('#navigate tr:eq(1) td').length;
    //alert(columns + 'x' + rows);

    if (e.keyCode == 37) { //move left or wrap
        active = (active>0)?active-1:active;
    }
    if (e.keyCode == 38) { // move up
        active = (active-columns>=0)?active-columns:active;
    }
    if (e.keyCode == 39) { // move right or wrap
       active = (active<(columns*rows)-1)?active+1:active;
    }
    if (e.keyCode == 40) { // move down
        active = (active+columns<=(rows*columns)-1)?active+columns:active;
    }
}

function rePosition(){
    $('.active').removeClass('active');
    $('#navigate tr td').eq(active).addClass('active').trigger( "focus" );
    scrollInView();
}

function scrollInView(){
    var target = $('#navigate tr td:eq('+active+')');
    if (target.length)
    {
        var top = target.offset().top;

        $('html,body').stop().animate({scrollTop: top-100}, 400);
        return false;
    }
}
