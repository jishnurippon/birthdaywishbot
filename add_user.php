<?php require 'db.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Add User</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/bootstrap.bundle.min.js" ></script>
</head>
<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">Birthday Mailer</a>
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
        <div class="col-md-6 rounded mx-auto d-block bg-body-tertiary p-4">
            <h3 class="p4 mt-4 mb-3 text-center">Add New User</h3>
            <form method="POST">
                <div class="mb-3">
                    <label class="form-label">Name</label>
                    <input type="text" class="form-control" name="name" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" class="form-control" name="email" required>
                </div>
                <div class="mb-3">
                    <label class="form-label"></label>
                    <input type="date" class="form-control" name="birthdate" required>
                </div>
                <div class="p4 mt-4 mb-3 text-center">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>


<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = $pdo->prepare("INSERT INTO users (name, email, birthdate) VALUES (?, ?, ?)");
    $stmt->execute([$_POST['name'], $_POST['email'], $_POST['birthdate']]);
    echo "<script>
    alert('Updated successfully.');
    window.location.href = 'index.php';
    </script>";
}
?>