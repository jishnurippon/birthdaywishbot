<?php
    require 'db.php';
    $stmt = $pdo->query("SELECT * FROM users");
    if (isset($_GET['delete'])) {
        $id = $_GET['delete'];
        $stmt = $pdo->prepare("DELETE FROM users WHERE id = :id");
        $stmt->execute(['id' => $id]);
        header("Location: index.php");
        exit();
    }
?>
<!DOCTYPE html>
<html>
<head>
    <title>Birthday Mailer</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/bootstrap.bundle.min.js" ></script>
    <link href="css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="">Birthday Mailer</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
                <a class="nav-link" href="add_user.php">Add User</a>
                <a class="nav-link" href="log.php">View Logs</a>
                <a class="nav-link" href="send_birthday_wishes.php">Send</a>
            </div>
            </div>
        </div>
    </nav>
    <div class="row m-4">
        <div class="col-md-10 rounded mx-auto d-block bg-body-tertiary p-4">
            <h3 class="p4 mt-4 mb-4 text-center">Staff data</h3>
            <table class="table table-striped p-2">
                <thead>
                    <tr class="table-dark">
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">B day</th>
                    <th scope="col">Last MSG send</th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $sNum = 1;
                        foreach ($stmt as $row) {
                        ?>
                        <tr>
                            <td><?php echo $sNum ?></td>
                            <td><?php echo $row['name'] ?></td>
                            <td><?php echo $row['email'] ?></td>
                            <td><?php echo $row['birthdate'] ?></td>
                            <td><?php echo $row['last_sent'] ?></td>
                            <td>
                                <a href="edit.php?id=<?= $row['id']; ?>">
                                    <i class="bi bi-pencil-square"></i>  
                                </a>
                            </td>
                            <td>
                                <a href="?delete=<?= $row['id']; ?>" onclick="return confirm('Delete this user?');">
                                    <i class="bi bi-trash3-fill text-warning"></i>
                                </a>
                            </td>
                            <td>
                                <a href="sentmanual.php?id=<?= $row['id']; ?>">
                                    <i class="bi bi-envelope-paper-heart text-danger"></i>
                                </a>
                            </td>
                        </tr>
                    <?php $sNum++; }?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>