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

      row.find(".j-title").attr('name', 'images['+option_name+'][title]');
      row.find(".j-description").attr('name', 'images['+option_name+'][description]');
      row.find(".j-link").attr('name', 'images['+option_name+'][link]');
      row.find(".j-elfinder #"+id).attr('name', 'images['+option_name+'][image]');
      row.find(".j-elfinder .btn").attr('id', option_name+'browse');
      row.find(".j-elfinder #"+id).attr('id', option_name);
      row.find(".j-elfinder #"+id+"_image").attr('id', option_name+"_image");

      $("#"+option_name+"browse").click(function(){window.elfinderBrowse(option_name, '/filemanager/elfinderconnector')});

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


   // Enable table rows sorting
   $(".imagesEditTable tbody").sortable();

});