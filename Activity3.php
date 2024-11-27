<?php

$roleCredentials = [
    "admin" => [
        ["username" => "Admin", "password" => "Pass1234"],
        ["username" => "Renmark", "password" => "Pogi1234"]
    ],
    "contentManager" => [
        ["username" => "pepito", "password" => "manaloto"],
        ["username" => "juan", "password" => "delacruz"]
    ],
    "systemUser" => [
        ["username" => "pedro", "password" => "penduko"]
    ]
];

$errorFeedback = '';
$successFeedback = '';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $selectedRole = $_POST['roleSelect'] ?? '';
    $inputUsername = $_POST['inputUsername'] ?? '';
    $inputPassword = $_POST['inputPassword'] ?? '';

    
    if (!$selectedRole) {
        $errorFeedback = 'Please select a role.';
    } elseif (!$inputUsername || !$inputPassword) {
        $errorFeedback = 'Both username and password are required.';
    } else {
        
        if (isset($roleCredentials[$selectedRole])) {
            $isAuthenticated = false;
            foreach ($roleCredentials[$selectedRole] as $user) {
                if ($user['username'] === $inputUsername && $user['password'] === $inputPassword) {
                    $isAuthenticated = true;
                    break;
                }
            }

            
            if ($isAuthenticated) {
                $successFeedback = "Welcome, $inputUsername!";
            } else {
                $errorFeedback = 'Invalid username or password.';
            }
        } else {
            $errorFeedback = 'Invalid role selected.';
        }
    }
}

?>

<!DOCTYPE HTML>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="css/custom-login.css">
    <title>Login Page</title>
    <style>
        .alert {
            position: fixed;
            top: 20px;
            left: 50%;
            transform: translateX(-50%);
            z-index: 9999;
            width: 300px;
            padding: 15px;
            font-size: 16px;
            text-align: center;
        }
        .alert .close {
            position: absolute;
            top: 5px;
            right: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        
        <?php if ($errorFeedback): ?>
        <div id="error-message" class="alert alert-danger alert-dismissible fade show">
            <strong>Error!</strong> <?= $errorFeedback; ?>
            <button type="button" class="close" aria-label="Close" onclick="this.parentElement.style.display='none';">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <?php endif; ?>

        <?php if ($successFeedback): ?>
        <div id="success-message" class="alert alert-success alert-dismissible fade show">
            <strong>Success!</strong> <?= $successFeedback; ?>
            <button type="button" class="close" aria-label="Close" onclick="this.parentElement.style.display='none';">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <?php endif; ?>

        <div class="card card-container" style="margin-top: 100px;">
            <img id="profile-img" class="profile-img-card" src="img/icon.png" />
            <form class="form-signin" method="POST" action="">
                <select class="form-control mb-3" name="roleSelect">
                    <option value=""></option>
                    <option value="admin" <?= isset($selectedRole) && $selectedRole === 'admin' ? 'selected' : ''; ?>>Admin</option>
                    <option value="contentManager" <?= isset($selectedRole) && $selectedRole === 'contentManager' ? 'selected' : ''; ?>>Content Manager</option>
                    <option value="systemUser" <?= isset($selectedRole) && $selectedRole === 'systemUser' ? 'selected' : ''; ?>>System User</option>
                </select>

                <input type="text" name="inputUsername" class="form-control" placeholder="Username" value="<?= htmlspecialchars($inputUsername ?? '') ?>" required>

                <input type="password" name="inputPassword" class="form-control" placeholder="Password" required>

                <button class="btn btn-lg btn-primary btn-block btn-signin" type="submit">Login</button>
            </form>
        </div>
    </div>

    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
