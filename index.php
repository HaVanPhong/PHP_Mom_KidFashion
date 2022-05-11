<link rel="stylesheet" href="index.css">
<?php
include 'menu.php';
include 'connect_db.php';

$sql= "select * from product";
$result= mysqli_query($con, $sql) or die("query error submit search");
renderMain($result);

function renderMain($res){
  echo '<div class="body">';
  while ($row= mysqli_fetch_assoc($res)){
    echo '
        <div class="item">
          <img src="'.$row['img'].'" alt="" />
          <h2>'.$row['price'].' VNĐ</h2>
          <p>'.$row['name'].'</p>
          <p class="idProduct"> ID: '.$row['id'].'</p>
        </div>
    ';
  }
  echo '</div>';
}

include 'footer.html';
?>