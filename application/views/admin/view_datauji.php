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
			<div class="table-responsive">
				<table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
					<thead class="alert-success">
						<tr>
							<th>No</th>
							<th>permintaan </th>
							<th>persediaan </th>
							<th>penjualan </th>
							<th>Aksi</th>
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
							<td>
								<a href="<?php echo site_url('dataujihasil/'.$p->id_uji) ?>"
									class="btn btn-small text-success"><i class="fas fa-list"></i> Hasil
								</a>

								<a class="btn btn-small" data-toggle="modal"
									data-target="#editdata<?= $p->id_uji ?>"><i
										class="fas fa-edit"></i> Edit </a>

								<a onclick="deleteConfirm('<?php echo site_url('dataujidelete/'.$p->id_uji) ?>')"
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

<!-- Modal Edit Data -->
<?php $no=1; foreach ($datuji as $p): ?>
<div class="modal fade" id="editdata<?= $p->id_uji ?>" tabindex="-1"
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
					action="<?php echo site_url('dataujiedit') ?>"
					method="post" enctype="multipart/form-data">

					<input type="hidden" name="id_uji"
						value="<?php echo $p->id_uji?>" />

					<input type="hidden" name="id_user"
						value="<?php echo $this->session->userdata('id_user');?>" />

					<div class="form-group">
						<label for="permintaan_uji">Permintaan*</label>
						<input
							class="form-control <?php echo form_error('permintaan_uji') ? 'is-invalid':'' ?>"
							type="number" name="permintaan_uji"
							value="<?php echo $p->permintaan_uji ?>"></input>
						<div class="invalid-feedback">
							<?php echo form_error('permintaan_uji') ?>
						</div>
					</div>

					<div class="form-group">
						<label for="persediaan_uji">Persediaan*</label>
						<input
							class="form-control <?php echo form_error('persediaan_uji') ? 'is-invalid':'' ?>"
							type="number" name="persediaan_uji" placeholder="persediaan_uji"
							value="<?php echo $p->persediaan_uji ?>" />
						<div class="invalid-feedback">
							<?php echo form_error('persediaan_uji') ?>
						</div>
					</div>

					<div class="form-group">
						<label for="penjualan_uji">Penjualan*</label>
						<input
							class="form-control <?php echo form_error('penjualan_uji') ? 'is-invalid':'' ?>"
							type="number" name="penjualan_uji"
							value="<?php echo $p->penjualan_uji ?>"></input>
						<div class="invalid-feedback">
							<?php echo form_error('penjualan_uji') ?>
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
