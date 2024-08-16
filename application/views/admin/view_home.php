<div class="container-fluid">
    <?php if ($this->session->flashdata('success')): ?>
    <div class="alert alert-success" role="alert">
        <?php echo $this->session->flashdata('success'); ?>
    </div>
    <?php endif; ?>
    <div class="row">
        <div class="col-12">
            <div class="card card-dark card-outline">
                <!-- /.card-header -->
                <div class="card-body align-center">
                    <h5 class="card-title text-center">
                        <?= $judul1;?>
                    </h5>
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
    <?php if ($this->session->flashdata('success')): ?>
    <div class="alert alert-success" role="alert">
        <?php echo $this->session->flashdata('success'); ?>
    </div>
    <?php endif; ?>
    <div class="row">
        <div class="col-12">
            <div class="card card-dark card-outline">
                <div class="card-header">
                    <h4 class="card-title">FORM <?= $judul2; ?>
                    </h4>
                </div>
                <!-- /.card-header -->
                <div class="card-body">

                    <form
                        action="<?php echo site_url('datauji') ?>"
                        method="post" enctype="multipart/form-data">

                        <input type="hidden" name="id_user"
                            value="<?php echo $this->session->userdata('id_user');?>" />

                        <div class="form-group">
                            <label for="permintaan_uji">Permintaan*</label>
                            <input
                                class="form-control <?php echo form_error('permintaan_uji') ? 'is-invalid':'' ?>"
                                type="number" name="permintaan_uji"></input>
                            <div class="invalid-feedback">
                                <?php echo form_error('permintaan_uji') ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="persediaan_uji">Persediaan*</label>
                            <input
                                class="form-control <?php echo form_error('persediaan_uji') ? 'is-invalid':'' ?>"
                                type="number" name="persediaan_uji" />
                            <div class="invalid-feedback">
                                <?php echo form_error('persediaan_uji') ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="penjualan_uji">Penjualan*</label>
                            <input
                                class="form-control <?php echo form_error('penjualan_uji') ? 'is-invalid':'' ?>"
                                type="number" name="penjualan_uji"></input>
                            <div class="invalid-feedback">
                                <?php echo form_error('penjualan_uji') ?>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-success">Save</button>
                    </form>

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