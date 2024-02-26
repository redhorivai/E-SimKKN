<!-- HEADER -->
<div class="br-header">
    <!-- HEADER LEFT -->
    <div class="br-header-left">
        <div class="navicon-left hidden-md-down">
            <a id="btnLeftMenu" href="#"><i class="icon ion-navicon-round"></i></a>
        </div>
        <div class="navicon-left hidden-lg-up">
            <a id="btnLeftMenuMobile" href="#"><i class="icon ion-navicon-round"></i></a>
        </div>
    </div>
    <!-- END HEADER LEFT -->
    <!-- HEADER RIGHT -->
    <div class="br-header-right">
        <nav class="nav mg-r-30">
            <!-- NOTIFIKASI SURAT MASUK -->
            <div class="dropdown">
                <a href="#" class="nav-link pd-t-15 pd-b-0 mg-r-10 pos-relative" data-toggle="dropdown">
                    <div><i class="icon flaticon-038-email-2 tx-26"></i></div>
                    <!-- start: if statement -->
                    <!-- <span id="notif_masuk" class="square-8 bg-danger pos-absolute t-15 r-0 rounded-circle"></span> -->
                    <span id="notif_masuk" class="badge badge-danger noti-icon-badge"></span>
                    <!-- end: if statement -->
                </a>
                <div id="notifikasi_masuk" class="dropdown-menu dropdown-menu-header">

                </div>
            </div>
            <!-- END NOTIFIKASI SURAT MASUK -->
            <!-- PROFIL -->
            <div class="dropdown" style="border-left: 1px solid #ced4da;">
                <a href="#" class="nav-link nav-link-profile" data-toggle="dropdown">
                    <?php 
                        if (empty(session()->get('avatar')) && session()->get('gender') == 'L') {
                            $avatar = "<img src='".base_url()."/assets-admin/panel/images/users/male.png' class='wd-45 ht-45 rounded-circle'>";
                            $thumbnail = "<img src='".base_url()."/assets-admin/panel/images/users/male.png' class='wd-100 ht-100 rounded-circle'>";
                        } else if (empty(session()->get('avatar')) && session()->get('gender') == 'P') {
                            $avatar = "<img src='".base_url()."/assets-admin/panel/images/users/female.png' class='wd-45 ht-45 rounded-circle'>";
                            $thumbnail = "<img src='".base_url()."/assets-admin/panel/images/users/female.png' class='wd-100 ht-100 rounded-circle'>";
                        } else {
                            $avatar = "<img src='".base_url()."/assets-admin/panel/images/users/".session()->get('avatar')."' class='wd-45 ht-45 rounded-circle'>";
                            $thumbnail = "<img src='".base_url()."/assets-admin/panel/images/users/".session()->get('avatar')."' class='wd-100 ht-100 rounded-circle'>";
                        } 
                    ?>
                    <?= $avatar; ?>
                    <span class="logged-name hidden-md-down mg-l-5" style="vertical-align:middle;">
                        <b><?= session()->get('name') ?></b>
                        <br><?= session()->get('username') ?>
                    </span>
                </a>
                <div class="dropdown-menu dropdown-menu-header wd-250">
                    <div class="tx-center">

                        <?= $thumbnail; ?>

                        <h6 class="logged-fullname">
                            <b><?= session()->get('name') ?></b>
                        </h6>
                        <p class="mg-b-1" style="color:#888;text-transform:lowercase;">
                        <?= session()->get('username') ?>
                        </p>
                    </div>
                    <hr>
                    <ul class="list-unstyled user-profile-nav">
                        <li>
                            <a href="<?= base_url('panel/profil')?>">
                                <i class="icon ion-person-stalker"></i> Profil Anda
                            </a>
                        </li>
                        <li>
                            <a href="<?= base_url('panel/gabung')?>">
                                <i class="icon ion-person-add"></i> Gabung Kelompok
                            </a>
                        </li>
                        <li><a href="<?= base_url('Backend/login/logout'); ?>"><i class="icon ion-power"></i> Keluar</a></li>
                    </ul>
                </div>
            </div>
            <!-- END PROFIL -->
        </nav>
    </div>
    <!-- END HEADER RIGHT -->
</div>
<!-- END HEADER -->