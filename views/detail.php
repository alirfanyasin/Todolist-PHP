<?php

include '../controller/function.php';
// Get Data Detail Todo
$id = $_GET['id'];
$data = detail($id);
// Get Data Todo
$data_todo = query("SELECT * FROM todo WHERE id = $id")[0];
// Update Data
if (isset($_POST["submit"])) {
  if (edit($_POST) > 0) {
    echo "
      <script>
        document.location.href = '../index.php';
      </script>";
  } else {
    echo "
      <script>
          alert('Data gagal diubah');
          document.location.href = '../index.php';
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
  <link rel="stylesheet" href="../node_modules/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">

  <title>Todo List - Detail</title>
</head>

<body>


  <div class="container mt-5">
    <h2 class="text-center mb-3">Detail Todo</h2>
    <!-- Navs start -->
    <ul class="nav justify-content-center mb-4">
      <li class="nav-item">
        <a class="nav-link active" href="../index.php">Active</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="planning.php">Planning</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="finish.php">Finish</a>
      </li>
    </ul>
    <!-- Navs end -->


    <div class="row d-flex justify-content-center">
      <div class="col-md-6">
        <div class="card mb-3">
          <div class="card-body position-relative">
            <h3 class="card-title"><?= $data['title'] ?></h3>
            <p class="card-text mb-3"><?= $data['description'] ?>.</p>
            <span class="badge <?= $data['status'] == 'Active' ? 'text-bg-success' : ''  ?><?= $data['status'] == 'Planning' ? 'text-bg-primary' : ''  ?><?= $data['status'] == 'Finish' ? 'text-bg-danger' : ''  ?> "><?= $data['status'] == 'Active' ? 'Active' : ''  ?><?= $data['status'] == 'Planning' ? 'Planning' : ''  ?><?= $data['status'] == 'Finish' ? 'Finish' : ''  ?></span>
            <p class="card-text"><small>Created at <?= $data['start_time'] ?> to </small><small class="text-danger">Deadline <?= $data['deadline'] ?></small></p>
            <div class="row">
              <div class="col-6">
                <div class="d-grid">
                  <a href="#modal_edit_todo_<?= $data["id"]; ?>" class="btn btn-warning" data-bs-toggle="modal" role="button"><i class="fa-regular fa-pen-to-square"></i> Edit</a>
                </div>
              </div>
              <div class="col-6">
                <div class="d-grid">
                  <a href="delete.php?id=<?= $data["id"]; ?>" class="btn btn-danger" role="button" onclick="return confirm('Apakah data ingin di hapus?')"><i class="fa-regular fa-trash-can"></i> Delete</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>


    <!-- Modal Section Start -->
    <div class="modal fade" id="modal_edit_todo_<?= $data['id'] ?>" tabindex="-1" aria-labelledby="modalLabelToDo" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="modalLabelToDo">Edit Todo</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <form action="" method="post">
            <input type="hidden" name="id" value="<?= $data_todo['id'] ?>">
            <div class="modal-body">
              <div class="mb-3">
                <label for="title" class="form-label fw-bold">Title</label>
                <input type="text" name="title" class="form-control" id="title" required value="<?= $data_todo['title'] ?>">
              </div>
              <div class=" mb-3">
                <label class="form-check-label fw-bold" for="exampleCheck1">Status</label>
                <select name="status" class="form-control" id="status">
                  <option value="Active" <?= $data_todo['status'] == 'Active' ? 'selected' : '' ?>>Active</option>
                  <option value="Planning" <?= $data_todo['status'] == 'Planning' ? 'selected' : '' ?>>Planning</option>
                  <option value="Finish" <?= $data_todo['status'] == 'Finish' ? 'selected' : '' ?>>Finish</option>
                </select>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="mb-3">
                    <label for="start_time" class="form-label fw-bold">Start Time</label>
                    <input type="date" name="start_time" class="form-control" id="start_time" value="<?= $data_todo['start_time'] ?>">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="mb-3">
                    <label for="deadline" class="form-label fw-bold">Deadline</label>
                    <input type="date" name="deadline" class="form-control" id="deadline" required value="<?= $data_todo['deadline'] ?>">
                  </div>
                </div>
              </div>
              <div class="mb-3">
                <label for="description" class="form-label fw-bold">Description</label>
                <textarea name="description" id="description" class="form-control" cols="30" rows="10" required aria-valuetext="<?= $data_todo['description'] ?>"><?= $data_todo['description'] ?></textarea>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="submit" name="submit" class="btn btn-primary">Update</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <!-- Modal Section End -->

    <script src="../node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/js/all.min.js"></script>
</body>

</html>