<?php
	$connect = mysqli_connect("localhost", "cyoussef", "aRVpN3xP", "cyoussef");

	if (!$connect) {
        die("Connection failed: " . mysqli_connect_error());
    }
    
    // Query to fetch photos taken in Ontario
    $sql = "SELECT * FROM Photographs WHERE location = 'Ontario'";
    $result = mysqli_query($connect, $sql);

    // Check if query execution was successful
    if (!$result) {
        die("Error executing query: " . mysqli_error($connect));
    }
?>

<!DOCTYPE html>
<html>
<head>
    <title>Lab09c</title>
	<style>
		body {
			font-family: Arial, sans-serif;
			background-color: #e6f7ff; 
			color: #333;
			margin: 0;
			padding: 10px;
			text-align: center;
		}
		.container {
			position: relative;
			display: inline-block; 
			margin: 20px; 
		}
		.photo-container {
			margin-top: 40px; 
			margin-bottom: 40px;
		}
		.photo-container img {
			width: 60%; 
			height: auto; 
			border: 5px solid #99ccff;
			border-radius: 12px; 
			box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2); 
			transition: transform 0.3s ease, box-shadow 0.3s ease; 
		}
		.photo-caption {
			position: absolute; 
			width: 60%;
			bottom: 0; 
			left: 50%;
			transform: translateX(-50%);
			background-color: rgba(153, 204, 255, 0.85); 
			color: #003366; 
			font-weight: bold;
			padding: 8px; 
			font-size: 1.1rem; 
			border-radius: 0 0 8px 8px; 
		}
		h1 {
			text-align: center;
			color: #007acc; 
			font-size: 2.5rem;
			margin-bottom: 2rem;
		}
	</style>
</head>
<body>
    <h1>Lab09c: Pictures taken in Ontario</h1>

    <?php
        $found = false;
        while (($row = mysqli_fetch_assoc($result)) != false) {
            $found = true;
            echo "<div class='container'>";
            echo "<div class='photo-container'>";
            echo "<img src='" . htmlspecialchars($row['picture_url']) . "' alt='Ontario Photo'>";
            echo "</div>";
            echo "<div class='photo-caption'>" . htmlspecialchars($row['subject']) . " , " . htmlspecialchars($row['location']) . "</div>";
            echo "</div>";
        }

        if (!$found) {
            echo "<p>No photographs taken in Ontario were found.</p>";
        }
    ?>
</body>
</html>

<?php
   
    mysqli_free_result($result);
    mysqli_close($connect);
?>
