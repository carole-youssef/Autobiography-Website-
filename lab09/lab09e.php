<?php
	error_reporting(E_ALL);
    ini_set('display_errors', 'On');
	$connect = mysqli_connect("localhost", "cyoussef", "aRVpN3xP", "cyoussef");

	if (!$connect) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $total_images_query = "SELECT COUNT(*) AS total FROM Photographs";
    $total_result = mysqli_query($connect, $total_images_query);
    $total_images_row = mysqli_fetch_assoc($total_result);
    $total_images = $total_images_row['total'];

    $random_image_query = "SELECT * FROM Photographs ORDER BY RAND() LIMIT 1";
    $random_result = mysqli_query($connect, $random_image_query);
    $random_image_row = mysqli_fetch_assoc($random_result);

    mysqli_close($connect);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Lab09e</title>
    <style>
	body {
		font-family: Arial, sans-serif;
		background-color: #e0f7fa;
		color: #333;
		margin: 0;
		padding: 10px;
		text-align: center; 
	}
	.image-container {
		margin-top: 20px;
		padding: 20px 20px 60px;
		border: 3px solid #80deea; 
		border-radius: 15px;
		background-color: #b2ebf2;
		display: inline-block;
		width: 60%;
		box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1); 
		position: relative; 
	}
	.image-container img {
		width: 80%; 
		height: auto;
		margin-bottom: 15px; 
		border-radius: 10px; 
		border: 3px solid #4dd0e1; 
	}
	.caption {
		position: absolute;
        bottom: 10px;
		left: 50%;
		transform: translateX(-50%);
		font-weight: bold;
		color: #00796b; 
		font-size: 1.5rem;
		background-color: rgba(224, 247, 250, 0.9); 
		padding: 10px 15px;
		border-radius: 10px;
	}
	.total-count {
		margin-top: 30px;
		font-size: 1.3em;
		color: #004d40; 
		font-weight: bold;
	}
	.error-message {
		color: red; 
		font-weight: bold;
		margin-top: 20px;
		font-size: 1.1rem;
	}
	h1 {
		text-align: center;
		font-size: 2.5rem;
		margin-bottom: 2rem;
		color: #00838f; 
	}
    </style>
</head>
<body>
    <h1>Lab09e - Random Image & Image count</h1>
    <div class="image-container">
        <?php if ($random_image_row): ?>
            <img src="<?= htmlspecialchars($random_image_row['picture_url']) ?>" alt="Random Image">
            <div class="caption"><?= htmlspecialchars($random_image_row['subject']) . " , " . htmlspecialchars($random_image_row['location']) ?></div>
        <?php else: ?>
            <p class="error-message">No image found in the database.</p>
        <?php endif; ?>
    </div>
    <div class="total-count">
        Total images in database: <?= $total_images ?>
    </div>
</body>
</html>
