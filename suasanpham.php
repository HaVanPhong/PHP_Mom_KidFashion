<?php
include 'menu.php';
include 'connect_db.php';
include 'formsuasanpham.html';

if (isset($_POST['id'])&&(isset($_POST['name']) || isset($_POST['price']) || isset($_FILES['img']))){
  $id= $_POST['id'];
  $name = $_POST['name'];
  $price = $_POST['price'];

  $target='';


  if ($name!=''){
    $sql= "UPDATE product set name= '".$name."' where id=".$id;
    mysqli_query($con, $sql) or die("query error submit search");
  }
  if ($price!=''){
    $sql= "UPDATE product set price= '".$price."' where id=".$id;
    mysqli_query($con, $sql) or die("query error submit search");
  }

  if (isset($_FILES['img'])){
    $file = $_FILES['img'];
    $filename= $file['name'];
    $filename= explode('.', $filename);
    $ext = end($filename);
    $new_file= uniqid().'.'.$ext;
    
    $errors=[];
    $allow_size=100;
    //kiểm tra định dạng
    $allow_ext=['png', 'jpg', 'jpeg', 'gif', 'jfif'];
    if (in_array($ext, $allow_ext)){
      $size= $file['size']/1024/1024; //convert to MB
      if ($size <= $allow_size){
        $target= 'images/'.$new_file;
        $upload= move_uploaded_file($file['tmp_name'], $target);
        if (!$upload){
          $errors[]='upload_err';
        }else {
          $sql= "UPDATE product set img= '".$target."' where id=".$id;
          mysqli_query($con, $sql) or die("query error submit search");
        }
      }else {
        $errors[]= 'size_err';
      }
    }else {
      $errors[]= 'ext_err';
    }
    
    if (!empty($errors)){
      $mess='';
      if (in_array('ext_err', $errors)){
        $mess='Định dạng file không hợp lệ';
      }elseif (in_array('size_err', $errors)){
        $mess='Kích thước file quá lớn. >100MB';
      }else {
        $mess= 'Không thể upload tại thời điểm này, hãy thử lại!';
      }
    }else {
      echo 'Upload thành công';
    }
  }
  
}else {
  echo "Vui lòng nhập ID cần sửa và ít nhất 1 thông tin sửa";
}


include 'footer.html';
?>



