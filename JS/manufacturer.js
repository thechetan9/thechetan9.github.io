function addManufacturere() 
{
    var manufacturer_name = $('#manufacturer_name').val().trim();
    
    if(manufacturer_name == '') 
    {
        alert("Please fill manufacturer details");
    } 
    else 
    {
        $.ajax({
            'url':'S/add_manufacturer.php',
            method: "POST",
            data: {'name' : manufacturer_name},
            success: function(data) 
            {
                switch(data) 
                {
                    case 'Success':
                            var msg = '<div class="alert alert-success text-center">';
                                msg += '<strong>Success!</strong> Manufacturer entry added successfully.';
                                msg += '</div>';
                            break;
                    case 'Failure':
                            var msg = '<div class="alert alert-danger text-center">';
                                msg += '<strong>Failed!</strong> Something went wrong, Please try again later.';
                                msg += '</div>';
                            break;
                    case 'Duplicate':
                            var msg = '<div class="alert alert-warning text-center">';
                                msg += '<strong>Warning!</strong> Entry already exist.';
                                msg += '</div>';
                            break;
                }
                $('#alerts').html(msg);
                $("#alerts").show();
                $("#alerts").show().delay(5000).fadeOut();
            }
        });
    }
}