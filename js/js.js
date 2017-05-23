function consInfo() {
  var Data = new Date(),
    rand = Math.floor((Math.random() * 12) + 1);
  console.log('random=' + rand);
  setTimeout(consInfo, 2000);
}

// Обработчик нажатия кнопок
window.onkeyup = pressed;

function pressed(e) {
  // console.log(e.keyCode);
  key = e.keyCode || e.which;
  //  Кнопка ESC
  // if(key == 27)
  // fx.boxout();
  // Кнопка влево
  if (key == 37) {
    $('.img_prev').click();
  }
  // Кнопка вправо
  if (key == 39) {
    $('.img_next').click();
  }
}


$(document).ready(function() {

  var files;

  $('input[type=file]').change(function() {
    files = this.files;
  });

  $('input[type=submit]').click(function(event) {
    event.preventDefault();

    var resObj = $('.ajaxRespond');

    resObj.prepend('<div class="preloader preloader-1"></div>');

    var data = new FormData();
    $.each(files, function(key, value) {
      data.append(key, value);
    });

    $.ajax({
      url: './upload.php?uploadfiles',
      type: 'POST',
      data: data,
      cache: false,
      dataType: 'json',
      processData: false, // Не обрабатываем файлы (Don't process the files)
      contentType: false, // Так jQuery скажет серверу что это строковой запрос
      success: function(respond, textStatus, jqXHR) {
        console.log(respond);
        if (typeof respond.error === 'undefined') {
          var files_path = respond.files,
            errors = respond.errors,
            html_errors = '',
            html = '';

          $.each(errors, function(key, val) {
            html_errors += val;
          });
          $.each(files_path, function(key, val) {
            html += '<img src="' + val + '" class="ajaxRespond-imgPreview">';
          });

          $('input[type=file]').val('');
          resObj
            .html('')
            .prepend(html_errors)
            .append(html);
        } else {
          console.log('ОШИБКИ ОТВЕТА сервера: ' + respond.error);
        }
        $('.preloader').css({
          'display': 'none'
        });
      },
      error: function(jqXHR, textStatus, errorThrown) {
        console.log('ОШИБКИ AJAX запроса: ' + textStatus);
      }

    });



  });


  $('.ajaxRespond-imgPreview').click(function() {
    alert($(this).attr('src'));
  })
  // setTimeout(consInfo, 1000);

  // $('body').on('click', '.logo', function (event) {
  // 		console.log( 'logo click' );
  // })

  $('.img_prev, .img_next').click(function() {
    var row = $(this).attr('class'),
      dir = row.split('_');

    if (dir[1] == 'prev') {
      var par = $('.item_active').prev();
    } else {
      var par = $('.item_active').next();
    }
    if (par.length != 1) return;

    var obj = par.children('.cover'),
      text = obj.css('background-image'),
      regexp = /http:\/\/(.*)(?=")/g,
      url = regexp.exec(text);
    $('.item_active')
      .toggleClass('item_active');
    par
      .toggleClass('item_active');

    $('#test')
      .fadeOut('slow', function() {

        $(this)
          .attr({
            'src': url[0]
          })
          .fadeIn('slow');
      });


    console.log('url : ' + url[0]);
  });


  $('.photo .item').click(function(event) {
    var text = $(this).children('.cover').css('background-image'),
      regexp = /http:\/\/(.*)(?=")/g,
      url = regexp.exec(text),
      parent = $(this).parent(),
      top = $('#test').offset().top;

    $('#test')
      .fadeOut('slow', function() {

        $(this)
          .attr({
            'src': url[0]
          })
          .fadeIn('slow', function() {
            $('html, body').animate({
              scrollTop: top + 'px'
            }, 500);
          });
      });

    $('.item_active')
      .toggleClass('item_active');
    $(this)
      .toggleClass('item_active');

  });

})
