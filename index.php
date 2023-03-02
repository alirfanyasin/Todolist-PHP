<?php
require 'controller/function.php';
// Get Todo
$data_todo = query("SELECT * FROM todo WHERE status = 'Active' ORDER BY id DESC");
// Add Todo
if (isset($_POST['submit'])) {
  if (add($_POST) > 0) {
    echo "<script>
      document.location.href = 'index.php';
    </script>";
  } else {
    echo "<script>
      alert('Data gagal ditambahkan');
      document.location.href = 'index.php';
    </script>";
  }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">

  <title>Todo List - Active</title>
</head>

<body>

  <div class="container mt-5">
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal_add_todo">
      Add Todo
    </button>

    <!-- Navs start -->
    <ul class="nav justify-content-center mb-4">
      <li class="nav-item">
        <a class="nav-link active" href="index.php">Active</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="views/planning.php">Planning</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="views/finish.php">Finish</a>
      </li>
    </ul>
    <!-- Navs end -->

    <div class="row">
      <?php foreach ($data_todo as $data) : ?>
        <div class="col-md-6 mb-3 col-12 col-lg-4">
          <div class="card">
            <div class="card-body position-relative">
              <h5 class="card-title"><?= $data['title'] ?></h5>
              <p class="card-text"><?= $data['description'] ?></p>
              <span class="position-absolute bg-success" style="top: 13px; right: 52px; width: 18px; height: 18px; transform: rotate(45deg);"></span>
              <span class="position-absolute bg-success text-white px-2" style="top: 10px; right: 0;">Active</span>
              <div class="row">
                <div class="col-10">
                  <div class="d-grid">
                    <a href="views/detail.php?id=<?= $data["id"]; ?>" class="btn btn-warning" role="button">Detail</a>
                  </div>
                </div>
                <div class="col-2">
                  <a href="views/delete.php?id=<?= $data["id"]; ?>" class="btn btn-danger" role="button" onclick="return confirm('Apakah data ingin di hapus?')"><i class="fa-regular fa-trash-can"></i></a>
                </div>
              </div>
            </div>
          </div>
        </div>
      <?php endforeach ?>
    </div>
  </div>


  <!-- Modal Section Start -->
  <div class="modal fade" id="modal_add_todo" tabindex="-1" aria-labelledby="modalLabelToDo" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="modalLabelToDo">Create Todo</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="" method="post">
          <div class="modal-body">
            <div class="mb-3">
              <label for="title" class="form-label fw-bold">Title</label>
              <input type="text" name="title" class="form-control" id="title" required>
            </div>
            <div class="mb-3">
              <label class="form-check-label fw-bold" for="exampleCheck1">Status</label>
              <select name="status" class="form-control" id="status">
                <option value="Active">Active</option>
                <option value="Planning">Planning</option>
                <option value="Finish">Finish</option>
              </select>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="mb-3">
                  <label for="start_time" class="form-label fw-bold">Start Time</label>
                  <input type="date" name="start_time" class="form-control" id="start_time">
                </div>
              </div>
              <div class="col-md-6">
                <div class="mb-3">
                  <label for="dateline" class="form-label fw-bold">Deadline</label>
                  <input type="date" name="deadline" class="form-control" id="dateline" required>
                </div>
              </div>
            </div>
            <div class="mb-3">
              <label for="description" class="form-label fw-bold">Description</label>
              <textarea name="description" id="description" class="form-control" cols="30" rows="10" required></textarea>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" name="submit" class="btn btn-primary">Save</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <!-- Modal Section End -->

  <script src="node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/js/all.min.js"></script>
  <script>
    let lengthText = document.querySelectorAll('.card-text');

    for (var i = 0; i < lengthText.length; i++) {
      let string = lengthText[i].textContent;
      if (string.length > 120) {
        lengthText[i].innerHTML = string.substring(0, 120) + '...';
      }
    }
  </script>
</body>

</html>