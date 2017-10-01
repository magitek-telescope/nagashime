$(function (){
  $("select").change(function (){
    switch($(this).val()){
      case "login":
        $("#send_email").fadeOut(150);
        $("input[type='submit']").val("ログイン");
        break;

      case "email":
        $("#send_email").fadeIn(150);
        $("input[type='submit']").val("新規登録");
        break;
    }
  });
})