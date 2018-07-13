$("#form_contactnumber").prop("type", "phone");

// $('#form_contactnumber').mask('(000) 000 0000');

$(document).ready(function(){
  function checkName() {
    var txt = $('#form_firstname').val();
    if (/[^a-zA-Z0-9\-]/.test(txt)) {
      alert("Family name can only contain alphanumeric characters and hypehns(-)");
      return false;
    }
  }
});