<?php
session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Securly District Admin Portal</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    </head>
    <body>
        <nav class="navbar navbar-inverse">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand" href="#">Securly</a>
                </div>
            </div>
        </nav>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6">
                    <?php
                    if (isset($_SESSION['msg']) && $_SESSION['msg'] != NULL) {
                        echo '<div class="alert alert-danger">';
                        echo $_SESSION['msg'];
                        echo '</div>';
                        $_SESSION['msg'] = NULL;
                    } else {
                        session_unset();
                        session_destroy();
                    }
                    ?>
                    <form id="loginForm" method="POST" action="loginConn.php" class="text-center">
                        <div class="form-group">
                            <input type="text" class="form-control" name="user"
                                   placeholder="User ID" required />
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" name="pass" placeholder="Password" required />
                        </div>
                        <input type="submit" id="login" value="Sign in" class="btn btn-default" />
                    </form>
                </div>
                <div class="col-md-3"></div>
            </div>
        </div>
        </br>
        <footer class="container-fluid text-center">
            <p>Securly &copy; <?php echo date("Y"); ?></p>
        </footer>
    </body>
</html>
