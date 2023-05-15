<div class="main-menu menu-fixed menu-dark menu-accordion menu-shadow d-print-none" data-scroll-to-active="true">
	<div class="main-menu-content">
		<ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
			<li class="navigation-header">
				<span><?= $_SESSION['jabatan'] ?></span>
				<i class="la la-ellipsis-h ft-minus" data-toggle="tooltip" data-placement="right" data-original-title="<?= $_SESSION['jabatan'] ?>"></i>
			</li>
			<?php
			$role = $_SESSION['role_id'];
			if ($role == 1) { //MENU ADMIN
				$sidebar = $this->Menu_model->sidebar_admin();
			}
			if ($role == 2) { //MENU KAPROD
				$sidebar = $this->Menu_model->sidebar_kaprodi();
			}
			if ($role == 3) { //MENU KETUA DAN WAKIL
				$sidebar = $this->Menu_model->sidebar_ketua();
			}
			if ($role == 4) { //MENU SEKRETARIS
				$sidebar = $this->Menu_model->sidebar_sekretaris();
			}
			if ($role == 5) { //MENU BENDAHARA
				$sidebar = $this->Menu_model->sidebar_bendahara();
			}
			if (($role == 6) || ($role == 7)) { //MENU DEMISIONER dan PENGURUS LAINNYA
				$sidebar = $this->Menu_model->sidebar_pengurus();
			}
			if ($role == 8) { //MENU ANGGOTA
				$sidebar = $this->Menu_model->sidebar_anggota();
			}
			$active = '';
			$active2 = '';
			foreach ($sidebar as $r) {
				if ($r['has-sub'] == TRUE) {
					$active = ($this->router->fetch_class() == $r['menu_child'][0]['menu_link']) ? 'open' : '';
			?>
					<li class="nav-item has-sub <?= $active ?> <?= $r['menu_color'] ?> ">
						<a href="#"><i class="<?= $r['menu_icon'] ?>"></i>
							<span class="menu-title text-bold-600" data-i18n><?= $r['menu_text'] ?></span>
						</a>
						<ul class="menu-content">
							<?php
							$active2 = '';
							foreach ($r['menu_child'] as $c) {
								$active2 = ($this->router->fetch_class() == $c['menu_link'] or strpos($c['menu_link'], $this->router->method)) ? 'active' : '';
							?>
								<li class="<?= $active2 ?>">
									<a class="menu-item" href="<?= base_url($c['menu_link']) ?>"><i></i>
										<span data-i18n><?= $c['menu_text'] ?></span> </a>
								</li>
							<?php } ?>
						</ul>
					</li>
				<?php
				} else {
					$active = ($this->router->fetch_class() . '/' . $this->uri->segment('2') == $r['menu_link']) ? 'active' : '';
				?>
					<li class="nav-item <?= $active ?> <?= $r['menu_color'] ?>">
						<a href="<?= base_url($r['menu_link']) ?>" class="nav-link">
							<i class="<?= $r['menu_icon'] ?>"></i>
							<span class="menu-title text-bold-600" data-i18n>
								<?= $r['menu_text'] ?>
							</span>
						</a>
					</li>
			<?php
				}
			}  ?>
			<li class="nav-item">
				<a href="<?= base_url("HM/hima/" . $_SESSION['singkatan']) ?>" target="_blank" class="nav-link">
					<i class="fas fa-globe"></i>
					<span class="menu-title text-bold-600" data-i18n>
						Lihat Situs
					</span>
				</a>
			</li>
		</ul>
	</div>
</div>