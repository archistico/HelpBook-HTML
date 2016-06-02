<?php

/* 
 SELECT  movimenti.*, 
		soggetti.denominazione, soggetti.provincia,
		movimentitipologia.movimentotipologia, movimentitipologia.codice, 
		movimentiaspetto.movimentoaspetto, 
		movimentitrasporto.movimentotrasporto,
		movimenticausale.movimentocausale,
		pagamentitipologia.pagamentotipologia
FROM movimenti 
INNER JOIN movimentitipologia ON movimenti.fktipologia=movimentitipologia.idmovimentotipologia 
INNER JOIN movimentiaspetto ON movimenti.fkaspetto=movimentiaspetto.idmovimentoaspetto 
INNER JOIN movimentitrasporto ON movimenti.fktrasporto=movimentitrasporto.idmovimentotrasporto 
INNER JOIN soggetti ON movimenti.fksoggetto=soggetti.idsoggetto
INNER JOIN pagamentitipologia ON movimenti.fkpagamentotipologia=pagamentitipologia.idpagamentotipologia
INNER JOIN movimenticausale ON movimenti.fkcausale=movimenticausale.idmovimentocausale
WHERE movimenti.cancellato=0 
ORDER BY movimenti.anno DESC, movimenti.fktipologia DESC, movimenti.numero DESC
 
 */

function movimentiListaTabella() {
    try {
        include 'config.php';
        $db = new PDO("mysql:host=" . $dbhost . ";dbname=" . $dbname, $dbuser, $dbpswd);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
        $db->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, 'SET NAMES UTF8');

        $result = $db->query('SELECT * FROM movimentiaspetto WHERE cancellato=0 ORDER BY movimentoaspetto ASC');
        foreach ($result as $row) {
            $row = get_object_vars($row);
            print "<option value='" . $row['idmovimentoaspetto'] . "'>" . $row['movimentoaspetto'] . "</option>\n";
        }
        // chiude il database
        $db = NULL;
    } catch (PDOException $e) {
        throw new PDOException("Error  : " . $e->getMessage());
    }
}
