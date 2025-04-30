<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?php echo $title; ?></title>
	<style>
		/* Reset default margin dan padding untuk tampilan yang konsisten */
		body, h1, h2, h3, h4, h5, h6, p, table {
			margin: 0;
			padding: 0;
		}

		body {
			font-family: Arial, sans-serif;
			line-height: 1.6;
			color: #333;
			background-color: #f4f4f4;
			padding: 20px;
		}

		.container {
			max-width: 1200px; /* Lebar maksimum container */
			margin: 20px auto; /* Center container horizontal, beri jarak atas bawah */
			padding: 0 20px; /* Beri padding kiri kanan container */
		}

		h1 {
			font-size: 2rem;
			margin-bottom: 20px;
			text-align: center; /* Center judul */
			color: #2c3e50;
		}

		table {
			width: 100%;
			border-collapse: collapse;
			margin-bottom: 20px;
			background-color: #fff;
			border-radius: 8px; /* Rounded corners */
			box-shadow: 0 2px 5px rgba(0,0,0,0.1); /* Shadow untuk kedalaman */
			overflow: hidden;  /*needed for rounded corners of thead*/
		}

		thead {
			background-color: #008CBA; /* Warna biru Bootstrap */
			color: white;
		}

		thead th {
			padding: 12px 15px;
			text-align: left;
			font-weight: bold;
			border-bottom: 2px solid #0056b3; /* Darker blue border */
		}

		tbody tr:nth-child(odd) {
			background-color: #f9f9f9; /* Lighter background for odd rows */
		}

		tbody tr:hover {
			background-color: #f1f1f1; /* Slightly darker hover effect */
		}

		tbody td {
			padding: 12px 15px;
			border-bottom: 1px solid #ddd; /* Separator antar row */
		}

		tbody td:last-child {
			text-align: center; /* Center tombol di kolom aksi */
		}


		.btn {
			display: inline-block; /* Make buttons behave like inline elements */
			padding: 8px 12px;
			text-decoration: none;
			border-radius: 4px;
			color: white;
			margin-right: 5px; /* Space between buttons */
			transition: background-color 0.3s ease; /* Smooth transition */
			font-size: 0.9rem;
			border: none;
			cursor: pointer;
			margin: 2px;
		}

		.btn:hover {
			opacity: 0.9;
		}

		.btn-primary {
			background-color: #008CBA;
		}
		.btn-primary:hover {
			background-color: #0056b3;
		}

		.btn-danger {
			background-color: #dc3545;
		}

		.btn-danger:hover {
			background-color: #c82333;
		}


		@media (max-width: 768px) {
			.container {
				padding: 0 10px;
			}

			table {
				border: 0;
			}

			thead {
				display: none;
			}

			tr {
				display: block;
				margin-bottom: 15px;
				border-bottom: 1px solid #ddd;
			}

			td {
				display: block;
				text-align: right;
				padding-left: 50%;
				position: relative;
				border: none;
			}

			td:before {
				content: attr(data-label);
				position: absolute;
				left: 0;
				width: 50%;
				padding-left: 0;
				text-align: left;
				font-weight: bold;
			}

			td:last-child {
				text-align: center;
			}

			.btn {
				font-size: 0.85rem;
				padding: 6px 10px;
			}
		}

		@media (max-width: 480px) {
			.btn {
				font-size: 0.75rem;
				padding: 5px 8px;
			}
		}


		.form-group {
			margin-bottom: 10px;
		}
		.form-group label {
			display: block;
			margin-bottom: 5px;
		}
		.form-control {
			width: 100%;
			padding: 8px 10px;
			border: 1px solid #ccc;
			border-radius: 4px;
			box-sizing: border-box;
		}
		.error-message {
			color: red;
			font-size: 0.9em;
			margin-top: 5px;
		}
	</style>
</head>
<body>

	<a  class="btn btn-primary"  href="<?= site_url() ?>">Home</a>

	<?php if ($users_update){ ?>
		
		<h2>Edit Pengguna</h2>
		<form action="<?= site_url('test/update'); ?>" method="post">
			<input type="hidden" name="id" value="<?= $users_update[0]['id']; ?>">
			<div class="form-group">
				<label for="nama">Nama:</label>
				<input class="form-control" type="text" id="nama" name="nama" value="<?= htmlspecialchars($users_update[0]['nama']); ?>" required>
			</div>
			<div class="form-group">
				<label for="email">Email:</label>
				<input class="form-control" type="email" id="email" name="email" value="<?= htmlspecialchars($users_update[0]['email']); ?>" required>
			</div>
			<button class="btn btn-primary" type="submit">Update</button>
			<a class="btn btn-primary" href="<?= site_url('test'); ?>">Batal</a>
		</form>

	<?php }else{ ?>

		<h2>Tambah Pengguna Baru</h2>
		<?php echo form_open('test/create') ?>
		<div class="form-group">
			<label for="nama">Nama:</label>
			<input class="form-control" type="text" id="nama" name="nama" required>
		</div>
		<div class="form-group">
			<label for="email">Email:</label>
			<input class="form-control" type="email" id="email" name="email" required>
		</div>
		<button type="submit" class="btn btn-primary">Simpan</button>
		<?php echo form_close() ?>

	<?php } ?>

	<br>
	<?php if (flashdata('alert')!== null): ?>
	<?php endif; ?>
		<?php echo flashdata('alert') ?>
	<br>


	<h2>Daftar Pengguna</h2>
	<table>
		<thead>
			<tr>
				<th>ID</th>
				<th>Nama</th>
				<th>Email</th>
				<th>Aksi</th>
			</tr>
		</thead>
		<tbody>
			<?php if ($users){ $no=0; ?>
				
				<?php foreach ($users as $user): $no++; ?>
					<tr>
						<td><?= $no; ?></td>
						<td><?= htmlspecialchars($user['nama']); ?></td>
						<td><?= htmlspecialchars($user['email']); ?></td>
						<td>
							<a class="btn btn-primary" href="<?= site_url('test?id='.$user['id']) ?>">Edit</a>
							<a class="btn btn-primary" href="<?= site_url('test/delete?id='.$user['id']) ?>" onclick="return confirm('Apakah Anda yakin?')">Hapus</a>
						</td>
					</tr>
				<?php endforeach; ?>
			<?php }else{echo'<tr><td colspan="4">Tidak ada data</td></tr>';} ?>
			
		</tbody>
	</table>

	<br>

</body>
</html>