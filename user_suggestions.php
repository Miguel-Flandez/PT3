<?php
require_once('connect.php');

if (isset($_POST['input'])) {
    $input = $_POST['input'];
    $sql = "SELECT username FROM user_tbl WHERE username LIKE '$input%'";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo '<div>' . $row['username'] . '</div>';
        }
    }
}
?>
