<?php
session_start();
//connect db
$host = "localhost:3307";
$username = "root";
$password = "";
$database = "fptaptechDb";
//connection
$conn = new mysqli($host, $username, $password, $database);

//check conn
if ($conn->connect_error) {
          die("conn fail" . $conn->connect_error);

          exit(0);
} else {
          die("ss");

}

$username = $_POST["username"];
$password = $_POST["password"];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
          $stmt = $conn->prepare("SELECT * FROM account WHERE username = ?");
          $stmt->bind_param("s", $username);

          $stmt->execute();

          $result = $stmt->get_result();
          if ($result->num_rows > 0) {
                    $user = $result->fetch_assoc();

                    if (password_verify($password, $user['password'])) {
                              echo "ss";
                              $_SESSION["username"] = $user["username"];
                              header("Location:dash.php");
                    } else {
                              echo "fail";
                    }
          } else {
                    echo "fail";
          }
}

$conn->close();
?>

<!DOCTYPE html>
