
$(function(){
   $(".j-editFile").click(function(){
      var dialog_id = $(this).data('dialog-id');
      var form_id = $(this).data('form-id');
      var content_id = $(this).data('content-id');
      var url = $("#"+form_id).attr('action');


      $("#"+dialog_id).dialog({
         width: 1000,
         height: 400,
         position: { my: "top", at: "top" },
         buttons: [
            {
               text: "Сохранить",
               icons: {
                  primary: "ui-icon-heart"
               },
               click: function() {

                  $('#'+content_id).elrte('updateSource');

                  var data = $("#"+form_id).serialize();
                  $.post(url,data , function(data){
                     alert(data);
                     window.location = '';
                  });
               }
               // Uncommenting the following line would hide the text,
               // resulting in the label being used as a tooltip
               //showText: false
            }
         ]
      });
   });
});
