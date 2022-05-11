<?php
include 'menu.php';
include 'connect_db.php';
include 'formxoasanpham.html';  

if (isset($_POST['id'])){
  $id= $_POST['id'];
  $sql= "DELETE FROM product where id=".$id;
  mysqli_query($con, $sql) or die("query error submit search");
  echo "Xóa thành công";
}
include 'footer.html';  
?>