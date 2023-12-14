<?php
include("connect.php"); // Include your database connection file

if (isset($_GET['id'])) {
    $user_id = $_GET['id'];
?>

    <script type="text/javascript">
        var confirmDelete = confirm("Are you sure you want to delete this record?");
        if (confirmDelete) {
            <?php
            // Continue with the original PHP code
            $query = "DELETE FROM user_tbl WHERE id = '$user_id'";
            $result = $conn->query($query);

            if ($result == TRUE) {
                echo 'alert("Record successfully deleted. . .");';
            } else {
                echo 'alert("Error in deleting record. . .");';
            }
            ?>
            window.location.href = 'admin_dashboard.php';
        } else {
            alert("Deletion canceled.");
            window.location.href = 'admin_dashboard.php';
        }
    </script>

<?php
} else {
    echo '<script type="text/javascript">';
    echo 'alert("Invalid request. . .");';
    echo 'window.location.href = "admin_dashboard.php";'; // Redirect back to admin_dashboard.php for an invalid request
    echo '</script>';
}
?>
