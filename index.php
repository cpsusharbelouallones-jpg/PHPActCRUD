<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
  <title>Besul</title>
</head>

<body>
  <?php
  include 'db_connect.php';

  if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $edit_result = mysqli_query($conn, "SELECT * FROM students WHERE id = $id");
    if (mysqli_num_rows($edit_result) == 1) {
      $student = mysqli_fetch_assoc($edit_result);
    }
  }
  ?>
  <div class="flex justify-center items-center min-h-screen bg-gray-100">
    <div class="m-10 w-96 bg-white p-6 rounded-lg shadow-md flex justify-center items-center flex-col">
      <h1 class="text-2xl font-bold mb-5"><?= isset($student) ? 'Edit Student' : 'Add Student' ?></h1>
      


      <form action="create.php" method="post" class="flex flex-col gap-4 w-full max-w-sm">
        <?php if (isset($student)): ?>
          <input type="hidden" name="id" value="<?= $student['id'] ?>">
        <?php endif; ?>
        <input type="text" name="username" value="<?= isset($student) ? htmlspecialchars($student['username']) : '' ?>" class=" border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 rounded-md p-2" placeholder="Username">
        <input type="password" name="password" value="<?= isset($student) ? htmlspecialchars($student['password']) : '' ?>" class=" border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 rounded-md p-2" placeholder="Password">

        <input type="submit" value="Submit" class=" uppercase border bg-blue-500 text-white px-4 py-2 rounded-sm hover:bg-blue-600">
        <a href="index.php" class="text-blue-600 hover:underline">Create New Student</a>
      </form>

      <div class="mb-4">
        <?php
        if (isset($_GET['created']) && $_GET['created'] == 1) {
          echo '<p class="text-green-500 mb-4">Record created successfully!</p>';
        } else if (isset($_GET['created']) && $_GET['created'] == 0) {
          echo '<p class="text-red-500 mb-4">Error creating record.</p>';
        }
        ?>
      </div>
    </div>
    <div class="m-10">
      <table class="table-auto border-collapse border border-gray-300 rounded-lg overflow-hidden w-full max-w-4xl bg-white shadow-md overflow-x-auto">
        <tr class="bg-gray-200">
          <th class="border border-gray-300 px-4 py-2">ID</th>
          <th class="border border-gray-300 px-4 py-2">Username</th>
          <th class="border border-gray-300 px-4 py-2">Password</th>
          <th class="border border-gray-300 px-4 py-2">Actions</th>
        </tr>
        <?php
        $sql = "SELECT * FROM students";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {

          // Loop through each row of data
          while ($row = mysqli_fetch_assoc($result)) {
            echo '<tr>' .
              '<td class="border border-gray-300 px-4 py-2">' . $row["id"] . '</td>' .
              '<td class="border border-gray-300 px-4 py-2">' . $row["username"] . '</td>' .
              '<td class="border border-gray-300 px-4 py-2">' . $row["password"] . '</td>' .
              '<td class="border border-gray-300 px-4 py-2">' .
              '<a href="index.php?id=' . $row["id"] . '" class="text-blue-600 hover:underline">Edit</a> | ' .
              '<a href="delete.php?id=' . $row["id"] . '" class="text-red-600 hover:underline">Delete</a>' .
              '</td>' .
              '</tr>';
          }
        } else {
          echo '<p class="text-gray-500 mb-4">No students found.</p>';
        }
        ?>
      </table>
    </div>
  </div>
</body>

</html>