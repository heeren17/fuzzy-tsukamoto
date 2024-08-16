<div class="container-fluid">
    <?php if ($this->session->flashdata('success')): ?>
    <div class="alert alert-success" role="alert">
        <?php echo $this->session->flashdata('success'); ?>
    </div>
    <?php endif; ?>
    <!-- DataTables Example -->
    <div class="card mb-3">
        <div class="card-header">
            <h4 class="card-title">TABEL <?= $judul; ?>
            </h4>
        </div>
        <div class="card-body">
            <a type="button" class="btn btn-primary my-2" data-toggle="modal" data-target="#tambahdata"><i
                    class="fas fa-plus"></i>
                Tambah Data</a>
            <div class="table-responsive">
                <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                    <thead class="alert-danger">
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Username</th>
                            <th>Password</th>
                            <th>Status User</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php $no=1; foreach ($usr as $p): ?>
                        <tr>
                            <td>
                                <?php echo $no++; ?>
                            </td>
                            <td>
                                <?php echo $p->nama_user ?>
                            </td>
                            <td>
                                <?php echo $p->email ?>
                            </td>
                            <td width="150">
                                <?php echo $p->usernname ?>
                            </td>
                            <td>
                                <?php echo $p->passsword ?>
                            </td>
                            <td>
                                <?php echo $p->status ?>
                            </td>
                            <td colspan="2">
                                <a class="btn btn-small" data-toggle="modal"
                                    data-target="#editdata<?= $p->id_user ?>"><i
                                        class="fas fa-edit"></i> Edit </a>
                                <a onclick="deleteConfirm('<?php echo site_url('datauserdelete/'.$p->id_user) ?>')"
                                    href="#!" class="btn btn-small text-danger"><i class="fas fa-trash"></i>
                                    Hapus
                                </a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Username</th>
                            <th>Password</th>
                            <th>Status User</th>
                            <th>Aksi</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->

<!-- Modal Tambah Data -->
<div class="modal fade" id="tambahdata" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLabel"><?= $sub ?>
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form
                    action="<?php echo site_url('datauser') ?>"
                    method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="nama_user">Nama*</label>
                        <input
                            class="form-control <?php echo form_error('nama_user') ? 'is-invalid':'' ?>"
                            type="text" name="nama_user" placeholder="Nama" />
                        <div class="invalid-feedback">
                            <?php echo form_error('nama_user') ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="email">Email*</label>
                        <input
                            class="form-control <?php echo form_error('email') ? 'is-invalid':'' ?>"
                            type="text" name="email" placeholder="EMAIL" />
                        <div class="invalid-feedback">
                            <?php echo form_error('email') ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="usernname">Username*</label>
                        <input
                            class="form-control <?php echo form_error('usernname') ? 'is-invalid':'' ?>"
                            type="text" name="usernname" placeholder="Username" />
                        <div class="invalid-feedback">
                            <?php echo form_error('usernname') ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="passsword">Password*</label>
                        <input
                            class="form-control <?php echo form_error('passsword') ? 'is-invalid':'' ?>"
                            name="passsword" placeholder="Password" />
                        <div class="invalid-feedback">
                            <?php echo form_error('passsword') ?>
                        </div>
                    </div>

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="status">Status User</label>
                        </div>
                        <select
                            class="custom-select <?php echo form_error('status') ? 'is-invalid':'' ?>"
                            name="status">
                            <option selected>Pilih...</option>
                            <option value="ADMIN">ADMIN</option>
                            <!-- <option value="USER">USER</option> -->
                        </select>
                    </div>

                    <button type="submit" class="btn btn-success">Save</button>
                </form>
            </div>
            <div class="modal-footer">
                <div class="card-footer small text-muted">
                    <h5>field tanda * Harus Di isi</h5>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Edit Data -->
<?php $no=1; foreach ($usr as $p): ?>
<div class="modal fade" id="editdata<?= $p->id_user ?>" tabindex="-1"
    role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLabel"><?= $sub2 ?>
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form
                    action="<?php echo site_url('datauseredit') ?>"
                    method="post" enctype="multipart/form-data">
                    <input type="hidden" name="id_user"
                        value="<?php echo $p->id_user?>" />

                    <div class="form-group">
                        <label for="nama_user">Nama*</label>
                        <input
                            class="form-control <?php echo form_error('nama_user') ? 'is-invalid':'' ?>"
                            type="text" name="nama_user"
                            value="<?php echo $p->nama_user ?>" />
                        <div class="invalid-feedback">
                            <?php echo form_error('nama_user') ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="email">EMAIL*</label>
                        <input
                            class="form-control <?php echo form_error('email') ? 'is-invalid':'' ?>"
                            type="text" name="email" placeholder="EMAIL"
                            value="<?php echo $p->email ?>" />
                        <div class="invalid-feedback">
                            <?php echo form_error('email') ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="usernname">Username*</label>
                        <input
                            class="form-control <?php echo form_error('usernname') ? 'is-invalid':'' ?>"
                            type="text" name="usernname" placeholder="Username"
                            value="<?php echo $p->usernname ?>" />
                        <div class="invalid-feedback">
                            <?php echo form_error('usernname') ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="passsword">Password*</label>
                        <input
                            class="form-control <?php echo form_error('passsword') ? 'is-invalid':'' ?>"
                            name="passsword" placeholder="Password"
                            value="<?php echo $p->passsword ?>" />
                        <div class="invalid-feedback">
                            <?php echo form_error('passsword') ?>
                        </div>
                    </div>

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="status">Status User</label>
                        </div>
                        <select
                            class="custom-select <?php echo form_error('status') ? 'is-invalid':'' ?>"
                            name="status">
                            <option value="ADMIN" <?php if ($p->status == "ADMIN") {
    echo "selected";
} ?>>ADMIN
                            </option>
                            <!-- <option value="USER" <?php if ($p->status == "USER") {
    echo "selected";
} ?>>USER
                            </option> -->
                        </select>
                    </div>
                    <button type="submit" class="btn btn-success">Save</button>
                </form>
            </div>
            <div class="modal-footer">
                <div class="card-footer small text-muted">
                    <h5>field tanda * Harus Di isi</h5>
                </div>
            </div>
        </div>
    </div>
</div>
<?php endforeach; ?>
<?php 