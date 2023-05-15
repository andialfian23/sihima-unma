<div class="card border-info">
	<div class="card-header bg-info">
		<h4 class="card-title text-white">Filter Pencarian : </h4>
		<a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
		<div class="heading-elements">
			<ul class="list-inline mb-0">
				<li><a data-action="collapse"><i class="text-white ft-plus"></i></a></li>
			</ul>
		</div>
	</div>
	<div class="card-content collapse">
		<div class="card-body">
			<?php if (akses('Admin')->num_rows() > 0) { ?>
				<div class="form-group row">
					<label class="col-md-3 label-control" for="kode_prodi">Himpunan</label>
					<div class="col-md-9">
						<select id="kode_prodi" name="kode_prodi" class="form-control" required />
						<option value="<?= $_SESSION['kode_prodi'] ?>" hidden><?= $_SESSION['nama_hima'] ?></option>
						<?php
						$hima = $this->db->get('t_hima')->result();
						foreach ($hima as $h) {
							echo '<option value="' . $h->kode_prodi . '"> ' . $h->nama_hima . '</option>';
						}
						?>
						</select>
					</div>
				</div>
			<?php } ?>


			<div class="form-group row">
				<label class="col-md-3 label-control" for="kelas_mhs">Kelas Mahasiswa</label>
				<div class="col-md-9">
					<select id="kelas_mhs" name="kelas_mhs" class="form-control" required>
						<option value="0">Semua Kelas</option>
						<option value="1">Reg</option>
						<option value="2">Non Reg</option>
					</select>
				</div>
			</div>
			<div class="form-group row">
				<label class="col-md-3 label-control" for="id_jns_keluar">Status Mahasiswa</label>
				<div class="col-md-9">
					<select name="id_jns_keluar" id="id_jns_keluar" required class="form-control">
						<option value="0" selected>Aktif</option>
						<option value="1">Tidak Aktif</option>
						<!--<option value="2" >2</option>-->
						<!--<option value="3" >3</option>-->
						<option value="All">Semua Status</option>
					</select>
				</div>
			</div>
		</div>
	</div>
</div>
<table width="100%" class="table responsive table-striped table-bordered table-hover compact dataTable" id="dataTables_mahasiswa" role="grid">
	<thead>
		<tr role="row">
			<th>NPM</th>
			<th>Nama Lengkap</th>
		</tr>
	</thead>
	<tbody>
	</tbody>
</table>
<script type="text/javascript">
	$(document).ready(function() {
		var table = $('#dataTables_mahasiswa').DataTable({
			serverSide: true,
			processing: true,
			language: {
				url: "<?= base_url('assets/ID.json') ?>",
			},
			dom: "<'row'<'col-sm-12 col-md-6'B><'col-sm-12 col-md-6'f>>" +
				"<'row'<'col-sm-12'tr>>" +
				"<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
			lengthMenu: [
				[5, 10, 25, 50, -1],
				['5', '10', '25', '50', 'Semua Data']
			],
			pageLength: 5,
			buttons: [{
					extend: 'pageLength',
					text: 'Tampilkan Data',
					className: 'btn btn-light',
				},
				{
					extend: 'pdf',
					className: 'btn btn-danger',
				},
			],
			ajax: {
				url: "<?= base_url('datatable/json/get/mahasiswa') ?>",
				type: 'GET',
				data: function(d) {
					d.npm_aktif = $("#id_jns_keluar").val();
					d.kelas_mhs = $("#kelas_mhs").val();

					<?php if ($_SESSION['role_id'] == 1) : ?>
						d.kode_prodi = $("#kode_prodi").val();
					<?php endif; ?>
				}
			},
			order: [1, 'asc'],
			columns: [{
					data: 'npm',
					name: 'mahasiswa_pt.id_mahasiswa_pt'
				},
				{
					name: 'nm_pd',
					render: function(data, type, row, meta) {
						return '<a href="<?= base_url("Dashboard/detail/") ?>' + row.npm + '">' + row.nm_pd + '</a>';
					}
				},
			],
		});

		$('#id_jns_keluar').change(function() { //button filter event click
			table.ajax.reload(null, false); //just reload table
			console.log($(this).val());
		});

		// $('#mulai_smt').change(function() { //button filter event click
		// 	table.ajax.reload(null, false); //just reload table
		// 	console.log($(this).val());
		// });

		$('#kelas_mhs').change(function() { //button filter event click
			table.ajax.reload(null, false); //just reload table
			console.log($(this).val());
		});

		<?php if ($_SESSION['role_id'] == 1) : ?>
			$('#kode_prodi').change(function() { //button filter event click
				table.ajax.reload(null, false); //just reload table
				console.log($(this).val());
			});
		<?php endif; ?>

	});
</script>