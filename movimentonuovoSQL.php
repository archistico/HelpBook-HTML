<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title> HelpBook | MOVIMENTO - AGGIUNGI AL DATABASE</title>
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








                <section class="content-header">
                    <h1>
                        MOVIMENTO
                        <small>NUOVO</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="#">Movimenti</a></li>
                        <li class="active">Nuovo</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    
     
                    
                    
                    
                    <!-- **********************************CONTENUTO****************************** -->
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">INSERIMENTO DATABASE</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-6">
                                    
                                    
                                    
                                    
                                    
                                    <?php
                                    
                                    // RECUPERO DATI E AGGIUNGO
                                    define('CHARSET', 'UTF-8');
                                    define('REPLACE_FLAGS', ENT_COMPAT | ENT_XHTML);

                                    $errors = array();
                                    
                                    if (empty($_GET['cliente'])) {
                                        $errors['cliente'] = 'ID cliente non passato';
                                    } else {
                                        $cliente = $_GET['cliente'];
                                    }

                                    if (empty($_GET['dataEmissione'])) {
                                        $errors['dataEmissione'] = 'dataEmissione non passato';
                                    } else {
                                        $dataEmissione = DateTime::createFromFormat('d/m/Y', $_GET['dataEmissione']);
                                    }

                                    if (empty($_GET['tipologia'])) {
                                        $errors['tipologia'] = 'tipologia non passato';
                                    } else {
                                        $tipologia = $_GET['tipologia'];
                                    }

                                    if (empty($_GET['causale'])) {
                                        $errors['causale'] = 'causale non passato';
                                    } else {
                                        $causale = $_GET['causale'];
                                    }

                                    if (!isset($_GET['riferimento'])) {
                                        $riferimento = '-';
                                    } else {
                                        $riferimento = $_GET['riferimento'];
                                    }

                                    if (!isset($_GET['spedizione'])) {
                                        $errors['spedizione'] = 'spedizione non passato';
                                    } else {
                                        $spedizione = $_GET['spedizione'];
                                    }

                                    if (!isset($_GET['spedizionesconto'])) {
                                        $errors['spedizionesconto'] = 'spedizionesconto non passato';
                                    } else {
                                        $spedizionesconto = $_GET['spedizionesconto'];
                                    }

                                    if (empty($_GET['trasporto'])) {
                                        $errors['trasporto'] = 'trasporto non passato';
                                    } else {
                                        $trasporto = $_GET['trasporto'];
                                    }

                                    if (empty($_GET['aspetto'])) {
                                        $errors['aspetto'] = 'aspetto non passato';
                                    } else {
                                        $aspetto = $_GET['aspetto'];
                                    }

                                    if (empty($_GET['modalita'])) {
                                        $errors['modalita'] = 'modalita non passato';
                                    } else {
                                        $modalita = $_GET['modalita'];
                                    }

                                    if (empty($_GET['dataEntro'])) {
                                        $errors['dataEntro'] = 'dataEntro non passato';
                                    } else {
                                        $dataEntro = DateTime::createFromFormat('d/m/Y', $_GET['dataEntro']);
                                    }

                                    if (!isset($_GET['pagato'])) {
                                        $errors['pagato'] = 'pagato non passato';
                                    } else {
                                        $pagato = $_GET['pagato'];
                                    }

                                    if (empty($_GET['dataPagamento'])) {
                                        //
                                    } else {
                                        $dataPagamento = DateTime::createFromFormat('d/m/Y', $_GET['dataPagamento']);
                                    }

                                    if (!isset($_GET['note'])) {
                                        $note = '-';
                                    } else {
                                        $note = $_GET['note'];
                                    }

                                    if (empty($errors)) {
                                        try {
                                            include 'php/config.php';
                                            
                                            $db = new PDO("mysql:host=" . $dbhost . ";dbname=" . $dbname, $dbuser, $dbpswd);
                                            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
                                            $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
                                            $db->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, 'SET NAMES UTF8');

                                            date_default_timezone_set('Europe/Rome');

                                            $result = $db->query("SELECT MAX(numero) AS ultimo FROM movimenti WHERE anno = '" . $dataEmissione->format('Y') . "' AND fktipologia = " . $tipologia . "");
                                            $row = $result->fetch(PDO::FETCH_ASSOC);
                                            $numero = $row['ultimo'] + 1;

                                            if (!isset($dataPagamento)) {
                                                $db->exec("INSERT INTO helpbookdb.movimenti (idmovimento, fktipologia, fkcausale, numero, anno, riferimento, fksoggetto, movimentodata, pagamentoentro, pagata, fkpagamentotipologia, datapagamento, spedizionecosto, spedizionesconto, fkaspetto, fktrasporto, note, cancellato) VALUES (NULL, '" . $tipologia . "', '" . $causale . "', '" . $numero . "', '" . $dataEmissione->format('Y') . "', '" . $riferimento . "', '" . $cliente . "', '" . $dataEmissione->format('Y-m-d') . "', '" . $dataEntro->format('Y-m-d') . "', '" . $pagato . "', '" . $modalita . "', NULL, '" . $spedizione . "', '" . $spedizionesconto . "', '" . $aspetto . "', '" . $trasporto . "', '" . $note . "', '0');");
                                            } else {
                                                $db->exec("INSERT INTO helpbookdb.movimenti (idmovimento, fktipologia, fkcausale, numero, anno, riferimento, fksoggetto, movimentodata, pagamentoentro, pagata, fkpagamentotipologia, datapagamento, spedizionecosto, spedizionesconto, fkaspetto, fktrasporto, note, cancellato) VALUES (NULL, '" . $tipologia . "', '" . $causale . "', '" . $numero . "', '" . $dataEmissione->format('Y') . "', '" . $riferimento . "', '" . $cliente . "', '" . $dataEmissione->format('Y-m-d') . "', '" . $dataEntro->format('Y-m-d') . "', '" . $pagato . "', '" . $modalita . "', '" . $dataPagamento->format('Y-m-d') . "', '" . $spedizione . "', '" . $spedizionesconto . "', '" . $aspetto . "', '" . $trasporto . "', '" . $note . "', '0');");
                                            }



                                            // chiude il database
                                            $db = NULL;
                                        } catch (PDOException $e) {
                                            $errors['database'] = "Errore inserimento nel database";
                                        }
                                    }

                                    if (!empty($errors)) {
                                        echo "<div class='alert alert-danger alert-dismissible'><h4><i class='icon fa fa-ban'></i> ATTENZIONE!</h4>Ci sono degli errori</div>";
                                    } else {
                                        echo "<div class='alert alert-success alert-dismissible'><h4><i class='icon fa fa-check'></i> OK!</h4>Inserimento riuscito</div>";
                                    }

                                    ?>


                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                </div>
                                <!-- /.col -->

                                <div class="col-md-6">
                                    
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- /.row -->

                        </div>
                        <!-- /.box-body -->

                    </div>
                    <!-- /.box -->
                    
                    






                </section>
                <!-- /.content -->
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

                //Datemask dd/mm/yyyy
                $("#datemask").inputmask("dd/mm/yyyy", {"placeholder": "dd/mm/yyyy"});
                //Datemask2 mm/dd/yyyy
                $("#datemask2").inputmask("mm/dd/yyyy", {"placeholder": "mm/dd/yyyy"});
                //Money Euro
                $("[data-mask]").inputmask();

                //Date range picker
                $('#reservation').daterangepicker();
                //Date range picker with time picker
                $('#reservationtime').daterangepicker({timePicker: true, timePickerIncrement: 30, format: 'MM/DD/YYYY h:mm A'});
                //Date range as a button
                $('#daterange-btn').daterangepicker(
                        {
                            ranges: {
                                'Today': [moment(), moment()],
                                'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                                'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                                'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                                'This Month': [moment().startOf('month'), moment().endOf('month')],
                                'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                            },
                            startDate: moment().subtract(29, 'days'),
                            endDate: moment()
                        },
                        function (start, end) {
                            $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
                        }
                );

                //Date picker
                $('#datepicker1').datepicker({
                    autoclose: true
                });
                
                //Date picker
                $('#datepicker2').datepicker({
                    autoclose: true
                });
                
                //Date picker
                $('#datepicker3').datepicker({
                    autoclose: true
                });
                
                //iCheck for checkbox and radio inputs
                $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
                    checkboxClass: 'icheckbox_minimal-blue',
                    radioClass: 'iradio_minimal-blue'
                });
                //Red color scheme for iCheck
                $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
                    checkboxClass: 'icheckbox_minimal-red',
                    radioClass: 'iradio_minimal-red'
                });
                //Flat red color scheme for iCheck
                $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
                    checkboxClass: 'icheckbox_flat-green',
                    radioClass: 'iradio_flat-green'
                });

                //Colorpicker
                $(".my-colorpicker1").colorpicker();
                //color picker with addon
                $(".my-colorpicker2").colorpicker();

                //Timepicker
                $(".timepicker").timepicker({
                    showInputs: false
                });
            });
        </script>
    </body>
</html>