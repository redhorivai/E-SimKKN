<?= $this->extend('front/layout/main_layout') ?>
<?= $this->section('content'); ?>
<!-- MAIN CONTENT -->
<div class="main-content">


  <!-- CONTENT -->
  <section>
    <div class="container mt-30 mb-30 pt-30 pb-30">
      <div class="row">
        <?= $resDetail; ?>
<script>
    var slideIndex = 1;
    showSlides(slideIndex);

    function plusSlides(n) {
      showSlides(slideIndex += n);
    }

    function currentSlide(n) {
      showSlides(slideIndex = n);
    }

    function showSlides(n) {
      var i;
      var slides = document.getElementsByClassName("mySlides");
      var dots = document.getElementsByClassName("demo");
      var captionText = document.getElementById("caption");
      if (n > slides.length) {slideIndex = 1}
      if (n < 1) {slideIndex = slides.length}
      for (i = 0; i < slides.length; i++) {
          slides[i].style.display = "none";
      }
      for (i = 0; i < dots.length; i++) {
          dots[i].className = dots[i].className.replace(" active", "");
      }
      slides[slideIndex-1].style.display = "block";
      dots[slideIndex-1].className += " active";
      captionText.innerHTML = dots[slideIndex-1].alt;
    }
</script>





        <div class="col-md-3">
          <div class="sidebar sidebar-right mt-sm-30">
            <div class="widget">
              <h5 class="widget-title line-bottom">Artikel Terbaru</h5>
              <div class="latest-posts">
                <?php
                foreach ($latestNews as $res) {

                  if (empty($res->thumbnail_nm)) {
                    $image = "<img src='" . base_url() . "/assets-front/images/placehold.it/75x75.png'>";
                  } else {
                    $image = "<img src='" . base_url() . "/image/artikel/" . $res->thumbnail_nm . "' style='max-width:75px;max-height:auto;'>";
                  }

                  $jmlStrTitle = strlen($res->title);
                  if ($jmlStrTitle >= 24) {
                    $titleStr = substr($res->title, 0, 24);
                    $title = $titleStr . '...';
                  } else {
                    $title = $res->title;
                  }

                  $jmlStrDesc = strlen($res->description);
                  if ($jmlStrDesc >= 43) {
                    $descStr = substr($res->description, 0, 43);
                    $description = $descStr . '...';
                  } else {
                    $description = $res->description;
                  }
                  if ($res->type == 'artikel') {
                    echo "<article class='post media-post clearfix pb-0 mb-10'>
                            <a class='post-thumb' href='" . base_url('/informasi/detail_artikel/' . $res->artikel_id . '') . "'>
                            " . $image . "
                            </a>
                            <div class='post-right'>
                              <h5 class='post-title' style='margin-top:-7px;margin-bottom:3px;'>
                                <a href='" . base_url('/informasi/detail_artikel/' . $res->artikel_id . '') . "'>
                                " . $title . "
                                </a>
                              </h5>
                              <p style='line-height:1.4;font-size:13px;'>" . $description . "</p>
                            </div>
                          </article>";
                  }
                }
                ?>
              </div>
            </div>
          </div>
        </div>

      </div>
    </div>
  </section>
  <!-- END CONTENT -->
</div>
<!-- END MAIN CONTENT -->
<?= $this->endSection() ?>