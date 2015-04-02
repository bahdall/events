$(function(){
    $(".btn").button({
        icons: {
            primary: "ui-icon-plus"
        }
    });


    $(".j-widget-add").click(function(e){
        e.preventDefault();

        var option_name = Math.random()*1000000;
        option_name = parseInt(option_name);
        var id = $(".widgetsEditTable .copyMe").data('id');
        var row = $(".widgetsEditTable .copyMe").clone().removeClass('copyMe');
        row.appendTo(".widgetsEditTable tbody");

        row.find("#widget_id_"+id).attr('name', 'widgets['+option_name+'][widget_id]');
        row.find("#widget_id_"+id).attr('id', 'widget_id_'+option_name);
        row.find("#position_"+id).attr('name', 'widgets['+option_name+'][position]');
        row.find("#position_"+id).attr('id', 'position_'+option_name);

        row.find(".j-sort").attr('name', 'widgets['+option_name+'][sort]');

        $("#widget_id_"+option_name).chosen({no_results_text: "Ничего не найдено", width: "280px"});

        return false;
    });


    // Delete row
    $(".widgetsEditTable").delegate(".deleteRow", "click", function(){
        $(this).parent().parent().remove();

        if($(".widgetsEditTable tbody tr").length == 1)
        {
            $(".widgetsEditTable .plusOne").click();
        }
        return false;
    });


    // Enable table rows sorting
    $(".widgetsEditTable tbody").sortable({
        beforeStop: function( event, ui ) {
            console.log(event);
            console.log(ui);
            var cnt = $(".widgetsEditTable tr").length;
            $(".widgetsEditTable tr").each(function(){
               $(this).find(".j-sort").val(cnt--);
            });
        }
    });

});