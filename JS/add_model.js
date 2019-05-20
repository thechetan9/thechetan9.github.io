function loadManufacturer() 
{
    $.ajax({
        'url':'S/get_manufacturer.php',
        method: "GET",
        success: function(data) {
            data = JSON.parse(data);
            var manufacturer = "<option>Select Manufacturer</option>";
            for(i=0; i < data.length; i++)
            {
                manufacturer += "<option value='"+data[i].manufacturer_id+"'>"+ data[i].manufacturer_name +"</option>";
            }
            $('#select-manufacturer').html(manufacturer);
        }
    });
}

loadManufacturer();

function addModel() 
{   
    var image1 = $('#image-1').prop('files')[0];
    var image2 = $('#image-2').prop('files')[0];
    var formvars_info = new FormData();
    formvars_info.append('manufacturer-id', $('#select-manufacturer').val());
    formvars_info.append('model-name', $('#model-name').val());
    formvars_info.append('model-color', $('#model-color').val());
    formvars_info.append('model-year', $('#model-year').val());
    formvars_info.append('model-reg-no', $('#model-reg-no').val());
    formvars_info.append('model-note', $('#model-note').val());
    formvars_info.append('model-count', $('#model-count').val());
    formvars_info.append('image_file1', image1);
    formvars_info.append('image_file2', image2);

    var model_name = $('#model-name').val();
    if(model_name == '') 
    {
        alert("Please fill model details");
    }
    else
    {
        $.ajax({
            'url':'S/add_model.php',
            method: "POST",
            data: formvars_info,
            processData: false,
            contentType: false,
            success: function(data)
            {
                switch(data)
                {
                    case 'Success':
                        var msg = '<div class="alert alert-success text-center">';
                            msg += '<strong>Success!</strong> Car Model added successfully.';
                            msg += '</div>';
                        break;
                    case 'Failure':
                        var msg = '<div class="alert alert-danger text-center">';
                            msg += '<strong>Failed!</strong> Something went wrong, Please try again later.';
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