
function loadInventories()
{
    if ($.fn.DataTable.isDataTable("#inventory-table")) 
    {
        $('#inventory-table').DataTable().clear().destroy();
    }

    $('#inventory-table').DataTable( {
        "ajax": {
                    "url" : "S/get_inventory.php",
                    dataSrc : ''
                },
        rowId: 'id',
        "columns" : [ 
            {"data" : "id"}, 
            {"data" : "model_name"}, 
            {"data" : "manufacturer_name"}, 
            {"data" : "count"}
        ],
        "rowCallback": function( row, data ) {
        
        }
    } );    
}

function addInventoryDetails() 
{
    $('#inventory-table tbody').on('click', 'tr', function () {
        var id = this.id;
        $.ajax({
            'url':'S/get_inventory.php',
            method: "GET",
            data: {'id':id},
            success: function(data) {
                data = JSON.parse(data);
                var inventory_details = "";
                inventory_details += '<div class="control-group"><label class="control-label">Model</label><div class="controls readonly">'+data.model_name+'</div></div>';
                inventory_details += '<div class="control-group"><label class="control-label">Manufacturer</label><div class="controls readonly">'+data.manufacturer_name+'</div></div>';
                inventory_details += '<div class="control-group"><label class="control-label">Color</label><div class="controls readonly">'+data.color+'</div></div>';
                inventory_details += '<div class="control-group"><label class="control-label">Manufactured Year</label><div class="controls readonly">'+data.model_year+'</div></div>';
                inventory_details += '<div class="control-group"><label class="control-label">Registration #</label><div class="controls readonly">'+data.registration_number+'</div></div>';
                inventory_details += '<div class="control-group"><label class="control-label">Note</label><div class="controls readonly">'+data.model_note+'</div></div>';
                inventory_details += '<div class="control-group"><label class="control-label">Count</label><div class="controls readonly">'+(data.count== null || data.count == 0 ? 'Sold Out' : data.count)+'</div></div>';
                inventory_details += '<div class="control-group text-center"><img style="max-width:200px; margin: 10px;" src="images/'+ data.model_imgPath_1+'"/><img style="max-width:200px; margin: 10px;" src="images/'+ data.model_imgPath_2+'"/></div>';
                inventory_details += '<div class="form-group text-center"><button type="button" class="btn btn-default" onclick="soldOut('+id+', \''+data.model_name+'\')">SOLD</button></div>';
                $('.modal-title').html(data.model_name);
                $('.modal-body').html(inventory_details);
                $('#model-button').click();
            }
        });
    
        if ( $(this).hasClass('selected') ) {
            $(this).removeClass('selected');
        }
        else {
            $('tr.selected').removeClass('selected');
            $(this).addClass('selected');
        }        
    } );
}

function soldOut(id, model_name) 
{
    $.ajax({
        'url':'S/sold_out_inventory.php',
        method: "POST",
        data: {'id':id},
        success: function(data) {
            switch(data) {
                case 'success':
                        var msg = '<div class="alert alert-info text-center">';
                            msg += '<strong>Success!</strong> Model ' + model_name + ' Sold Out';
                            msg += '</div>';
                            addSoldOutNotification(id);
                            alert("Data updated successfully");
                        break;
                case 'error':
                        var msg = '<div class="alert alert-danger text-center">';
                            msg += '<strong>Failed!</strong> Something went wrong, Please try again later.';
                            msg += '</div>';
                            alert("Somthing went wrong please try again later");
                        break;
            }

            loadInventories();
            addInventoryDetails();   
        }
    });
}

function addSoldOutNotification(model_id) {
    $.ajax({
        'url':'S/notification.php',
        method: "POST",
        data: {'model_id' : model_id, 'action' : 'add'},
        success: function(data) {
            
        }
    });
}

function sendNotification(model_id) {
    $.ajax({
        'url':'S/notification.php',
        method: "POST",
        data: {'model_id' : model_id, 'action' : 'update'},
        success: function(data) {
        }
    });
}

loadInventories();
addInventoryDetails();
/*
$('#alerts').html(msg);
$("#alerts").show();
$("#alerts").show().delay(5000).fadeOut();
*/

(function($)
{
    $(document).ready(function() {
        $.ajaxSetup({
            cache: false,
            beforeSend: function() {
                // console.log("b4 send")
            },
            complete: function() {
                // console.log("complete")
            },
            success: function() {
                // console.log("success")
            }
        });

        var refreshId = setInterval(function() {
            $.ajax({
                'url':'S/notification.php',
                method: "GET",
                data: {'action' : 'get'},
                success: function(data) {
                    data = JSON.parse(data)
                    if(data.length > 0) {
                        var model  = "";
                        for(i=0; i < data.length; i++) {
                            model += data[i] + ", ";
                        }
                        model = model.substring(0,(model.length-2));
                        var msg = '<div class="alert alert-warning text-center">';
                            msg += '<strong>Warning!</strong> '+ model + ' make model is sold.';
                            msg += '</div>';
                        $('#alerts').html(msg);
                        $("#alerts").show();
                        $("#alerts").show().delay(5000).fadeOut();
                    }
                }
            });
        }, 10000);
    });
})(jQuery);