<header class="header">
			
		<!-- Top Bar -->
		<div class="top_bar">
			<div class="top_bar_container">
				<div class="container">
					<div class="row">
                        <div class="col">
                            <div class="top_bar_content d-flex flex-row align-items-center justify-content-start">
                                <ul class="top_bar_contact_list">
                                    <li><div class="question">Ajukan Pertanyaan?</div></li>
                                    <li>
                                        <i class="fa fa-phone" aria-hidden="true"></i>
                                        <div>001-1234-88888</div>
                                    </li>
                                    <li>
                                        <i class="fa fa-envelope-o" aria-hidden="true"></i>
                                        <div>redhorivai@gmail.com</div>
                                    </li>
                                </ul>
                                <div class="top_bar_login ml-auto">
                                    <div class="login_button"><a href="<?= base_url()?>/panel">Daftar / Masuk</a></div>
                                </div>
                            </div>
                        </div>
					</div>
				</div>
			</div>				
		</div>
        <!-- Header Content -->
		<div class="header_container">
			<div class="container">
				<div class="row">
					<div class="col">
                        <div class="header_content d-flex flex-row align-items-center justify-content-start">
                            <div class="logo_container">
                                <a href="<?= base_url('/')?>">
                                    <div class="logo_text"><i>e-</i> SIM<span>KKN</span></div>
                                </a>
                            </div>
                            <nav class="main_nav_contaner ml-auto">
                                <ul class="main_nav">
                                    <li class="<?php if ($menu == 'home') { echo 'active'; } ?>">
                                    <?php if ($menu == 'home') {
                                    echo "<a href='#home'>Beranda</a>";
                                    } else {
                                    echo "<a href='".base_url('/')."'>Beranda</a>";
                                    } 
                                    ?></li>
                                    <!-- <li><a href="javascript:void(0)">Tentang</a></li>
                                    <li><a href="javascript:void(0)">Artikel</a></li> -->
                                    <li class="<?php if ($menu == 'pengumuman') { echo 'active'; } ?>"><a href="<?= base_url('/pengumuman')?>">Pengumuman</a></li>
                                    <li class="<?php if ($menu == 'kontak') { echo 'active'; } ?>"><a href="<?= base_url('/kontak')?>">Kontak</a></li>
                                </ul>
                                <div class="hamburger menu_mm">
									<i class="fa fa-bars menu_mm" aria-hidden="true"></i>
								</div>
                            </nav>
                        </div>
					</div>
				</div>
			</div>
		</div>
	</header>
    <!-- Menu -->

	<div class="menu d-flex flex-column align-items-end justify-content-start text-right menu_mm trans_400">
		<div class="menu_close_container"><div class="menu_close"><div></div><div></div></div></div>
		<nav class="menu_nav">
			<ul class="menu_mm">
                <li class="<?php if ($menu == 'home') { echo 'active'; } ?>">
                <?php if ($menu == 'home') {
                echo "<a href='#home'>Beranda</a>";
                } else {
                echo "<a href='".base_url('/')."'>Beranda</a>";
                } 
                ?></li>
                <li><a href="javascript:void(0)">Tentang</a></li>
                <li><a href="javascript:void(0)">Artikel</a></li>
                <li class="<?php if ($menu == 'pengumuman') { echo 'active'; } ?>"><a href="<?= base_url('/pengumuman')?>">Pengumuman</a></li>
                <li class="<?php if ($menu == 'kontak') { echo 'active'; } ?>"><a href="<?= base_url('/kontak')?>">Kontak</a></li>
			</ul>
		</nav>
	</div>