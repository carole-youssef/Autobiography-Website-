<?php
	$connect = mysqli_connect("localhost", "cyoussef", "aRVpN3xP", "cyoussef");

	if (!$connect) {
        die("Connection failed: " . mysqli_connect_error());
    }
    
    $sql = "SELECT * FROM Photographs ORDER BY date_taken DESC";
    $result = mysqli_query($connect, $sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Lab09b</title>
    <style>
		body {
			font-family: 'Arial', sans-serif;
			background-color: pink;
		}
		table {
			margin-bottom: 5rem;
			margin-left: auto;
			margin-right: auto;
			width: 70%; 
			border-collapse: collapse;
			box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); 
			background-color: #ffccdf; 
		}
		th, td {
			border: 1px solid #ff99c8; 
			padding: 12px;
			text-align: center;
			font-size: 1rem; 
		}
		th {
			background-color: #ff6699; 
			color: white;
			font-weight: bold;
		}
		tr:nth-child(even) {
			background-color: #ffe6f2; 
		}
		img {
			width: 150px; 
			height: auto;
			border-radius: 8px; 
		}
		.hover-image {
			transition: transform 0.3s ease;
			display: block;
			margin: 0 auto;
		}
		.hover-image:hover {
			transform: scale(3); 
			box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2); 
		}
		h1 {
			text-align: center;
			color: black; 
			font-size: 2.5rem;
			margin-bottom: 2rem;
		}
	</style>
</head>
<body>
    <h1>Lab09b: Display Pictures</h1>
    <table>
        <tr>
            <th>Picture Number</th>
            <th>Subject</th>
            <th>Location</th>
            <th>Date Taken</th>
            <th>Picture</th>
        </tr>
        <?php
            while (($row = mysqli_fetch_assoc($result)) != false) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($row['picture_number']) . "</td>";
                echo "<td>" . htmlspecialchars($row['subject']) . "</td>";
                echo "<td>" . htmlspecialchars($row['location']) . "</td>";
                echo "<td>" . htmlspecialchars($row['date_taken']) . "</td>";
                echo "<td><img class='hover-image' src='" . htmlspecialchars($row['picture_url']) . "' alt='Picture'></td>"; // Changed PICTURE_URL to picture_url
                echo "</tr>";
            }
            
        ?>
    </table>
</body>
</html>

<?php
  
    mysqli_free_result($result);
    mysqli_close($connect);
?>
