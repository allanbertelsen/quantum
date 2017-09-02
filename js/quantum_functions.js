var active = 0;
var version = detectIE();

$(document).keydown(function(e) {
  reCalculate(e);
  rePosition();
  if (e.keyCode == 13) { // move down
    return false;
  }
  //return false;
});

$(document).on("click", "td", function() {
  active = $(this).closest('table').find('td').index(this);
  rePosition();
});

$.fn.focusEnd = function() {
  $(this).focus();
  var tmp = $('<span />').appendTo($(this)),
    node = tmp.get(0),
    range = null,
    sel = null;
  if (document.selection) {
    range = document.body.createTextRange();
    range.moveToElementText(node);
    range.select();
  } else if (window.getSelection) {
    range = document.createRange();
    range.selectNode(node);
    sel = window.getSelection();
    sel.removeAllRanges();
    sel.addRange(range);
  }
  tmp.remove();
  return this;
}

function reCalculate(e) {
  var rows = $('#navigate tr').length;
  var columns = $('#navigate tr:eq(1) td').length;
  //alert(columns + 'x' + rows);

  if (e.keyCode == 37) { //move left or wrap
    //active = (active > 0) ? active - 1 : active;
  }
  if (e.keyCode == 38) { // move up
    active = (active - columns >= 0) ? active - columns : active;
  }
  if (e.keyCode == 39) { // move right or wrap
    //active = (active < (columns * rows) - 1) ? active + 1 : active;
  }
  if (e.keyCode == 40) { // move down
    active = (active + columns <= (rows * columns) - 1) ? active + columns : active;
  }
  if (e.keyCode == 13) { // move down
    active = (active + columns <= (rows * columns) - 1) ? active + columns : active;
  }
}

function rePosition() {
  $('td.active').css({
    'outline': '0px solid blue'
  });
  $('.active').removeClass('active');
  $('#navigate tr td ').eq(active).addClass('active').trigger("focus");
  $('td.active').css({
    'outline': '5px solid rgb(91, 157, 217)'
  });
  if (version === false) {
      //$('td.active').focusEnd();
  }else {
      $('td.active').trigger('focus');
  }
  scrollInView();
}

function scrollInView() {
  var target = $('#navigate tr td:eq(' + active + ')');
  if (target.length) {
    var top = target.offset().top;

    $('html,body').stop().animate({
      scrollTop: top - 100
    }, 400);
    return false;
  }
}

if (version === false) {
  //document.getElementsByClassName('editable').prop('contentEditable',true);
  $('td.editable').attr('contenteditable', 'true');
} else {
  //document.getElementsByClassName('editable').prop('contentEditable',true);
  $('div.ttt').attr('contenteditable', 'true');
}

function detectIE() {
  var ua = window.navigator.userAgent;

  // Test values; Uncomment to check result …

  // IE 10
  // ua = 'Mozilla/5.0 (compatible; MSIE 10.0; Windows NT 6.2; Trident/6.0)';

  // IE 11
  // ua = 'Mozilla/5.0 (Windows NT 6.3; Trident/7.0; rv:11.0) like Gecko';

  // Edge 12 (Spartan)
  // ua = 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.71 Safari/537.36 Edge/12.0';

  // Edge 13
  // ua = 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2486.0 Safari/537.36 Edge/13.10586';

  var msie = ua.indexOf('MSIE ');
  if (msie > 0) {
    // IE 10 or older => return version number
    return parseInt(ua.substring(msie + 5, ua.indexOf('.', msie)), 10);
  }

  var trident = ua.indexOf('Trident/');
  if (trident > 0) {
    // IE 11 => return version number
    var rv = ua.indexOf('rv:');
    return parseInt(ua.substring(rv + 3, ua.indexOf('.', rv)), 10);
  }

  var edge = ua.indexOf('Edge/');
  if (edge > 0) {
    // Edge (IE 12+) => return version number
    return parseInt(ua.substring(edge + 5, ua.indexOf('.', edge)), 10);
  }

  // other browser
  return false;
}
