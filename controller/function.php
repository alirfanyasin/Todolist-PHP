<?php
include 'connect.php';

// Get Data
function query($query)
{
  global $connect;
  $result = mysqli_query($connect, $query);
  $rows = [];
  while ($row = mysqli_fetch_assoc($result)) {
    $rows[] = $row;
  }
  return $rows;
}


// Add Data
function add($data)
{
  global $connect;
  $title = htmlspecialchars($data['title']);
  $description = htmlspecialchars($data['description']);
  $status = htmlspecialchars($data['status']);
  $start_time = htmlspecialchars($data['start_time']);
  $deadline = htmlspecialchars($data['deadline']);
  mysqli_query($connect, "INSERT INTO todo VALUES('','$title', '$description', '$status', '$start_time', '$deadline')");
  return mysqli_affected_rows($connect);
}

// Detail Data
function detail($id)
{
  global $connect;
  $query_SQL = "SELECT * FROM todo WHERE id = $id";
  $result = mysqli_query($connect, $query_SQL);
  $data = mysqli_fetch_assoc($result);
  return $data;
}

// Edit and Update Data
function edit($data)
{
  global $connect;
  $id = $data["id"];
  $title = htmlspecialchars($data["title"]);
  $description = htmlspecialchars($data["description"]);
  $status = htmlspecialchars($data["status"]);
  $start_time = htmlspecialchars($data["start_time"]);
  $deadline = htmlspecialchars($data["deadline"]);

  $query = "UPDATE todo SET 
          title = '$title',
          description = '$description',
          status = '$status',
          start_time = '$start_time',
          deadline = '$deadline'
          WHERE id = $id
          ";
  mysqli_query($connect, $query);
  return mysqli_affected_rows($connect);
}


// Delete Data
function delete($id)
{
  global $connect;
  $query = "DELETE FROM todo WHERE id = $id";
  mysqli_query($connect, $query);
  return mysqli_affected_rows($connect);
}
