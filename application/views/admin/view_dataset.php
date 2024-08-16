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
					<thead class="alert-success">
						<tr>
							<th>No</th>
							<th>Tanggal</th>
							<th>Permintaan <br> 
							<th>Persediaan <br> 
							<th>Penjualan <br> 
							<th>Kebutuhan <br> 
							<th>Aksi</th>
						</tr>
					</thead>
					<tbody>
						<?php $no=1; foreach ($datset as $p): ?>
						<tr>
							<td>
								<?php echo $no++; ?>
							</td>
							<td>
								<?php echo date('F Y', strtotime($p->tanggal)) ?>
							</td>
							<td>
								<?php echo $p->permintaan ?>
							</td>
							<td>
								<?php echo $p->persediaan ?>
							</td>
							<td>
								<?php echo $p->penjualan ?>
							</td>
							<td>
								<?php echo $p->kebutuhan ?>
							</td>
							<td>
								<a class="btn btn-small" data-toggle="modal"
									data-target="#editdata<?= $p->id_dataset ?>"><i
										class="fas fa-edit"></i> Edit </a>
								<a onclick="deleteConfirm('<?php echo site_url('datasetdelete/'.$p->id_dataset) ?>')"
									href="#!" class="btn btn-small text-danger"><i class="fas fa-trash"></i> Hapus
								</a>
							</td>
						</tr>
						<?php endforeach; ?>
					</tbody>
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
					action="<?php echo site_url('dataset') ?>"
					method="post" enctype="multipart/form-data">

					<input type="hidden" name="id_user"
						value="<?php echo $this->session->userdata('id_user');?>" />

					<div class="form-group">
						<label for="tanggal">Tanggal*</label>
						<input
							class="form-control <?php echo form_error('tanggal') ? 'is-invalid':'' ?>"
							type="date" name="tanggal" />
						<div class="invalid-feedback">
							<?php echo form_error('tanggal') ?>
						</div>
					</div>

					<div class="form-group">
						<label for="permintaan">Permintaan*</label>
						<input
							class="form-control <?php echo form_error('permintaan') ? 'is-invalid':'' ?>"
							type="number" name="permintaan"></input>
						<div class="invalid-feedback">
							<?php echo form_error('permintaan') ?>
						</div>
					</div>

					<div class="form-group">
						<label for="persediaan">Persediaan*</label>
						<input
							class="form-control <?php echo form_error('persediaan') ? 'is-invalid':'' ?>"
							type="number" name="persediaan" />
						<div class="invalid-feedback">
							<?php echo form_error('persediaan') ?>
						</div>
					</div>

					<div class="form-group">
						<label for="penjualan">Penjualan*</label>
						<input
							class="form-control <?php echo form_error('penjualan') ? 'is-invalid':'' ?>"
							type="number" name="penjualan"></input>
						<div class="invalid-feedback">
							<?php echo form_error('penjualan') ?>
						</div>
					</div>

					<div class="form-group">
						<label for="kebutuhan">Kebutuhan*</label>
						<input
							class="form-control <?php echo form_error('kebutuhan') ? 'is-invalid':'' ?>"
							type="number" name="kebutuhan"></input>
						<div class="invalid-feedback">
							<?php echo form_error('kebutuhan') ?>
						</div>
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
<?php $no=1; foreach ($datset as $p): ?>
<div class="modal fade" id="editdata<?= $p->id_dataset ?>"
	tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
					action="<?php echo site_url('datasetedit') ?>"
					method="post" enctype="multipart/form-data">

					<input type="hidden" name="id_dataset"
						value="<?php echo $p->id_dataset?>" />

					<input type="hidden" name="id_user"
						value="<?php echo $this->session->userdata('id_user');?>" />

					<div class="form-group">
						<label for="tanggal">Tanggal*</label>
						<input
							class="form-control <?php echo form_error('tanggal') ? 'is-invalid':'' ?>"
							type="date" name="tanggal" placeholder="tanggal"
							value="<?php echo $p->tanggal ?>" />
						<div class="invalid-feedback">
							<?php echo form_error('tanggal') ?>
						</div>
					</div>

					<div class="form-group">
						<label for="permintaan">Permintaan*</label>
						<input
							class="form-control <?php echo form_error('permintaan') ? 'is-invalid':'' ?>"
							type="number" name="permintaan"
							value="<?php echo $p->permintaan ?>"></input>
						<div class="invalid-feedback">
							<?php echo form_error('permintaan') ?>
						</div>
					</div>

					<div class="form-group">
						<label for="persediaan">Persediaan*</label>
						<input
							class="form-control <?php echo form_error('persediaan') ? 'is-invalid':'' ?>"
							type="number" name="persediaan" placeholder="persediaan"
							value="<?php echo $p->persediaan ?>" />
						<div class="invalid-feedback">
							<?php echo form_error('persediaan') ?>
						</div>
					</div>

					<div class="form-group">
						<label for="penjualan">Penjualan*</label>
						<input
							class="form-control <?php echo form_error('penjualan') ? 'is-invalid':'' ?>"
							type="number" name="penjualan"
							value="<?php echo $p->penjualan ?>"></input>
						<div class="invalid-feedback">
							<?php echo form_error('penjualan') ?>
						</div>
					</div>

					<div class="form-group">
						<label for="kebutuhan">Kebutuhan*</label>
						<input
							class="form-control <?php echo form_error('kebutuhan') ? 'is-invalid':'' ?>"
							type="number" name="kebutuhan" placeholder="kebutuhan"
							value="<?php echo $p->kebutuhan ?>" />
						<div class="invalid-feedback">
							<?php echo form_error('kebutuhan') ?>
						</div>
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
<?php endforeach;
