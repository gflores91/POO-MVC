function goLostpass() {
  var connect, form, response, result, email;
  email = __('email_lostpass').value;


  connect = window.XMLHttpRequest ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');

  if (email!="") {
    form = 'email=' + email;

    connect.onreadystatechange = function() {
      if(connect.readyState == 4 && connect.status == 200) {
        if(connect.responseText == 1) {
          result = '<div class="alert alert-dismissible alert-success">';
          result += '<h4>Correo enviado exitosamente</h4>';
          result += '<p><strong>Revise su bandeja de entrada</strong></p>';
          result += '</div>';
          __('_AJAX_LOSTPASS_').innerHTML = result;
          location.reload();
        } else {
          __('_AJAX_LOSTPASS_').innerHTML = connect.responseText;
        }
      } else if(connect.readyState != 4) {
        result = '<div class="alert alert-dismissible alert-warning">';
        result += '<h4>Procesando...</h4>';
        result += '<p><strong>Estamos enviando un correo....</strong></p>';
        result += '</div>';
        __('_AJAX_LOSTPASS_').innerHTML = result;
      }
    }
    connect.open('POST','ajax.php?mode=lostpass',true);
    connect.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
    connect.send(form);
  } else {
    result = '<div class="alert alert-dismissible alert-danger">';
    result += '<h4>Error</h4>';
    result += '<p><strong>Los campos no deben estar vacios.</strong></p>';
    result += '</div>';
    __('_AJAX_LOSTPASS_').innerHTML = result;
  }

}

function runScriptLostpass(e) {
  if(e.keyCode == 13) {
    goLogin();
  }
}
