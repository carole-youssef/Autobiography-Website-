<?php
// Connect to the database
$connect = mysqli_connect("localhost", "cyoussef", "aRVpN3xP", "cyoussef");

if (!$connect) {
    die("Connection failed: " . mysqli_connect_error());
}

// Queries to fetch distinct locations and years
$location_query = "SELECT DISTINCT location FROM Photographs";
$date_query = "SELECT DISTINCT YEAR(date_taken) AS year FROM Photographs";

// Execute queries
$locations = mysqli_query($connect, $location_query);
$dates = mysqli_query($connect, $date_query);

// Initialize result variable
$result = null;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Sanitize and fetch the selected values
    $selectedLocation = mysqli_real_escape_string($connect, $_POST['location']);
    $selectedYear = mysqli_real_escape_string($connect, $_POST['year']);

    // Prepare and execute the query to fetch filtered results
    $sql = "SELECT * FROM Photographs WHERE location = ? AND YEAR(date_taken) = ?";
    $stmt = mysqli_prepare($connect, $sql);
    mysqli_stmt_bind_param($stmt, 'si', $selectedLocation, $selectedYear);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Lab09d</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #ffe4e6;
            color: #333;
            margin: 0;
            padding: 20px;
            text-align: center;
        }
        h1 {
            color: #d81b60;
            font-size: 2.5rem;
            margin-bottom: 1.5rem;
        }
        form {
            background-color: #fff;
            padding: 30px;
            border: 2px solid #f8bbd0;
            border-radius: 15px;
            display: inline-block;
            text-align: left;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
            width: 400px;
        }
        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
            color: #880e4f;
        }
        input[type="text"], input[type="submit"] {
            width: 100%;
            margin-bottom: 15px;
            padding: 12px 15px;
            font-size: 16px;
            font-weight: bold;
            color: #880e4f;
            background-color: #f8bbd0;
            border: 2px solid #f48fb1;
            border-radius: 5px;
            box-sizing: border-box;
            transition: background-color 0.3s ease, border-color 0.3s ease;
        }
        input[type="text"]:focus {
            outline: none;
            border-color: #d81b60;
            background-color: #ffe4e6;
        }
        input[type="submit"] {
            font-weight: bold;
            cursor: pointer;
            background-color: #d81b60;
            color: #fff;
            border: none;
        }
        input[type="submit"]:hover {
            background-color: #ad1457;
        }
        datalist option {
            font-size: 16px;
            color: #880e4f;
        }
        .container {
            margin-bottom: 20px;
        }
        .photo-container {
			text-align: center; 
			margin-top: 40px;
			margin-bottom: 20px;
		}
		.photo-container img {
			width: 50%;
			height: auto;
			border: 3px solid #f8bbd0;
			border-radius: 10px;
			box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
			display: block; 
			margin: 0 auto; 
		}
		.photo-caption {
			margin-top: 5px; 
			color: #880e4f;
			font-weight: bold;
			padding: 5px 10px;
			border-radius: 5px;
			font-size: 1.2rem;
			background-color: rgba(255, 192, 203, 0.9); 
			display: inline-block; 
			text-align: center;
		}
        .no-results {
            color: red;
            font-size: 1.5rem;
            font-weight: bold;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <h1>Lab09d: Photograph Search</h1>
    <form method="post">
        <label for="location">Location:</label>
        <div class="container">
            <input type="text" name="location" id="location" list="location-options" placeholder="Type or select a location">
            <datalist id="location-options">
                <?php 
                while ($row = mysqli_fetch_assoc($locations)) {
                    echo "<option value='" . htmlspecialchars($row['location']) . "'>";
                }
                ?>
            </datalist>
        </div>

        <label for="year">Year:</label>
        <div class="container">
            <input type="text" name="year" id="year" list="year-options" placeholder="Type or select a year">
            <datalist id="year-options">
                <?php 
                while ($row = mysqli_fetch_assoc($dates)) {
                    echo "<option value='" . htmlspecialchars($row['year']) . "'>";
                }
                ?>
            </datalist>
        </div>

        <input type="submit" value="Search">
    </form>

    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($result)) {
        $found = false;
        while ($row = mysqli_fetch_assoc($result)) {
            $found = true;
            echo "<div class='container'>";
            echo "<div class='photo-container'>";
            echo "<img src='" . htmlspecialchars($row['picture_url']) . "' alt='Photo'>";
            echo "</div>";
            echo "<div class='photo-caption'>" . htmlspecialchars($row['subject']) . " , " . htmlspecialchars($row['location'])
                 . "<br>" .  "Date Taken: " . htmlspecialchars($row['date_taken']) . "</div>";
            echo "</div>";
        }
        if (!$found) {
            echo "<div class='no-results'>No photographs found for the selected location and year.</div>";
        }
    }
    ?>

</body>
</html>

<?php
// Close the MySQL connection
mysqli_close($connect);
?>
