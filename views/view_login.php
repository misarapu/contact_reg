<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Login</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        <link rel="stylesheet" href="../styles/style_log_reg.css" media="screen" title="no title" charset="utf-8">
    </head>
    <body background="../images/back.png">

        <div class="container">

            <!-- Tiitel -->

            <div class="jumbotron title">
                <h1># Kontaktide register</h1>
            </div>
            <?php foreach (message_list() as $message):?>
                <p style="border: 1px solid blue; background: #EEE;">
                    <?= $message; ?>
                </p>
            <?php endforeach; ?>
            <div class="col-sm-4 col-sm-offset-4" style="background-color:white; border: 1px dashed #f2f2f2; padding: 50px">

                <h2>Logi sisse</h2>
                <form role="form"  method="post" action="<?= $_SERVER['PHP_SELF']; ?>">
                    <input type="hidden" name="action" value="login">

                    <!-- Sisselogmise vorm -->

                    <div class="form-group">
                        <label for="username">Kasutajanimi:</label>
                        <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token']; ?>">
                        <input type="text" class="form-control" id="username" name="username" placeholder="Sisesta kasutajanimi" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Salasõna:</label>
                        <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token']; ?>">
                        <input type="password" class="form-control" id="password" name="password" placeholder="Sisesta salasõna" required>
                    </div>
                    <p>
                        <button type="submit" class="btn btn-default">Logi sisse</button>
                        või
                        <a href="<?= $_SERVER['PHP_SELF']; ?>?view=register">registreeri konto</a>
                    </p>
                </form>

            </div>
        </div>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    </body>
</html>
