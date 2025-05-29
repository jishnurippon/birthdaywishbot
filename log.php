<?php
    require 'db.php';
    $stmt = $pdo->query("SELECT * FROM email_logs ORDER BY sent_at DESC");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Birthday Mailer</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
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
        <div class="col-md-10 rounded mx-auto d-block bg-body-tertiary p-4">
            <h3 class="p4 mt-4 mb-4 text-center">Mail delivery update</h3>
          <table class="table table-striped p-2">
            <thead>
                <tr class="table-dark">
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Status</th>
                <th scope="col">Time</th>
                <th scope="col">Message</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $sNum = 1;
                    foreach ($stmt as $row) {
                        echo "<tr><td>{$sNum}</td><td>{$row['name']}</td><td>{$row['status']}</td><td>{$row['sent_at']}</td><td>{$row['message']}</td></tr>";
                        $sNum++;
                    }
                ?>
            </tbody>
          </table>
        </div>
    </div>
</body>
</html>