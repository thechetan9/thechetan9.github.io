<?php
    // print_r($_REQUEST);
    // require '../vendor/autoload.php';
    require '../C/Class_Database.php';
    require '../C/Class_Model.php';
    $model = new Model();

    $image1 = explode('.', $_FILES['image_file1']['name']);
    $image1 = $image1[0] . "_" . time() . "." . end($image1);
    $image2 = explode('.', $_FILES['image_file2']['name']);
    $image2 = $image2[0] . "_" . time() . "." .end($image2);

    if ( $_FILES['image_file1']['error'] > 0 )
    {
        echo 'Error: ' . $_FILES['image_file1']['error'] . '<br>';
    } 
    else 
    {
        if(move_uploaded_file($_FILES['image_file1']['tmp_name'], '../images/' . $image1)) 
        {
            //echo "File Uploaded Successfully";
        }
    }

    if ( $_FILES['image_file2']['error'] > 0 ){
        echo 'Error: ' . $_FILES['image_file2']['error'] . '<br>';
    } else {
        if(move_uploaded_file($_FILES['image_file2']['tmp_name'], '../images/' . $image2)) {
            //echo "File Uploaded Successfully";
        }
    }

    $data = [
                "manufacturer_id" => $_REQUEST["manufacturer-id"],
                "model_name" => $_REQUEST["model-name"],
                "model_color" => $_REQUEST["model-color"],
                "model_year" => $_REQUEST["model-year"],
                "registration_number" => $_REQUEST["model-reg-no"],
                "model_note" => $_REQUEST["model-note"],
                "model_count" => $_REQUEST["model-count"],
                "model_imgPath_1" => $image1,
                "model_imgPath_2" => $image2
            ];
    echo $model->insert($data);
?>