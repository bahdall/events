$(function(){
   $(".btn").button({
      icons: {
         primary: "ui-icon-plus"
      }
   });


   $(".j-image-add").click(function(e){
      e.preventDefault();

      var option_name = Math.random()*1000000;
      option_name = parseInt(option_name);
      var id = $(".imagesEditTable .copyMe").data('id');
      var row = $(".imagesEditTable .copyMe").clone().removeClass('copyMe');
      row.appendTo(".imagesEditTable tbody");


      row.find(".j-video").attr('name', 'video['+option_name+'][video]');
      row.find(".j-image").attr('name', 'videoImage['+option_name+']');

      return false;
   });


   // Delete row
   $(".imagesEditTable").delegate(".deleteRow", "click", function(){
      $(this).parent().parent().remove();

      if($(".imagesEditTable tbody tr").length == 1)
      {
         $(".imagesEditTable .plusOne").click();
      }
      return false;
   });



});