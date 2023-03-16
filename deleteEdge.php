<?php
include 'includes/library.php';
$sql = "DELETE FROM Edge WHERE ID='" . $_GET["userid"] . "'";
if (mysqli_query($conn, $sql)) {
    echo "Record deleted successfully";
} else {
    echo "Error deleting record: " . mysqli_error($conn);
}
mysqli_close($conn);
?>
