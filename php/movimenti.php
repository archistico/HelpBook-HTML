<?php

/* 
 SELECT  movimenti.numero, movimenti.anno, movimenti.movimentodata, movimenti.pagata, soggetti.denominazione, soggetti.provincia, movimentitipologia.codice, movimenticausale.movimentocausale, pagamentitipologia.pagamentotipologia FROM movimenti INNER JOIN movimentitipologia ON movimenti.fktipologia=movimentitipologia.idmovimentotipologia INNER JOIN movimentiaspetto ON movimenti.fkaspetto=movimentiaspetto.idmovimentoaspetto INNER JOIN movimentitrasporto ON movimenti.fktrasporto=movimentitrasporto.idmovimentotrasporto INNER JOIN soggetti ON movimenti.fksoggetto=soggetti.idsoggettoINNER JOIN pagamentitipologia ON movimenti.fkpagamentotipologia=pagamentitipologia.idpagamentotipologia INNER JOIN movimenticausale ON movimenti.fkcausale=movimenticausale.idmovimentocausale WHERE movimenti.cancellato=0 ORDER BY movimenti.anno DESC, movimenti.fktipologia DESC, movimenti.numero DESC
 
<tr>
<td><span class = "badge bg-red">2016-FE-001</span></td>
<td>01/01/2016</td>
<td>Ditta Pallino</td>
<td>€ 130, 00</td>
<td><i class = "fa fa-fw fa-circle" style = "color:red"></i></td>
<td><div class = 'btn-group'><button type = "button" class = "btn btn-xs btn-flat"><i class = "fa fa-plus"></i></button></div></td>
</tr>
 */

function movimentiListaTabella() {
    try {
        include 'config.php';
        $db = new PDO("mysql:host=" . $dbhost . ";dbname=" . $dbname, $dbuser, $dbpswd);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
        $db->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, 'SET NAMES UTF8');

        $result = $db->query('SELECT movimenti.idmovimento, movimenti.numero, movimenti.anno, movimenti.movimentodata, movimenti.pagata, soggetti.denominazione, soggetti.comune, movimentitipologia.codice, movimentitipologia.movimentotipologia, movimenticausale.movimentocausale, pagamentitipologia.pagamentotipologia FROM movimenti INNER JOIN movimentitipologia ON movimenti.fktipologia=movimentitipologia.idmovimentotipologia INNER JOIN movimentiaspetto ON movimenti.fkaspetto=movimentiaspetto.idmovimentoaspetto INNER JOIN movimentitrasporto ON movimenti.fktrasporto=movimentitrasporto.idmovimentotrasporto INNER JOIN soggetti ON movimenti.fksoggetto=soggetti.idsoggetto INNER JOIN pagamentitipologia ON movimenti.fkpagamentotipologia=pagamentitipologia.idpagamentotipologia INNER JOIN movimenticausale ON movimenti.fkcausale=movimenticausale.idmovimentocausale WHERE movimenti.cancellato=0 ORDER BY movimenti.anno DESC, movimenti.fktipologia DESC, movimenti.numero DESC');
        foreach ($result as $row) {
            $row = get_object_vars($row);
            print "<tr>";
            $num_padded = sprintf("%03d", $row['numero']);
            switch ($row['codice']) {
                case 'DT':
                    print "<td><span class='badge bg-orange'>" . $row['anno'] . "-" . $row['codice'] . "-" . $num_padded . "</span></td>";
                    break;
                case 'FA':
                    print "<td><span class='badge bg-teal'>" . $row['anno'] . "-" . $row['codice'] . "-" . $num_padded . "</span></td>";
                    break;
                case 'FD':
                    print "<td><span class='badge bg-blue'>" . $row['anno'] . "-" . $row['codice'] . "-" . $num_padded . "</span></td>";
                    break;
                case 'FI':
                    print "<td><span class='badge bg-navy'>" . $row['anno'] . "-" . $row['codice'] . "-" . $num_padded . "</span></td>";
                    break;
                case 'RI':
                    print "<td><span class='badge bg-green'>" . $row['anno'] . "-" . $row['codice'] . "-" . $num_padded . "</span></td>";
                    break;
                default:
                    print "<td><span class='badge bg-red'>" . $row['anno'] . "-" . $row['codice'] . "-" . $num_padded . "</span></td>";
                    break;
            }
            $movimentodata = DateTime::createFromFormat('Y-m-d', $row['movimentodata']);
            print "<td>" . $movimentodata->format('d/m/Y') . "</td>";
            
            print "<td>" . $row['movimentotipologia'] . "</td>";
            print "<td>" . $row['movimentocausale'] . "</td>";
            if($row['comune']) {
                 print "<td>" . $row['denominazione'] . " (". $row['comune'] .")</td>";
            } else {
                 print "<td>" . $row['denominazione'] . "</td>";
            }
            
            print "<td>&euro; " . movimentoDettaglioImportoTotale($row['idmovimento']) . "</td>";
                        
            if($row['pagata']) {
                print "<td><i class = 'fa fa-fw fa-circle' style = 'color:green'></i></td>";
            } else {
                print "<td><i class = 'fa fa-fw fa-circle' style = 'color:red'></i></td>";
            }
                        
            print "<td><div class = 'btn-group'><a class='btn btn-xs btn-info' href='movimentovisualizza.php?idmovimento=".$row['idmovimento']."' role='button' style='margin-right: 5px'><i class = 'fa fa-eye'></i></a><a class='btn btn-xs btn-danger' href='movimentocancella.php?idmovimento=".$row['idmovimento']."' role='button'><i class = 'fa fa-remove'></i></a></div></td>";
            print "</tr>";
        }
        // chiude il database
        $db = NULL;
    } catch (PDOException $e) {
        throw new PDOException("Error  : " . $e->getMessage());
    }
}

function movimentoDettaglioImportoTotale($idmovimento) {
    try {
        include 'config.php';
        $db = new PDO("mysql:host=" . $dbhost . ";dbname=" . $dbname, $dbuser, $dbpswd);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
        $db->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, 'SET NAMES UTF8');
        
        $totale = 0;
        
        $result = $db->query('SELECT libri.prezzo, movimentidettaglio.quantita, movimentidettaglio.sconto FROM movimentidettaglio INNER JOIN libri ON movimentidettaglio.fklibro = libri.idlibro WHERE libri.cancellato = 0 && movimentidettaglio.fkmovimento='.$idmovimento);
        foreach ($result as $row) {
            $row = get_object_vars($row);
            $quantita = $row['quantita'];
            $prezzo = $row['prezzo'];
            $sconto = $row['sconto'];
                        
            $prezzoscontato = $prezzo *(1 - $sconto/100);
            $subtotale = $prezzoscontato * $quantita;
                        
            $totale += $subtotale;
        }
        // chiude il database
        $db = NULL;
        // ritorna il valore
        return number_format($totale, 2);
        
    } catch (PDOException $e) {
        throw new PDOException("Error  : " . $e->getMessage());
    }
}