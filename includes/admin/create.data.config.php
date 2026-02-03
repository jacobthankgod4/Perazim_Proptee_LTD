<?php
    $page_title = 'Login Page ';

    include '../../Administration/config.inc.php';

    include "../../Administration/mysql.inc.php";

    $title = escape_data($_POST['title'], $dbc);
    $status = escape_data($_POST['status'], $dbc);
    $type = escape_data($_POST['type'], $dbc);

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
    }else{
        $imagesString =0;
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
    }else{
        $videosJson=0;
    }
        // Serialize video paths as JSON
        
        
            // Check for existing title using prepared statement
            require_once __DIR__ . '/../../includes/db/pdo_pg.php';
            $pdo = getPdoPostgres();
            
            $stmt = $pdo->prepare('SELECT "title" FROM public.property WHERE "Title" = :title');
            $stmt->execute([':title' => $title]);
            $rows = $stmt->rowCount();

            if ($rows === 0) {
                // Insert property using prepared statement
                $stmt1 = $pdo->prepare('INSERT INTO public.property ("Title", "Type", "Status", "Address", "City", "State", "Zip_Code", "Description", "Price", "Area", "Ammenities", "Bedroom", "Bathroom", "Built_Year", "Images", "Video") VALUES (:title, :type, :status, :address, :city, :state, :zip_code, :description, :price, :area, :ammenities, :bedroom, :bathroom, :built_year, :images, :video)');
                $id_insert = 0;
                if ($stmt1->execute([
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
                    ':ammenities' => $aminity,
                    ':bedroom' => $bed,
                    ':bathroom' => $bath,
                    ':built_year' => $year,
                    ':images' => $imagesString,
                    ':video' => $videosJson
                ])) {
                    // Get the last inserted ID from Postgres
                    $idResult = $pdo->query('SELECT LASTVAL() as id');
                    $idRow = $idResult->fetch(PDO::FETCH_ASSOC);
                    $id_insert = $idRow['id'] ?? 0;
                }

                if ($status == 'investment' && $id_insert) {
                    // Batch insert investment tiers using prepared statement
                    $stmtInv = $pdo->prepare('INSERT INTO public.investment ("interest", "share_cost", "expected_inv", "current_inv", "property_id") VALUES (:interest, :share_cost, :expected_inv, :current_inv, :property_id)');
                    if (true) {
                        $tiers = [
                            [15.5, 5000, 150000000, 40000000],
                            [15.5, 15000, 450000000, 80000000],
                            [15.5, 30000, 450000000, 10000000],
                            [15.5, 100000, 1500000000, 400000000],
                            [15.5, 500000, 5000000000, 900000000],
                            [15.5, 1000000, 5000000000, 40000000],
                            [15.5, 2000000, 5000000000, 40000000],
                            [15.5, 5000000, 5000000000, 40000000]
                        ];
                        foreach ($tiers as $t) {
                            $interest = $t[0];
                            $share_cost = $t[1];
                            $expected_inv = $t[2];
                            $current_inv = $t[3];
                            $stmtInv->execute([
                                ':interest' => $interest,
                                ':share_cost' => $share_cost,
                                ':expected_inv' => $expected_inv,
                                ':current_inv' => $current_inv,
                                ':property_id' => $id_insert
                            ]);
                        }
                    }
                }

                $output = "successful";
                echo $output;
            } else {
                $output = "hello1";
                echo $output;
            }
        

    
