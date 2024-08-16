<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card card-dark card-outline">
                <div class="card-header">
                    <h5 class="card-title">TABEL <?= $sub; ?>
                    </h5>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered text-center" id="dataTable1" width="100%" cellspacing="0">
                            <thead class="alert-primary">
                                <tr>
                                    <th>No</th>
                                    <th>permintaan </th>
                                    <th>persediaan </th>
                                    <th>penjualan </th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php $no=1; foreach ($datuji as $p): ?>
                                <tr>
                                    <td>
                                        <?php echo $no++; ?>
                                    </td>
                                    <td>
                                        <?php echo $p->permintaan_uji ?>
                                    </td>
                                    <td>
                                        <?php echo $p->persediaan_uji ?>
                                    </td>
                                    <td>
                                        <?php echo $p->penjualan_uji ?>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
</div>
<!-- /.container-fluid -->

<div class="container-fluid my-3">
    <div class="row">
        <div class="col-12">
            <div class="card card-dark card-outline">
                <div class="card-header">
                    <h5 class="card-title">TABEL <?= $sub1; ?>
                    </h5>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered text-center" id="dataTable2" width="100%" cellspacing="0">
                            <thead class="alert-primary">
                                <tr>
                                    <th>Keanggotaan</th>
                                    <th>Nilai</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php foreach ($datnilai as $p): ?>
                                <tr>
                                    <td>
                                        <?php echo ucwords(preg_replace("/_/", " ", $p->keanggotaan))?>
                                    </td>
                                    <td>
                                        <?php echo number_format($p->nilai, 2) ?>
                                    </td>
                                </tr>

                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
</div>
<!-- /.container-fluid -->

<div class="container-fluid my-3">
    <div class="row">
        <div class="col-12">
            <div class="card card-dark card-outline">
                <div class="card-header">
                    <h5 class="card-title">TABEL <?= $sub2; ?>
                    </h5>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                            <thead class="alert-primary">
                                <tr>
                                    <th>No</th>
                                    <th>FUZZY RULES</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php $no=1; foreach ($datrule as $p): ?>
                                <tr>
                                    <td>
                                        <?php echo "R".$no++; ?>
                                    </td>
                                    <td>
                                        <?php echo $p->rules?>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
</div>
<!-- /.container-fluid -->

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card card-dark card-outline">
                <div class="card-header">
                    <h5 class="card-title">TABEL <?= $sub3; ?>
                    </h5>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                            <thead class="alert-success">
                                <tr>
                                    <th>No</th>
                                    <th>Permintaan</th>
                                    <th>Persediaan</th>
                                    <th>Penjualan</th>
                                    <th>MIN</th>
                                    <th>Kebutuhan</th>
                                    <th>Prediksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no=1; foreach ($datfuzzy as $p): ?>
                                <tr>
                                    <td>
                                        <?php echo "R".$no++; ?>
                                    </td>
                                    <td>
                                        <?php echo number_format($p->hitung_permintaan, 2) ?>
                                    </td>
                                    <td>
                                        <?php echo number_format($p->hitung_persediaan, 2) ?>
                                    </td>
                                    <td>
                                        <?php echo number_format($p->hitung_penjualan, 2) ?>
                                    </td>
                                    <td>
                                        <?php echo number_format($p->minn, 2) ?>
                                    </td>
                                    <td>
                                        <?php echo $p->hitung_kebutuhan ?>
                                    </td>
                                    <td>
                                        <?php echo number_format($p->prediksi, 2) ?>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
</div>
<!-- /.container-fluid -->

<div class="container-fluid my-3">
    <div class="row">
        <div class="col-12">
            <div class="card card-dark card-outline">
                <div class="card-header">
                    <h5 class="card-title">TABEL <?= $sub4; ?>
                    </h5>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                            <thead class="alert-success">
                                <tr>
                                    <th>Hasil Prediksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no=1; foreach ($dathasil as $p): ?>
                                <tr>
                                    <td>
                                        <?php echo $p->hasil_fuzzy ?>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
</div>
<!-- /.container-fluid -->