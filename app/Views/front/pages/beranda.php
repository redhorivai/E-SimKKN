<?= $this->extend('front/layout/main_layout') ?>
<?= $this->section('content'); ?>
<!-- MAIN CONTENT -->
<div class="main-content">
    <!-- SECTION: SLIDER -->
    <section id="home" class="">
      <div class="container-fluid p-0" style="background:linear-gradient(45deg,#428cbe 0%,#3c9c1f 85%);">
      <!-- <div class="container-fluid p-0" style="background-image: url('/assets-front/images/red.jpg');background-size: cover;background-position: center center;"> -->
        <!-- Slider Revolution Start -->
        <div class="rev_slider_wrapper">
          <div class="rev_slider" data-version="5.0">
            <ul>

              <!-- SLIDE 1 -->
              <li data-index="rs-1" data-transition="random" data-slotamount="7"  data-easein="default" data-easeout="default" data-masterspeed="1000"  data-thumb="<?= base_url(); ?>/assets-front/images/red.jpg"  data-rotate="0"  data-fstransition="fade" data-fsmasterspeed="1500" data-fsslotamount="7" data-saveperformance="off"  data-title="Intro" data-description="">
                <!-- MAIN IMAGE -->
                <img src=""   data-bgposition="center top" data-bgfit="cover" data-bgrepeat="no-repeat" class="rev-slidebg" data-bgparallax="6" data-no-retina>
                <!-- LAYERS -->

                <!-- LAYER NR. 1 -->
                <div class="tp-caption tp-resizeme text-center text-white pl-30 pr-30"
                  id="rs-1-layer-1"
                
                  data-x="['center']"
                  data-hoffset="['0']"
                  data-y="['middle']"
                  data-voffset="['-5']" 
                  data-fontsize="['24']"
                  data-lineheight="['40']"
                  data-width="none"
                  data-height="none"
                  data-whitespace="nowrap"
                  data-transform_idle="o:1;s:500"
                  data-transform_in="y:100;scaleX:1;scaleY:1;opacity:0;"
                  data-transform_out="x:left(R);s:1000;e:Power3.easeIn;s:1000;e:Power3.easeIn;"
                  data-mask_in="x:0px;y:0px;s:inherit;e:inherit;"
                  data-mask_out="x:inherit;y:inherit;s:inherit;e:inherit;"
                  data-start="1000" 
                  data-splitin="none" 
                  data-splitout="none" 
                  data-responsive_offset="on"
                  style="z-index: 5; white-space: nowrap; letter-spacing:0px; font-weight:100;">| Kuliah Kerja Nyata |
                </div>

                <!-- LAYER NR. 2 -->
                <div class="tp-caption tp-resizeme text-uppercase text-white pl-40 pr-40"
                  id="rs-1-layer-2"

                  data-x="['center']"
                  data-hoffset="['0']"
                  data-y="['middle']"
                  data-voffset="['-90']"
                  data-fontsize="['58']"
                  data-lineheight="['70']"
                  data-width="none"
                  data-height="none"
                  data-whitespace="nowrap"
                  data-transform_idle="o:1;s:500"
                  data-transform_in="y:100;scaleX:1;scaleY:1;opacity:0;"
                  data-transform_out="x:left(R);s:1000;e:Power3.easeIn;s:1000;e:Power3.easeIn;"
                  data-mask_in="x:0px;y:0px;s:inherit;e:inherit;"
                  data-mask_out="x:inherit;y:inherit;s:inherit;e:inherit;"
                  data-start="1000" 
                  data-splitin="none" 
                  data-splitout="none" 
                  data-responsive_offset="on"
                  style="z-index: 7; text-transform: none; white-space: nowrap; font-weight:600; border-radius:45px;">Universitas Muhammadyah Palembang 
                </div>

                <!-- LAYER NR. 3 -->
                <!-- <div class="tp-caption tp-resizeme text-center text-black" 
                  id="rs-1-layer-3"

                  data-x="['center']"
                  data-hoffset="['0']"
                  data-y="['middle']"
                  data-voffset="['50','60','70']"
                  data-fontsize="['16','18','24']"
                  data-lineheight="['28']"
                  data-width="none"
                  data-height="none"
                  data-whitespace="nowrap"
                  data-transform_idle="o:1;s:500"
                  data-transform_in="y:100;scaleX:1;scaleY:1;opacity:0;"
                  data-transform_out="x:left(R);s:1000;e:Power3.easeIn;s:1000;e:Power3.easeIn;"
                  data-mask_in="x:0px;y:0px;s:inherit;e:inherit;"
                  data-mask_out="x:inherit;y:inherit;s:inherit;e:inherit;"
                  data-start="1400" 
                  data-splitin="none" 
                  data-splitout="none" 
                  data-responsive_offset="on"
                  style="z-index: 5; white-space: nowrap; letter-spacing:0px; font-weight:400;">Every day we bring hope to millions of children in the world's<br>  hardest places as a sign of God's unconditional love.
                </div> -->

                <!-- LAYER NR. 4 -->
                <div class="tp-caption tp-resizeme" 
                  id="rs-1-layer-4"

                  data-x="['center']"
                  data-hoffset="['0']"
                  data-y="['middle']"
                  data-voffset="['135','145','155']"
                  data-width="none"
                  data-height="none"
                  data-whitespace="nowrap"
                  data-transform_idle="o:1;"
                  data-transform_in="y:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:0;s:2000;e:Power4.easeInOut;" 
                  data-transform_out="y:[100%];s:1000;e:Power2.easeInOut;s:1000;e:Power2.easeInOut;" 
                  data-mask_in="x:0px;y:[100%];s:inherit;e:inherit;" 
                  data-mask_out="x:inherit;y:inherit;s:inherit;e:inherit;"
                  data-start="1400" 
                  data-splitin="none" 
                  data-splitout="none" 
                  data-responsive_offset="on"
                  style="z-index: 5; white-space: nowrap; letter-spacing:1px;">
                  <a class="btn btn-default btn-theme-colored pl-20 pr-20" href="<?= base_url('/profil/tentangkami'); ?>">Selengkapnya</a> 
                </div>
              </li>

              <!-- SLIDE 2 -->
              <!-- <li data-index="rs-2" data-transition="random" data-slotamount="7"  data-easein="default" data-easeout="default" data-masterspeed="1000"  data-thumb="<?= base_url(); ?>/assets-front/images/bg/bg23.jpg"  data-rotate="0"  data-fstransition="fade" data-fsmasterspeed="1500" data-fsslotamount="7" data-saveperformance="off"  data-title="Intro" data-description=""> -->
                <!-- MAIN IMAGE -->
                <!-- <img src="<?= base_url(); ?>/assets-front/images/bg/bg23.jpg"   data-bgposition="center center" data-bgfit="cover" data-bgrepeat="no-repeat" class="rev-slidebg" data-bgparallax="6" data-no-retina> -->
                <!-- LAYERS -->

                <!-- LAYER NR. 1 -->
                <!-- <div class="tp-caption tp-resizeme text-uppercase text-white bg-dark-transparent-5 pl-15 pr-15"
                  id="rs-2-layer-1"

                  data-x="['left']"
                  data-hoffset="['30']"
                  data-y="['middle']"
                  data-voffset="['-110']" 
                  data-fontsize="['30']"
                  data-lineheight="['50']"

                  data-width="none"
                  data-height="none"
                  data-whitespace="nowrap"
                  data-transform_idle="o:1;s:500"
                  data-transform_in="y:100;scaleX:1;scaleY:1;opacity:0;"
                  data-transform_out="x:left(R);s:1000;e:Power3.easeIn;s:1000;e:Power3.easeIn;"
                  data-mask_in="x:0px;y:0px;s:inherit;e:inherit;"
                  data-mask_out="x:inherit;y:inherit;s:inherit;e:inherit;"
                  data-start="1000" 
                  data-splitin="none" 
                  data-splitout="none" 
                  data-responsive_offset="on"
                  style="z-index: 7; white-space: nowrap; font-weight:600;">We Provide Total
                </div> -->

                <!-- LAYER NR. 2 -->
                <!-- <div class="tp-caption tp-resizeme text-uppercase text-white bg-theme-colored-transparent pl-15 pr-15"
                  id="rs-2-layer-2"

                  data-x="['left']"
                  data-hoffset="['30']"
                  data-y="['middle']"
                  data-voffset="['-45']" 
                  data-fontsize="['48']"
                  data-lineheight="['70']"

                  data-width="none"
                  data-height="none"
                  data-whitespace="nowrap"
                  data-transform_idle="o:1;s:500"
                  data-transform_in="y:100;scaleX:1;scaleY:1;opacity:0;"
                  data-transform_out="x:left(R);s:1000;e:Power3.easeIn;s:1000;e:Power3.easeIn;"
                  data-mask_in="x:0px;y:0px;s:inherit;e:inherit;"
                  data-mask_out="x:inherit;y:inherit;s:inherit;e:inherit;"
                  data-start="1000" 
                  data-splitin="none" 
                  data-splitout="none" 
                  data-responsive_offset="on"
                  style="z-index: 7; white-space: nowrap; font-weight:600;">Health Care Solution 
                </div> -->

                <!-- LAYER NR. 3 -->
                <!-- <div class="tp-caption tp-resizeme text-black" 
                  id="rs-2-layer-3"

                  data-x="['left']"
                  data-hoffset="['35']"
                  data-y="['middle']"
                  data-voffset="['35','45','55']"
                  data-fontsize="['16','18','24']"
                  data-lineheight="['28']"
                  data-width="none"
                  data-height="none"
                  data-whitespace="nowrap"
                  data-transform_idle="o:1;s:500"
                  data-transform_in="y:100;scaleX:1;scaleY:1;opacity:0;"
                  data-transform_out="x:left(R);s:1000;e:Power3.easeIn;s:1000;e:Power3.easeIn;"
                  data-mask_in="x:0px;y:0px;s:inherit;e:inherit;"
                  data-mask_out="x:inherit;y:inherit;s:inherit;e:inherit;"
                  data-start="1400" 
                  data-splitin="none" 
                  data-splitout="none" 
                  data-responsive_offset="on"
                  style="z-index: 5; white-space: nowrap; letter-spacing:0px; font-weight:400;">Every day we bring hope to millions of children in the world's<br>  hardest places as a sign of God's unconditional love.
                </div> -->

                <!-- LAYER NR. 4 -->
                <!-- <div class="tp-caption tp-resizeme" 
                  id="rs-2-layer-4"

                  data-x="['left']"
                  data-hoffset="['35']"
                  data-y="['middle']"
                  data-voffset="['110','120','140']"
                  data-width="none"
                  data-height="none"
                  data-whitespace="nowrap"
                  data-transform_idle="o:1;"
                  data-transform_in="y:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:0;s:2000;e:Power4.easeInOut;" 
                  data-transform_out="y:[100%];s:1000;e:Power2.easeInOut;s:1000;e:Power2.easeInOut;" 
                  data-mask_in="x:0px;y:[100%];s:inherit;e:inherit;" 
                  data-mask_out="x:inherit;y:inherit;s:inherit;e:inherit;"
                  data-start="1400" 
                  data-splitin="none" 
                  data-splitout="none" 
                  data-responsive_offset="on"
                  style="z-index: 5; white-space: nowrap; letter-spacing:1px;"><a class="btn btn-colored btn-lg btn-theme-colored pl-20 pr-20" href="#">View Details</a> 
                </div>
              </li> -->

              <!-- SLIDE 3 -->
              <!-- <li data-index="rs-3" data-transition="random" data-slotamount="7"  data-easein="default" data-easeout="default" data-masterspeed="1000"  data-thumb="<?= base_url(); ?>/assets-front/images/bg/bg24.jpg"  data-rotate="0"  data-fstransition="fade" data-fsmasterspeed="1500" data-fsslotamount="7" data-saveperformance="off"  data-title="Intro" data-description=""> -->
                <!-- MAIN IMAGE -->
                <!-- <img src="<?= base_url(); ?>/assets-front/images/bg/bg24.jpg"   data-bgposition="center top" data-bgfit="cover" data-bgrepeat="no-repeat" class="rev-slidebg" data-bgparallax="6" data-no-retina> -->
                <!-- LAYERS -->

                <!-- LAYER NR. 1 -->
                <!-- <div class="tp-caption tp-resizeme text-uppercase text-white bg-dark-transparent-5 pl-15 pr-15"
                  id="rs-3-layer-1"

                  data-x="['right']"
                  data-hoffset="['30']"
                  data-y="['middle']"
                  data-voffset="['-110']" 
                  data-fontsize="['30']"
                  data-lineheight="['50']"

                  data-width="none"
                  data-height="none"
                  data-whitespace="nowrap"
                  data-transform_idle="o:1;s:500"
                  data-transform_in="y:100;scaleX:1;scaleY:1;opacity:0;"
                  data-transform_out="x:left(R);s:1000;e:Power3.easeIn;s:1000;e:Power3.easeIn;"
                  data-mask_in="x:0px;y:0px;s:inherit;e:inherit;"
                  data-mask_out="x:inherit;y:inherit;s:inherit;e:inherit;"
                  data-start="1000" 
                  data-splitin="none" 
                  data-splitout="none" 
                  data-responsive_offset="on"
                  style="z-index: 7; white-space: nowrap; font-weight:600;">We Provide Total
                </div> -->

                <!-- LAYER NR. 2 -->
                <!-- <div class="tp-caption tp-resizeme text-uppercase text-white bg-theme-colored-transparent pl-15 pr-15"
                  id="rs-3-layer-2"

                  data-x="['right']"
                  data-hoffset="['30']"
                  data-y="['middle']"
                  data-voffset="['-45']" 
                  data-fontsize="['48']"
                  data-lineheight="['70']"

                  data-width="none"
                  data-height="none"
                  data-whitespace="nowrap"
                  data-transform_idle="o:1;s:500"
                  data-transform_in="y:100;scaleX:1;scaleY:1;opacity:0;"
                  data-transform_out="x:left(R);s:1000;e:Power3.easeIn;s:1000;e:Power3.easeIn;"
                  data-mask_in="x:0px;y:0px;s:inherit;e:inherit;"
                  data-mask_out="x:inherit;y:inherit;s:inherit;e:inherit;"
                  data-start="1000" 
                  data-splitin="none" 
                  data-splitout="none" 
                  data-responsive_offset="on"
                  style="z-index: 7; white-space: nowrap; font-weight:600;">Health Care Solution 
                </div> -->

                <!-- LAYER NR. 3 -->
                <!-- <div class="tp-caption tp-resizeme text-right text-black" 
                  id="rs-3-layer-3"

                  data-x="['right']"
                  data-hoffset="['35']"
                  data-y="['middle']"
                  data-voffset="['30','40','50']"
                  data-fontsize="['16','18','24']"
                  data-lineheight="['28']"
                  data-width="none"
                  data-height="none"
                  data-whitespace="nowrap"
                  data-transform_idle="o:1;s:500"
                  data-transform_in="y:100;scaleX:1;scaleY:1;opacity:0;"
                  data-transform_out="x:left(R);s:1000;e:Power3.easeIn;s:1000;e:Power3.easeIn;"
                  data-mask_in="x:0px;y:0px;s:inherit;e:inherit;"
                  data-mask_out="x:inherit;y:inherit;s:inherit;e:inherit;"
                  data-start="1400" 
                  data-splitin="none" 
                  data-splitout="none" 
                  data-responsive_offset="on"
                  style="z-index: 5; white-space: nowrap; letter-spacing:0px; font-weight:400;">Every day we bring hope to millions of children in the world's<br>  hardest places as a sign of God's unconditional love.
                </div> -->

                <!-- LAYER NR. 4 -->
                <!-- <div class="tp-caption tp-resizeme" 
                  id="rs-3-layer-4"

                  data-x="['right']"
                  data-hoffset="['35']"
                  data-y="['middle']"
                  data-voffset="['110','120','140']"
                  data-width="none"
                  data-height="none"
                  data-whitespace="nowrap"
                  data-transform_idle="o:1;"
                  data-transform_in="y:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:0;s:2000;e:Power4.easeInOut;" 
                  data-transform_out="y:[100%];s:1000;e:Power2.easeInOut;s:1000;e:Power2.easeInOut;" 
                  data-mask_in="x:0px;y:[100%];s:inherit;e:inherit;" 
                  data-mask_out="x:inherit;y:inherit;s:inherit;e:inherit;"
                  data-start="1400" 
                  data-splitin="none" 
                  data-splitout="none" 
                  data-responsive_offset="on"
                  style="z-index: 5; white-space: nowrap; letter-spacing:1px;"><a class="btn btn-colored btn-lg btn-theme-colored pl-20 pr-20" href="#">View Details</a> 
                </div>
              </li> -->

            </ul>
          </div><!-- end .rev_slider -->
        </div>
        <!-- end .rev_slider_wrapper -->
        <script>
          $(document).ready(function(e) {
            var revapi = $(".rev_slider").revolution({
              sliderType:"standard",
              sliderLayout: "auto",
              dottedOverlay: "none",
              delay: 5000,
              navigation: {
                  keyboardNavigation: "off",
                  keyboard_direction: "horizontal",
                  mouseScrollNavigation: "off",
                  onHoverStop: "off",
                  touch: {
                      touchenabled: "on",
                      swipe_threshold: 75,
                      swipe_min_touches: 1,
                      swipe_direction: "horizontal",
                      drag_block_vertical: false
                  },
                    bullets: {
                    enable: true,
                    hide_onmobile: true,
                    hide_under: 600,
                    style: "hebe",
                    hide_onleave: false,
                    direction: "horizontal",
                    h_align: "center",
                    v_align: "bottom",
                    h_offset: 0,
                    v_offset: 30,
                    space: 5,
                    tmp: '<span class="tp-bullet-image"></span><span class="tp-bullet-imageoverlay"></span><span class="tp-bullet-title"></span>'
                }
              },
              responsiveLevels: [1240, 1024, 778],
              visibilityLevels: [1240, 1024, 778],
              gridwidth: [1170, 1024, 778, 480],
              gridheight: [680, 500, 400, 400],
              lazyType: "none",
              parallax: {
                  origo: "slidercenter",
                  speed: 1000,
                  levels: [5, 10, 15, 20, 25, 30, 35, 40, 45, 46, 47, 48, 49, 50, 100, 55],
                  type: "scroll"
              },
              shadow: 0,
              spinner: "off",
              stopLoop: "on",
              stopAfterLoops: 0,
              stopAtSlide: -1,
              shuffle: "off",
              autoHeight: "off",
              fullScreenAutoWidth: "off",
              fullScreenAlignForce: "off",
              fullScreenOffsetContainer: "",
              fullScreenOffset: "0",
              hideThumbsOnMobile: "off",
              hideSliderAtLimit: 0,
              hideCaptionAtLimit: 0,
              hideAllCaptionAtLilmit: 0,
              debugMode: false,
              fallbacks: {
                  simplifyAll: "off",
                  nextSlideOnWindowFocus: "off",
                  disableFocusListener: false,
              }
            });
          });
        </script>
        <!-- Slider Revolution Ends -->
      </div>
    </section>

    <!-- SECTION: HOME-BOXES -->
    <!-- <section class="">
      <div class="container pt-0 pb-0">
        <div class="section-content" style="box-shadow: 0 4px 32px 0 rgba(10,14,29,.02),0 8px 64px 0 rgba(10,14,29,.08);">
          <div class="row equal-height-inner home-boxes mt-sm-20" data-margin-top="-80px">
            <div class="col-sm-12 col-md-3 pr-0 pr-sm-15 sm-height-auto mt-sm-0 wow fadeInLeft animation-delay1">
              <a href="<?= base_url('/pelayanan/layanan_unggulan'); ?>">
                <div class="sm-height-auto bg-theme-colored-white">
                  <div class="text-center pt-30 pb-30 pr-60 pl-60">
                    <i class="fa fa-stethoscope text-green3 font-64 pt-10"></i>
                    <h5 class="text-uppercase text-green3">Fasilitas Layanan</h5>
                  </div>
                </div>
              </a>
            </div>
            <div class="col-sm-12 col-md-3 pl-0 pl-sm-15 pr-0 pr-sm-15 sm-height-auto mt-sm-0 wow fadeInLeft animation-delay2">
              <a href="<?= base_url('/pasien/pendaftaran_online'); ?>">
                <div class="sm-height-auto bg-theme-colored-white">
                  <div class="text-center pt-30 pb-30">
                    <i class="fa fa-comments-o text-green3 font-64"></i>
                    <h5 class="text-uppercase text-green3">Online Service</h5>
                  </div>
                </div>
              </a>
            </div>
            <div class="col-sm-12 col-md-3 pl-0 pl-sm-15 pr-0 pr-sm-15 sm-height-auto mt-sm-0 wow fadeInLeft animation-delay3">
              <a href="<?= base_url('/informasi/poli'); ?>">
                <div class="sm-height-auto bg-theme-colored-white">
                  <div class="text-center pt-30 pb-30">
                    <i class="fa fa-user-md text-green3 font-64"></i>
                    <h5 class="text-uppercase text-green3">Dokter</h5>
                  </div>
                </div>
              </a>
            </div>
            <div class="col-sm-12 col-md-3 pl-0 pl-sm-15 sm-height-auto mt-sm-0 wow fadeInLeft animation-delay4">
              <a href="<?= base_url('/informasi/tarif'); ?>">
                <div class="sm-height-auto bg-theme-colored-white">
                  <div class="text-center pt-30 pb-30">
                    <i class="flaticon-medical-ambulance14 text-green3 font-64"></i>
                    <h5 class="text-uppercase text-green3">Tarif Layanan</h5>
                  </div>
                </div>
              </a>
            </div>
          </div>
        </div>
      </div>
    </section> -->

    <!-- SECTION: KATA SAMBUTAN -->
    <!-- <section class="">
      <div class="container pb-0">
        <div class="row">
          <div class="col-md-4">
            <h3 class="text-gray mt-0 mt-sm-30 mb-0">Selamat Datang di</h3>
            <h2 class="text-dark mt-0">RSUD Palembang BARI</h2>
            <p class="font-weight-600">Kesembuhan Dan Kepuasan Pelanggan Adalah Kebahagian Kami</p>
            <p class="mt-20">Selamat Datang di Website Resmi RSUD Palembang BARI
Assalamu'alaikum Wr.Wb.
Puji Syukur kami panjatkan kehadirat Allah SWT karena atas berkat dan rahmatNya sehingga pelayanan informasi melalui media website dapat hadir sebagai...</p>
            <p class="mt-20 mb-0"><img src="<?= base_url(); ?>/assets-front/images/sign_direktur.png"></p>
            <p class="mt-0 text-black">dr. Hj. Makiani, S.H.,M.M.,MARS</p>
            <a href="<?= base_url('/profil/tentangkami'); ?>" class="btn btn-default btn-theme-colored mt-15 mb-sm-30">Baca Selengkapnya</a>
          </div>
          <div class="col-md-4">
            <img src="<?= base_url(); ?>/assets-front/images/about/direktur-crop.PNG">
          </div>
          <div class="col-md-4">
            <div class="border-10px p-0">
              <div class="opening-hours text-left">
              <img src="<?= base_url(); ?>/assets-front/images/sertifikat.png">
              </div>
            </div>
          </div>
        </div>
      </div>
    </section> -->

    <!-- DIVIDER: FUNFACT -->
    <!-- <section class="divider parallax layer-overlay overlay-theme-colored-10" data-bg-img="<?= base_url(); ?>/assets-front/images/gedung.jpg" data-parallax-ratio="0.7">
      <div class="container pt-60 pb-60">
        <div class="row">
          <div class="col-xs-12 col-sm-12 col-md-12 mb-md-50">
            <div class="funfact text-center">
              <i class="pe-7s-smile mt-5 text-white"></i>
              <h2 class="animate-number text-white font-30 font-weight-500">Kesembuhan Dan Kepuasan Pelanggan Adalah Kebahagiaan Kami</h2>
            </div>
          </div>
        </div>
      </div>
    </section> -->

    <!-- SECTION: 5 LAYANAN UNGGULAN -->
    <!-- <section data-bg-img="<?= base_url(); ?>/assets-front/images/pattern/p4.png">
      <div class="container">
        <div class="section-title text-center">
          <div class="row">
            <div class="col-md-8 col-md-offset-2">
              <h2 class="text-uppercase mt-0 line-height-1">5 Layanan Unggulan</h2>
              <div class="title-icon">
                <img class="mb-10" src="<?= base_url(); ?>/assets-front/images/title-icon.png">
              </div>
              <p>Layanan unggulan adalah suatu layanan didukung oleh teknologi terbaik dibidangnya, komprehensif pada layanan klinik berfokus pada penyakit tertentu.</p>
            </div>
          </div>
        </div>
        <div class="section-centent">
          <div class="row">
            <?= $resLayananUnggulan; ?>
          </div>
        </div>
      </div>
    </section> -->

    <!-- SECTION ARTIKEL -->
    <section id="blog">
      <div class="container">
        <div class="section-title text-center">
          <div class="row">
            <div class="col-md-8 col-md-offset-2">
              <h2 class="text-uppercase mt-0 line-height-1">Berita Terbaru</h2>
              <div class="title-icon">
                <img class="mb-10" src="<?= base_url(); ?>/assets-front/images/title-icon.png">
              </div>
              <p>Informasi Seputar KKN Unviersitas Muhammadyah Palembang</p>
            </div>
          </div>
        </div>
        <div class="section-content">
          <div class="row">
            <div class="col-md-12">
              <div class="owl-carousel-3col">
                <?= $resArtikel; ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- END SECTION ARTIKEL -->
    
</div>
<!-- END MAIN CONTENT -->
<?= $this->endSection() ?>