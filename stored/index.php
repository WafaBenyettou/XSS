<?php

$servername = "localhost";
$username = "YOUR_USERNAME";
$password = "YOUR_PWD";
$dbname = "YOUR_DBNAME"; 

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['clear'])) {
    $sql = "TRUNCATE TABLE comments";
    if ($conn->query($sql) === TRUE) {
        echo "Table Cleared";
    } else {
        echo "Error: Unable to Clear Table" . $conn->error;
    }
}

if (isset($_POST['comment'])) {
    $comment = $conn->real_escape_string($_POST['comment']);
    $sql = "INSERT INTO comments (comment) VALUES ('$comment')";
    if ($conn->query($sql) === TRUE) {
        $message = "New record created successfully";
    } else {
        $message = "Error: Unable to add comment" . $conn->error;
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>XSS Tutorial #3</title>
    <style>
        #bord td {
            border: 1px solid black;
            border-collapse: collapse;
        }
    </style>
</head>
<body>
<h1 align="center">Try My New Comment Website!</h1>
<table align="center">
<tr><td>
<p>
<?php
if (isset($message)) {
    echo $message;
}
?>
</p>
<form action="index.php" method="post">
    <textarea rows="6" cols="50" name="comment" placeholder="Leave a comment" maxlength="400"></textarea>
    <table align="center"><tr><td>
    <input type="submit" value="Comment" />
    </td></tr></table>
</form>
</td></tr>
</table>
<br />
<br />
<table align="center" id="bord">
<?php
$sql = "SELECT id, comment FROM comments";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<tr><td style='width:35%;padding:10px'>Comment #" . $row["id"] . "<br /><hr />" . $row["comment"] . "<br /></td></tr>";
    }
} else {
    echo "<tr><td style='width:35%'>No Comments!</td></tr>";
}
$conn->close();
?>
</table>
<h3 align="center">This website was made by me! I hope you really really like it!</h3>
<table align="center">
<tr><td>
<form action="index.php" method="post">
    Debug: <input type="submit" name="clear" value="Clear Table" />
</form>
</td></tr>
</table>
</body>
</html>
