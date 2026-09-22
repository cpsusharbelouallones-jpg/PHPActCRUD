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
    ?>
    <div class="m-10">
        <h1 class="text-2xl font-bold mb-4">My First PHP Page</h1>

        <form action="create.php" method="post">
            <input type="text" name="first_name" class=" border">
            <input type="text" name="last_name" class=" border">

            <input type="submit" value="submit" class=" border bg-blue-500 text-white px-4 py-2 rounded-sm hover:bg-blue-600">
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
        <table class="table-auto border-collapse border border-gray-300">
            <tr class="bg-gray-200">
                <th class="border border-gray-300 px-4 py-2">ID</th>
                <th class="border border-gray-300 px-4 py-2">First Name</th>
                <th class="border border-gray-300 px-4 py-2">Last Name</th>
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
                        '<td class="border border-gray-300 px-4 py-2">' . $row["first_name"] . '</td>' .
                        '<td class="border border-gray-300 px-4 py-2">' . $row["last_name"] . '</td>' .
                        '<td class="border border-gray-300 px-4 py-2">' .
                            '<a href="update.php?id=' . $row["id"] . '" class="text-blue-600 hover:underline">Edit</a> | ' .
                            '<a href="delete.php?id=' . $row["id"] . '" class="text-red-600 hover:underline">Delete</a>' .
                        '</td>' .
                    '</tr>';
            }
            
        } else {
            echo "0 results found";
        }
        ?>
        </table>
    </div>
</body>
</html>