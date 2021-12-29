<main id="main" class="main">

	<div class="pagetitle">
		<h1><?= $judul; ?></h1>
	</div><!-- End Page Title -->

	<section class="section">
		<div class="card">
			<div class="card-body">
				<h5 class="card-title">Role</h5>
				<table class="table table-striped">
					<thead>
						<tr>
							<th scope="col">#</th>
							<th scope="col">Role</th>
							<th scope="col">Hak Akses</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$no = 1;
						foreach ($data as $d) {
							if ($d->idrole != 2) {
						?>
								<tr>
									<th scope="row"><?= $no++; ?></th>
									<td><?= $d->role; ?></td>
									<td>
										<a href="<?= site_url('role/aksesmenu/') . $d->idrole ?>" type="button" class="btn btn-primary">Hak Akses</a>
									</td>
								</tr>
						<?php }
						} ?>
					</tbody>
				</table>
			</div>
		</div>
	</section>


</main><!-- End #main -->