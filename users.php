<?php
    session_start();
    if ($_SESSION['email']==null or $_SESSION['email']=='guest') {
      echo "Permission denied. Please sign in to webcoursera first.";
      return;
    }
?>

<?php

$conn = mysqli_connect('localhost', 'root', '', 'webcoursera');

if (!$conn) {
    echo 'Connection error' . mysqli_connect_error();
}

$sql = "SELECT * FROM student"; 

// if(isset($_POST['search'])) {

//     $search_term = $connect -> real_escape_string($_POST['search_box']);
//     $sql .= "WHERE person_id = '{$search_term}'";
// }

$query = mysqli_query($conn,$sql) or die(mysqli_error($conn));
//
//$sql = mysqli_query($connect,"SELECT * FROM student WHERE rollno = '$search_term'");
echo ' Displayed ';

?>

<table width='70%' cellpadding='5' cellspace='5'>


<tr>
    <td><strong>Email</strong></td>
    <td><strong>Name</strong></td>

</tr>
<?php while ($row = mysqli_fetch_array($query)) { ?>
<tr>
    <td><?php echo $row['email']; ?></td>
    <td><?php echo $row['name']; ?></td>
</tr>


<?php } ?>
</table>

<?php
    header("refresh:10; url=index.php");
?>