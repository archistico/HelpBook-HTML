<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title> HelpBook | MOVIMENTO - NUOVO</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- Bootstrap 3.3.6 -->
        <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
        <!-- Ionicons -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
        <!-- daterange picker -->
        <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker-bs3.css">
        <!-- bootstrap datepicker -->
        <link rel="stylesheet" href="plugins/datepicker/datepicker3.css">
        <!-- iCheck for checkboxes and radio inputs -->
        <link rel="stylesheet" href="plugins/iCheck/all.css">
        <!-- Bootstrap Color Picker -->
        <link rel="stylesheet" href="plugins/colorpicker/bootstrap-colorpicker.min.css">
        <!-- Bootstrap time Picker -->
        <link rel="stylesheet" href="plugins/timepicker/bootstrap-timepicker.min.css">
        <!-- Select2 -->
        <link rel="stylesheet" href="plugins/select2/select2.min.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
        <!-- AdminLTE Skins. Choose a skin from the css/skins
             folder instead of downloading all of them to reduce the load. -->
        <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="hold-transition skin-blue sidebar-mini">
        <div class="wrapper">

            <header class="main-header">
                <!-- Logo -->
                <a href="index.php" class="logo">
                    <!-- mini logo for sidebar mini 50x50 pixels -->
                    <span class="logo-mini"><b>H</b>B</span>
                    <!-- logo for regular state and mobile devices -->
                    <span class="logo-lg"><b>HELP</b>BOOK</span>
                </a>
                <!-- Header Navbar: style can be found in header.less -->
                <nav class="navbar navbar-static-top">
                    <!-- Sidebar toggle button-->
                    <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                        <span class="sr-only">Toggle navigation</span>
                    </a>

                    <div class="navbar-custom-menu">
                        <ul class="nav navbar-nav">
                            <!-- User Account: style can be found in dropdown.less -->
                            <li class="dropdown user user-menu">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <img src="dist/img/avatar3.png" class="user-image" alt="User Image">
                                    <span class="hidden-xs">Emilie Rollandin</span>
                                </a>
                                <ul class="dropdown-menu">
                                    <!-- User image -->
                                    <li class="user-header">
                                        <img src="dist/img/avatar3.png" class="img-circle" alt="User Image">
                                        <p>
                                            Emilie Rollandin
                                            <small>Amministratore</small>
                                        </p>
                                    </li>
                                    <!-- Menu Footer-->
                                    <li class="user-footer">
                                        <div class="pull-right">
                                            <a href="#" class="btn btn-default btn-flat">Logout</a>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </nav>
            </header>
            <!-- Left side column. contains the logo and sidebar -->
            <aside class="main-sidebar">
                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">
                    <!-- sidebar menu: : style can be found in sidebar.less -->
                    <?php
                    include 'sidebarmenu.php';
                    ?>
                </section>
                <!-- /.sidebar -->
            </aside>

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->



                
                
                
                

                <?php
                // RECUPERO DATI E AGGIUNGO
                define('CHARSET', 'UTF-8');
                define('REPLACE_FLAGS', ENT_COMPAT | ENT_XHTML);
                
                $errorevisualizzazione = array();
                $erroreaggiunta = array();
                $errorecancella = array();
                
                abstract class tipoOperazione
                {
                    const nondefinita = 0;
                    const visualizza = 1;
                    const aggiungi = 2;
                    const cancella = 3;
                }
                
                $TipoOperazione = tipoOperazione::nondefinita;
                
                // Definisci il tipo di operazione
                if(isset($_GET['idmovimento']) && !(isset($_GET['idlibro']) && isset($_GET['quantita']) && isset($_GET['sconto'])) && !(isset($_GET['idmovimentodettaglio']))) {
                    $TipoOperazione = tipoOperazione::visualizza;
                }
                
                if((isset($_GET['idmovimento']) && isset($_GET['idlibro']) && isset($_GET['quantita']) && isset($_GET['sconto'])) && !(isset($_GET['idmovimentodettaglio']))) {
                    $TipoOperazione = tipoOperazione::aggiungi;
                }
                
                if(isset($_GET['idmovimento']) && !(isset($_GET['idlibro']) && isset($_GET['quantita']) && isset($_GET['sconto'])) && (isset($_GET['idmovimentodettaglio']))) {
                    $TipoOperazione = tipoOperazione::cancella;
                }
                
                // Carica le variabili
                if (!isset($_GET['idmovimento'])) {
                    $errorevisualizzazione['idmovimento'] = 'ID movimento';
                } else {
                    $idmovimento = $_GET['idmovimento'];
                }
                
                // SE AGGIUNGO
                if($TipoOperazione == tipoOperazione::aggiungi)
                {
                    if (empty($_GET['quantita']) || $_GET['quantita']==0 ) {
                        $erroreaggiunta['quantita'] = 'quantita';
                    } else {
                        $quantita = $_GET['quantita'];
                    }

                    if (!isset($_GET['idlibro'])) {
                        $erroreaggiunta['idlibro'] = 'ID libro';
                    } else {
                        $idlibro = $_GET['idlibro'];
                    }

                    if (!isset($_GET['sconto'])) {
                        $erroreaggiunta['sconto'] = 'sconto';
                    } else {
                        $sconto = $_GET['sconto'];
                    }

                    if(!empty($erroreaggiunta)) {
                        print "<div class='pad margin no-print'><div class='callout callout-danger' style='margin-bottom: 0!important;'><h4><i class='fa fa-ban'></i> Note:</h4>Errori ".implode(", ", $erroreaggiunta)."</div></div>";
                    }

                    if (empty($errorevisualizzazione) && empty($erroreaggiunta)) {
                        try {
                            include 'php/config.php';

                            $db = new PDO("mysql:host=" . $dbhost . ";dbname=" . $dbname, $dbuser, $dbpswd);
                            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
                            $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
                            $db->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, 'SET NAMES UTF8');

                            date_default_timezone_set('Europe/Rome');

                            $db->exec("INSERT INTO helpbookdb.movimentidettaglio (idmovimentodettaglio, fkmovimento, fklibro, quantita, sconto, cancellato) VALUES (NULL, '".$idmovimento."', '".$idlibro."', '".$quantita."', '".$sconto."', '0');");

                            // chiude il database
                            $db = NULL;
                            print "<div class='pad margin no-print'><div class='callout callout-success' style='margin-bottom: 0!important;'><h4><i class='fa fa-check'></i> Note:</h4>Aggiunto</div></div>";

                        } catch (PDOException $e) {
                            print "<div class='pad margin no-print'><div class='callout callout-danger' style='margin-bottom: 0!important;'><h4><i class='fa fa-ban'></i> Note:</h4>Errore con il database</div></div>";
                        }
                    }
                }
                
                
                // SE CANCELLO
                if($TipoOperazione == tipoOperazione::cancella)
                {
                    if (!isset($_GET['idmovimentodettaglio'])) {
                        $errorecancella['idmovimentodettaglio'] = 'idmovimentodettaglio';
                    } else {
                        $idmovimentodettaglio = $_GET['idmovimentodettaglio'];
                    }

                    if(!empty($errorecancella)) {
                        print "<div class='pad margin no-print'><div class='callout callout-danger' style='margin-bottom: 0!important;'><h4><i class='fa fa-ban'></i> Note:</h4>Errori ".implode(", ", $errorecancella)."</div></div>";
                    }

                    if (empty($errorevisualizzazione) && empty($erroreaggiunta)) {
                        try {
                            include 'php/config.php';

                            $db = new PDO("mysql:host=" . $dbhost . ";dbname=" . $dbname, $dbuser, $dbpswd);
                            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
                            $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
                            $db->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, 'SET NAMES UTF8');

                            date_default_timezone_set('Europe/Rome');

                            $db->exec("DELETE FROM helpbookdb.movimentidettaglio WHERE movimentidettaglio.idmovimentodettaglio = ".$idmovimentodettaglio.";");

                            // chiude il database
                            $db = NULL;
                            print "<div class='pad margin no-print'><div class='callout callout-success' style='margin-bottom: 0!important;'><h4><i class='fa fa-check'></i> Note:</h4>Eliminato</div></div>";

                        } catch (PDOException $e) {
                            print "<div class='pad margin no-print'><div class='callout callout-danger' style='margin-bottom: 0!important;'><h4><i class='fa fa-ban'></i> Note:</h4>Errore con il database</div></div>";
                        }
                    }
                }
                
                // SE NON SO COSA FARE
                if($TipoOperazione == tipoOperazione::nondefinita){
                    print "<div class='pad margin no-print'><div class='callout callout-danger' style='margin-bottom: 0!important;'><h4><i class='fa fa-ban'></i> Note:</h4>Operazione non definita</div></div>";
                }
                   
                ?>

                <section class="content-header">
                    <h1>
                        Movimento
                        <small>Codice: </small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="#">Movimenti</a></li>
                        <li class="active">Visualizza</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="invoice">
                    <!-- title row -->
                    <div class="row">
                        <div class="col-xs-12">
                            <h2 class="page-header">
                                <i class="fa fa-book"></i> Elmi's World - Casa Editrice
                                <p class="pull-right badge bg-orange">2016-FE-2015</p>
                            </h2>
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- info row -->
                    <div class="row invoice-info">
                        <div class="col-sm-4 invoice-col">
                            Mittente:
                            <h2>Elmi's World</h2>
                            <address>
                                via Guillet, 6<br>
                                11027 Saint Vincent<br>
                                Tel: 388 92 07 016<br>
                                Email: info@elmisworld.it<br>
                                P.IVA: 011 463 700 75<br>
                                C.F.: GRP LTR 82P47 Z126 I
                            </address>
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-4 invoice-col">
                            Destinatario:
                            <h2>5Rue Maillet s.a.s.</h2>
                            <address>
                                via Guillet, 6<br>
                                11027 Saint Vincent<br>
                                Tel: 388 92 07 016<br>
                                Email: info@elmisworld.it<br>
                                P.IVA: 011 463 700 75<br>
                                C.F.: GRP LTR 82P47 Z126 I
                            </address>
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-4 invoice-col">
                            Documento:
                            <h2>2016-FI-001</h2>
                            <b>Tipologia:</b> Fattura immediata<br>
                            <b>Causale:</b> Vendita<br>
                            <b>Data emissione:</b> 01/01/2016<br>
                            <b>Riferimento:</b> ORD. 2016/1564<br>
                            <b>Aspetto:</b> Busta<br>
                            <b>Trasporto:</b> Vettore Poste Italiane
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->

                    <!-- Table row -->
                    <div class="row">
                        <div class="col-xs-12 table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th style='width: 40px'>Qt.</th>
                                        <th>Titolo del libro</th>
                                        <th style='width: 150px'>ISBN</th>
                                        <th style='width: 120px'>Prezzo</th>
                                        <th style='width: 120px'>Sconto</th>
                                        <th style='width: 120px'>Prezzo scontato</th>
                                        <th style='width: 120px'>Subtotale</th>
                                        <th style='width: 40px'></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>100</td>
                                        <td>STORIA ELETTORALE DELLA VALLE D'AOSTA</td>
                                        <td>978-88-97192-64-0</td>
                                        <td>&euro; 999,99</td>
                                        <td>100,00 %</td>
                                        <td>&euro; 999,99</td>
                                        <td>&euro; 9999,99</td>
                                        <td><div class = 'btn-group'><a class='btn btn-xs btn-danger' href='' role='button'><i class = 'fa fa-remove'></i></a></div></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                    
                    
                    
                    <form role="form" name="movimentoForm" action="movimentovisualizza.php" method="get">
                        <div class="row">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Quantità</label>
                                    <input type="number" min="0" max="1000" step="1" class="form-control" placeholder="Qt" value="0" name='quantita' required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Libro</label>
                                    <select class="form-control select2" style="width: 100%;" name='idlibro' required>
                                        <?php
                                        include 'php/libri.php';
                                        libriSelect();
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Sconto %</label>
                                    <input type="number" min="0" max="100" step="0.01" class="form-control" placeholder="Sconto" value="0" name='sconto' required>
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-group">
                                    <input type="hidden" name="idmovimento" value="<?php echo $_GET['idmovimento']; ?>">
                                    <label>Aggiungi nuovo libro al movimento</label>
                                    <button type="submit" class="btn btn-primary btn-block" style="margin-right: 5px;">
                                        <i class="fa fa-download"></i> AGGIUNGI
                                    </button>
                                </div>
                            </div>
                            <!-- /.col -->
                        </div>
                    </form>
                    
                    
                    
                    

                    <div class="row">
                        <!-- accepted payments column -->
                        <div class="col-xs-6">
                            <p class="lead">Pagamento:</p>


                            <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
                                C.C. BancoPosta intestato a Elettra Groppo<br>
                                IBAN: IT78 L076 0101 2000 0101 8616 480
                            </p>
                            <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
                                * Riferimenti di legge IVA ASSOLTA DALL'EDITORE ART. 74 DPR 633/72
                            </p>
                        </div>
                        <!-- /.col -->
                        <div class="col-xs-6">
                            <p class="lead">Da pagare entro: 01/01/2016</p>

                            <div class="table-responsive">
                                <table class="table">
                                    <tr>
                                        <th style="width:50%">Totale imponibile:</th>
                                        <td>&euro; 100,00</td>
                                    </tr>
                                    <tr>
                                        <th>Sconto:</th>
                                        <td>&euro; 100,00</td>
                                    </tr>
                                    <tr>
                                        <th>Totale IVA:</th>
                                        <td>&euro; 100,00</td>
                                    </tr>
                                    <tr>
                                        <th>TOTALE SCONTATO:</th>
                                        <td>&euro; 100,00</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->

                    <!-- this row will not appear when printing -->
                    <div class="row no-print">
                        <div class="col-xs-12">
                            <a href="" target="_blank" class="btn btn-default"><i class="fa fa-print"></i> Stampa</a>
                            <button type="button" class="btn btn-primary pull-right" style="margin-right: 5px;">
                                <i class="fa fa-download"></i> CREA PDF
                            </button>
                        </div>
                    </div>
                </section>
                <!-- /.content -->
                <div class="clearfix"></div>
            </div>
            <!-- /.content-wrapper -->
            <footer class="main-footer">
                <div class="pull-right hidden-xs">
                    <b>Version</b> 0.0.1
                </div>
                <strong>Copyright &copy; 2016 <a href="http://www.archistico.com">Archistico</a></strong> All rights reserved. - Theme by Almsaeed Studio
            </footer>
        </div>
        <!-- ./wrapper -->

        <!-- jQuery 2.2.0 -->
        <script src="plugins/jQuery/jQuery-2.2.0.min.js"></script>
        <!-- Bootstrap 3.3.6 -->
        <script src="bootstrap/js/bootstrap.min.js"></script>
        <!-- Select2 -->
        <script src="plugins/select2/select2.full.min.js"></script>
        <!-- InputMask -->
        <script src="plugins/input-mask/jquery.inputmask.js"></script>
        <script src="plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
        <script src="plugins/input-mask/jquery.inputmask.extensions.js"></script>
        <!-- date-range-picker -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
        <script src="plugins/daterangepicker/daterangepicker.js"></script>
        <!-- bootstrap datepicker -->
        <script src="plugins/datepicker/bootstrap-datepicker.js"></script>
        <!-- bootstrap color picker -->
        <script src="plugins/colorpicker/bootstrap-colorpicker.min.js"></script>
        <!-- bootstrap time picker -->
        <script src="plugins/timepicker/bootstrap-timepicker.min.js"></script>
        <!-- SlimScroll 1.3.0 -->
        <script src="plugins/slimScroll/jquery.slimscroll.min.js"></script>
        <!-- iCheck 1.0.1 -->
        <script src="plugins/iCheck/icheck.min.js"></script>
        <!-- FastClick -->
        <script src="plugins/fastclick/fastclick.js"></script>
        <!-- AdminLTE App -->
        <script src="dist/js/app.min.js"></script>
        <!-- AdminLTE for demo purposes -->
        <script src="dist/js/demo.js"></script>
        <!-- Page script -->
        <script>
            $(function () {
                //Initialize Select2 Elements
                $(".select2").select2(); 
            });
        </script>
    </body>
</html>

