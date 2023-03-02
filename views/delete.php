<?php

require '../controller/function.php';

$id = $_GET["id"];

if (delete($id) > 0) {
  echo "
     <script>
         document.location.href = '../index.php';
     </script>";
} else {
  echo "
    <script>
        alert('Data gagal di hapus');
        document.location.href = '../index.php';
    </script>";
}
