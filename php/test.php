<table class="table table-striped">
    <tr>
        <th>Libro</th>
        <th style="width: 100px">Venduti</th>
        <th style="width: 100px">Distribuiti</th>
        <th style="width: 95px">Incasso</th>
    </tr>
    <?php
    include 'utilita.php';
    include 'libri.php';
    libriPiuVendutiTabella();
    ?>
</table>