<?php
	$connect = mysqli_connect("localhost", "cyoussef", "aRVpN3xP", "cyoussef") or die(mysqli_error());

	if ($connect) {
		print("Connection Established Successfully<br><br>");
		
	} else {
    print("Connection Failed");
	}
	
   // Drop the table if it exists
   $drop_sql = "DROP TABLE IF EXISTS Photographs";
   if (!mysqli_query($connect, $drop_sql)) {
       echo "Error dropping table: " . mysqli_error($connect);
       exit;
   }

   // SQL to create the table again
   $create_sql = "CREATE TABLE Photographs (
       picture_number INT,
       subject VARCHAR(255),
       location VARCHAR(255),
       date_taken DATE,
       picture_url VARCHAR(255)
   )";
   if (!mysqli_query($connect, $create_sql)) {
       echo "Error creating table: " . mysqli_error($connect);
       exit;
   }

    // Array of picture records
    $images = [
        [1, 'Pyramids', 'Egypt', '2009-09-05', 'images/Egypt.jpg'],
        [2, 'Stonehenge', 'England', '2018-09-14', 'images/England.jpg'],
        [3, 'Statue of Liberty', 'New York', '2017-07-01', 'images/NewYork.jpg'],
        [4, 'Louvre', 'Paris', '2015-04-16', 'images/Paris.jpg'],
        [5, 'Grand Canyon', 'Arizona', '2024-11-22', 'images/GC.jpg'],
        [6, 'Temple', 'Japan', '2017-05-15', 'images/Japan.jpg'],
        [7, 'Golden Gate Bridge', 'California', '2018-05-27', 'images/California.jpg'],
        [8, 'Barcelona', 'Spain', '2018-09-03', 'images/Spain.jpg'],
        [9, 'Rome', 'Italy', '2020-10-17', 'images/Italy.jpg'],
        [10, 'Toronto', 'Ontario', '2020-09-23', 'images/Ontario.jpg'],
    ];

    foreach ($images as $img) {
        // Prepare the insert statement with MySQL syntax
        $sql = "INSERT INTO Photographs (picture_number, subject, location, date_taken, picture_url) 
                VALUES (?, ?, ?, ?, ?)";

        // Prepare the statement
        $stmt = mysqli_prepare($connect, $sql);

        // Bind the data
        mysqli_stmt_bind_param($stmt, 'issss', $img[0], $img[1], $img[2], $img[3], $img[4]);

        // Execute the statement
        if (!mysqli_stmt_execute($stmt)) {
            echo "Error inserting record: " . mysqli_stmt_error($stmt);
        } else {
            echo "Record inserted successfully<br>";
        }

        mysqli_stmt_close($stmt);
    }

  
    mysqli_close($connect);
?>
