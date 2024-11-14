<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simple Form with Database</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f4f4f9;
        }
        .form-container {
            width: 100%;
            max-width: 400px;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
            color: #333;
        }
        label {
            font-weight: bold;
            color: #333;
        }
        input[type="text"] {
            width: 100%;
            padding: 10px;
            margin: 8px 0 20px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
        }
        input[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #28a745;
            border: none;
            color: white;
            font-size: 16px;
            cursor: pointer;
            border-radius: 4px;
        }
        input[type="submit"]:hover {
            background-color: #218838;
        }
        .success {
            color: green;
            font-weight: bold;
            text-align: center;
        }
    </style>
</head>
<body>

<div class="form-container">
    <h2>User Information Form</h2>

    <?php
    // Database connection
    $servername = "localhost";  // Change if necessary
    $username = "mercedes";         // Change to your database username
    $password = "mercedes";             // Change to your database password
    $dbname = "fish_db";      // Change to your database name

    // Connect to the database
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Retrieve form data
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $middle_name = $_POST['middle_name'];
        $address = $_POST['address'];

        // Insert data into database
        $sql = "INSERT INTO form_data (first_name, last_name, middle_name, address) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssss", $first_name, $last_name, $middle_name, $address);

        if ($stmt->execute()) {
            echo "<p class='success'>Success! Form submitted and data saved.</p>";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        // Close statement
        $stmt->close();
    }

    // Close connection
    $conn->close();
    ?>

    <form action="" method="post">
        <label for="first_name">First Name:</label><br>
        <input type="text" id="first_name" name="first_name" required><br>

        <label for="last_name">Last Name:</label><br>
        <input type="text" id="last_name" name="last_name" required><br>

        <label for="middle_name">Middle Name:</label><br>
        <input type="text" id="middle_name" name="middle_name"><br>

        <label for="address">Address:</label><br>
        <input type="text" id="address" name="address" required><br>

        <input type="submit" value="Submit">
    </form>
</div>

</body>
</html>