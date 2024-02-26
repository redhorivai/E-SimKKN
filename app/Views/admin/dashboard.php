<?= $this->extend('admin/layout/main_layout'); ?>
<!-- MAIN CONTENT -->
<?= $this->section('content') ?>
<div class="br-mainpanel">
    <!-- PAGE TITLE -->
    <div class="d-md-flex justify-content-between">
        <div class="br-pagetitle dash pd-t-20">
            <i class="icon ion-ios-home-outline"></i>
            <div>
                <h4 class="mg-b-0-force">Dashboard</h4>
                <p>Halo.. <b class="tx-info"><?= session()->get('name') ?></b>, Selamat datang di <b class="tx-info">Panel Admin</b> SIMKKN Univ. Muhammadyah Palembang.</p>
                <p>
                    <?= $res_info; ?>
                </p>
            </div>
        </div>
        <div class="br-pagetitle pd-t-20">
            <div>
                <h2 id="brTime" class="br-time"></h2>
                <h6 id="brDate" class="br-date"></h6>
            </div>
        </div>
    </div>
    <!-- END PAGE TITLE -->
    <!-- WIDGET -->
    <div class="br-pagebody mg-t-15">
        <div class="row row-sm">

            <!-- <div class="col-sm-6 col-xl-3 mg-t-20 mg-xl-t-0">
                <a href="javascript:void(0)">
                    <div class="bg-purple rounded overflow-hidden" style="box-shadow:0 2px 5px 0 rgba(0, 0, 0, .16), 0 2px 10px 0 rgba(0, 0, 0, .12) !important">
                        <div class="pd-x-20 pd-t-20 mg-t-10 d-flex align-items-center">
                            <i class="fe-user tx-60 lh-0 tx-white op-7"></i>
                            <div class="mg-l-20">
                                <p class="tx-10 tx-spacing-1 tx-mont tx-semibold tx-uppercase tx-white-8 mg-b-10">Widget #1</p>
                                <p class="tx-24 tx-white tx-lato tx-bold mg-b-0 lh-1">182</p>
                                <span class="tx-11 tx-roboto tx-white-8" style="color:#0866C6;">.</span>
                            </div>
                        </div>
                        <div class="ht-40 tr-y-1"></div>
                    </div>
                </a>
            </div>

            <div class="col-sm-6 col-xl-3 mg-t-20 mg-xl-t-0">
                <a href="javascript:void(0)">
                    <div class="bg-primary rounded overflow-hidden" style="box-shadow:0 2px 5px 0 rgba(0, 0, 0, .16), 0 2px 10px 0 rgba(0, 0, 0, .12) !important">
                        <div class="pd-x-20 pd-t-20 mg-t-10 d-flex align-items-center">
                            <i class="fe-user tx-60 lh-0 tx-white op-7"></i>
                            <div class="mg-l-20">
                                <p class="tx-10 tx-spacing-1 tx-mont tx-semibold tx-uppercase tx-white-8 mg-b-10">Widget #2</p>
                                <p class="tx-24 tx-white tx-lato tx-bold mg-b-0 lh-1">182</p>
                                <span class="tx-11 tx-roboto tx-white-8" style="color:#0866C6;">.</span>
                            </div>
                        </div>
                        <div class="ht-40 tr-y-1"></div>
                    </div>
                </a>
            </div>

            <div class="col-sm-6 col-xl-3 mg-t-20 mg-xl-t-0">
                <a href="javascript:void(0)">
                    <div class="bg-info rounded overflow-hidden" style="box-shadow:0 2px 5px 0 rgba(0, 0, 0, .16), 0 2px 10px 0 rgba(0, 0, 0, .12) !important">
                        <div class="pd-x-20 pd-t-20 mg-t-10 d-flex align-items-center">
                            <i class="fe-user tx-60 lh-0 tx-white op-7"></i>
                            <div class="mg-l-20">
                                <p class="tx-10 tx-spacing-1 tx-mont tx-semibold tx-uppercase tx-white-8 mg-b-10">Widget #3</p>
                                <p class="tx-24 tx-white tx-lato tx-bold mg-b-0 lh-1">182</p>
                                <span class="tx-11 tx-roboto tx-white-8" style="color:#0866C6;">.</span>
                            </div>
                        </div>
                        <div class="ht-40 tr-y-1"></div>
                    </div>
                </a>
            </div>

            <div class="col-sm-6 col-xl-3 mg-t-20 mg-xl-t-0">
                <a href="javascript:void(0)">
                    <div class="bg-danger rounded overflow-hidden" style="box-shadow:0 2px 5px 0 rgba(0, 0, 0, .16), 0 2px 10px 0 rgba(0, 0, 0, .12) !important">
                        <div class="pd-x-20 pd-t-20 mg-t-10 d-flex align-items-center">
                            <i class="fe-user tx-60 lh-0 tx-white op-7"></i>
                            <div class="mg-l-20">
                                <p class="tx-10 tx-spacing-1 tx-mont tx-semibold tx-uppercase tx-white-8 mg-b-10">Widget #4</p>
                                <p class="tx-24 tx-white tx-lato tx-bold mg-b-0 lh-1">182</p>
                                <span class="tx-11 tx-roboto tx-white-8" style="color:#0866C6;">.</span>
                            </div>
                        </div>
                        <div class="ht-40 tr-y-1"></div>
                    </div>
                </a>
            </div> -->

        </div>
    </div>
    <!-- END WIDGET -->
<?= $this->endSection() ?>
<!-- END CONTENT -->