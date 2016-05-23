<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        <link rel="stylesheet" href="../styles/style_main_page.css" media="screen" title="no title" charset="utf-8">
        <link rel="stylesheet" href="../styles/style_table.css" media="screen" title="no title" charset="utf-8">
        <link rel="stylesheet" href="../styles/style_side_menu.css" media="screen" title="no title" charset="utf-8">
        <title></title>
    </head>
    <body>

        <div class="container-fluid" id="div-main-container">

            <!-- Lehe tiitel -->

            <div class="jumbotron title">
              <h1># Kontaktide register</h1>
            </div>

            <!-- Vasak menüü -->

            <div class="row content">
                <div class="col-sm-2 sidenav" id="div-menu-main" style="display:block; background-color: white;">
                    <h2>Kontaktid</h2>
                    <button type="button" class="btn btn-success btn-block" id="button-menu-new-contact" onclick="configHideShow('#div-add-main')">Lisa uus kontakt</button>

                    <!-- Kontaktide nimede list -->

                    <div id="div-menu-list">
                    </div>
                    <div class="input-group">
                        <input type="text" class="form-control" id="input-menu-search" placeholder="Otsi ...">
                        <span class="input-group-btn">
                            <button class="btn btn-default" type="button">
                                <span class="glyphicon glyphicon-search"></span>
                            </button>
                        </span>
                    </div>

                    <!-- Välja logimine -->

                    <form method="post"  action="<?= $_SERVER['PHP_SELF']; ?>">
                        <input type="hidden" name="csrf_token" id="csrf_token" value="<?= $_SESSION['csrf_token']; ?>">
                        <input type="hidden" name="action" value="logout">
                        <button type="submit" class="btn btn-warning btn-block">Logi välja</button>
                    </form>
                </div>

                <!-- Kontakti lisamise vorm -->

                <div class="col-sm-10 sidenav" id="div-add-main" style="display:none; background-color: white;">
                    <div class="container">
                        <h2>Uus kontakt</h2>
                        <form class="form-horizontal" id="form-add-contact" role="form">
                            <div class="form-group">
                                <label class="control-label col-sm-2" for="input-add-fn">Eesnimi:</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" id="input-add-fn" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-2" for="input-add-ln">Perekonnanimi:</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" id="input-add-ln">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-2" for="select-add-category">Kategooria:</label>
                                <div class="col-sm-6">
                                    <select type="text" class="form-control" id="select-add-category">
                                        <option value="" disabled selected></option>
                                        <option value="Perekond">Perekond</option>
                                        <option value="Kool">Kool</option>
                                        <option value="Töö">Töö</option>
                                        <option value="Muu">Muu</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-2" for="input-add-phone">Sünnikuupäev:</label>
                                <div class="col-sm-2">
                                    <input type="number" class="form-control" id="select-add-day" placeholder="pp" min="1" max="31">
                                </div>
                                <div class="col-sm-2">
                                    <input type="number" class="form-control" id="select-add-month" min="1" max="12" placeholder="kk" min="1" max="12">
                                </div>
                                <div class="col-sm-2">
                                    <input type="number" class="form-control" id="select-add-year" min="1900" placeholder="aaaa" min="1990">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-2" for="input-add-phone">Telefon:</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" id="input-add-phone">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-2" for="input-add-email">Email:</label>
                                <div class="col-sm-6">
                                    <input type="email" class="form-control" id="input-add-email">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-6">
                                    <button type="button" class="btn btn-primary btn-block" id="button-add">Lisa</button>
                                    <button type="button" class="btn btn-success btn-block" id="button-menu-new-contact" onclick="configHideShow('#div-table')">Pealehele</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Kontaktide tabel -->

                <div class="col-sm-10" id="div-table" style="display:block; background-color: white;">
                    <h2>Kõik kontaktid</h2>
                    <div class="container">
                        <table class="table table-bordered">

                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Eesnimi</th>
                                    <th>Perekonnanimi</th>
                                    <th>Vanus</th>
                                    <th>Telefoninumber</th>
                                    <th>Email</th>
                                    <th>Kategooria</th>
                                    <th colspan="2"></th>
                                </tr>
                            </thead>

                            <!-- Tabeli body -->

                            <tbody id="tbody-contacts-list">
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
        </div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
        <script type="text/javascript" src="../scripts/script_add_del_contact.js"></script>
        <script type="text/javascript" src="../scripts/script_main.js"></script>
        <script type="text/javascript" src="../scripts/script_table.js"></script>
    </body>
</html>
