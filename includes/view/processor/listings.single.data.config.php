<?php
$id = isset($_GET['identity']) ? (int)$_GET['identity'] : 0;

$q51 = "SELECT `Title`, `Address`, `Description`, `City`, `State`, `Bedroom`, `Bathroom`, `Built_Year`, `Area`, `Zip_Code`, `Images`, `Video` FROM `property` WHERE Id = ?";
$stmt = mysqli_prepare($dbc, $q51);
if ($stmt) {
	mysqli_stmt_bind_param($stmt, 'i', $id);
	mysqli_stmt_execute($stmt);
	$res = mysqli_stmt_get_result($stmt);
	$fetch_array = $res ? mysqli_fetch_array($res, MYSQLI_ASSOC) : [];
	mysqli_stmt_close($stmt);
} else {
	$fetch_array = [];
}

$fetch_array_images = !empty($fetch_array['Images']) ? explode(',', $fetch_array['Images']) : [];
$fetch_array_video = !empty($fetch_array['Video']) ? json_decode($fetch_array['Video']) : null;