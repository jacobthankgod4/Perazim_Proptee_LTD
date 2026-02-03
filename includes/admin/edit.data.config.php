<?php
    $page_title = 'Login Page ';

    include '../../Administration/config.inc.php';

    include "../../Administration/mysql.inc.php";

    $title = escape_data($_POST['title'], $dbc);
    $status = escape_data($_POST['status'], $dbc);
    $type = escape_data($_POST['type'], $dbc);
    $Id = escape_data($_POST['Id'], $dbc);

    if (!empty($_POST['price'])) {

        $price = escape_data($_POST['price'], $dbc);

    }else {

        $price = 0;

    }

    if (!empty($_POST['area'])) {

        $area = escape_data($_POST['area'], $dbc);

    }else {        

        $area = 0;

    }

    if (!empty($_POST['zip_code'])) {

        $zip_code = escape_data($_POST['zip_code'], $dbc);

    }else {        

        $zip_code = 0;

    }

    if (!empty($_POST['year'])) {

        $year = escape_data($_POST['year'], $dbc);

    }else {    

        $year = 0;

    }
        
    $bed = escape_data($_POST['bed'], $dbc);
    $bath = escape_data($_POST['bath'], $dbc);
    $address = escape_data($_POST['address'], $dbc);
    $city = escape_data($_POST['city'], $dbc);
    $state = escape_data($_POST['state'], $dbc);

    $description = escape_data($_POST['description'], $dbc);

    if (isset($_POST['aminity']) && is_array($_POST['aminity'])) {
        // Combine the selected checkbox values into a comma-separated string
        $aminity = implode(',', $_POST['aminity']);
    }else{        

        $aminity = 0;

    }

    // Define the upload directory
    $uploadDir = 'uploads/';
    $uploadedPaths = []; // Array to store file paths

    // Check if files were uploaded
    if (!empty($_FILES['images']['name'][0])) {
        foreach ($_FILES['images']['name'] as $key => $imageName) {
            $tmpName = $_FILES['images']['tmp_name'][$key];
            $uniqueName = uniqid() . '-' . basename($imageName);
            $uploadPath = $uploadDir . $uniqueName;

            // Move the uploaded file to the server directory
            if (move_uploaded_file($tmpName, $uploadPath)) {
                $uploadedPaths[] = $uploadPath;
            }
        }
    
        // Convert the paths array to a comma-separated string
        $imagesString = implode(',', $uploadedPaths);
    }

    // Directory to store uploaded videos
    $uploadDir = 'uploads/';
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    $uploadedVideos = [];

    if (!empty($_FILES['videos']['name'][0])) {
        foreach ($_FILES['videos']['tmp_name'] as $key => $tmpName) {
            $fileName = basename($_FILES['videos']['name'][$key]);
            $targetFile = $uploadDir . $fileName;
    
            if (move_uploaded_file($tmpName, $targetFile)) {
                $uploadedVideos[] = $targetFile; // Save the file path
            } else {
                echo "Error uploading file: $fileName";
                exit;
            }
        }
        $videosJson = json_encode($uploadedVideos);
    }
        // Serialize video paths as JSON
        
        require_once __DIR__ . '/../../includes/db/pdo_pg.php';
        $pdo = getPdoPostgres();
            

            if (!empty($_FILES['images']['name'][0])) {
                $id_int = (int)$Id;
                $stmt = $pdo->prepare('UPDATE public.property SET "Images" = :images WHERE "Id" = :id');
                $stmt->execute([
                    ':images' => $imagesString,
                    ':id' => $id_int
                ]);
            }

            if (!empty($_FILES['videos']['name'][0])) {
                $id_int = (int)$Id;
                $stmt = $pdo->prepare('UPDATE public.property SET "Video" = :video WHERE "Id" = :id');
                $stmt->execute([
                    ':video' => $videosJson,
                    ':id' => $id_int
                ]);
            }

            $id_int = (int)$Id;
            $stmtUpd = $pdo->prepare('UPDATE public.property SET "Title" = :title, "Type" = :type, "Status" = :status, "Address" = :address, "City" = :city, "State" = :state, "Zip_Code" = :zip_code, "Description" = :description, "Price" = :price, "Area" = :area, "Bedroom" = :bedroom, "Bathroom" = :bathroom, "Built_Year" = :built_year WHERE "Id" = :id');
            $stmtUpd->execute([
                ':title' => $title,
                ':type' => $type,
                ':status' => $status,
                ':address' => $address,
                ':city' => $city,
                ':state' => $state,
                ':zip_code' => $zip_code,
                ':description' => $description,
                ':price' => $price,
                ':area' => $area,
                ':bedroom' => $bed,
                ':bathroom' => $bath,
                ':built_year' => $year,
                ':id' => $id_int
            ]);
                
                
                $output = "successful";

                echo $output;
          

        

