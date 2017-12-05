<?php get_header(); ?>


<div class="container-fluid banner">
  <div class="row banner-container">
   <div class="banner-container__logo-box">
        <img src="<?php echo get_theme_file_uri('media//img/logo-white.png') ?>" alt="Logo" class="banner-container__logo">
    </div>
    <div class="col-12 banner-container__text-box">
        <h1 class="heading-primary">
            <span class="heading-primary--main">Our Community</span>
            <span class="heading-primary--sub">connect with people</span>
        </h1>
        <a href="#" class="btn-ex btn-ex--white btn-ex--animated">Join</a>
        <a href="#" class="btn-ex btn-ex--white btn-ex--animated">Log In</a>
    </div>
  </div>
</div>
<div class="container-fluid info">
    <div class="container">
        <div class="row">
            <div class="col-sm info__container">
                <span class="fa fa-lightbulb-o info__container__icon--yellow" aria-hidden="true"></span>
                <div class="info__container__text">
                    <p class="info__container__text--main">One of three columns</p>
                    <p class="info__container__text--sub">Some text go here</p>
                </div>
            </div>
            <div class="col-sm info__container">
                <span class="fa fa-lightbulb-o info__container__icon--green" aria-hidden="true"></span>
                <div class="info__container__text">
                    <p class="info__container__text--main">One of three columns</p>
                    <p class="info__container__text--sub">Some text go here</p>
                </div>
            </div>
            <div class="col-sm info__container">
                <span class="fa fa-lightbulb-o info__container__icon--pink" aria-hidden="true"></span>
                <div class="info__container__text">
                    <p class="info__container__text--main">One of three columns</p>
                    <p class="info__container__text--sub">Some text go here</p>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid news">
    <div class="container news__content">
        <div class="row">
          <div class="col-sm-6">
           <h2 class="news__content__header">Latest News</h2>
            <div class="card">
              <div class="card-header">Header</div>
              <div class="card-body">
                <h4 class="card-title">Special title treatment</h4>
                <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                <a href="#" class="btn btn-primary">Go somewhere</a>
              </div>
            </div>
          </div>
          <div class="col-sm-6">
           <h2 class="news__content__header">Upcoming Event</h2>
            <div class="card">
             <div class="card-header">Header</div>
              <div class="card-body">
                <h4 class="card-title">Special title treatment</h4>
                <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                <a href="#" class="btn btn-primary">Go somewhere</a>
              </div>
            </div>
          </div>
        </div>
    </div>
</div>
<footer>
    <div class="container-fluid footer">
        <div class="container">
            <div class="row">
                <div class="col-2 footer__logo">
                   <img src="<?php echo get_theme_file_uri('media//img/logo-white.png') ?>" alt="Logo" class="banner-container__logo">
                </div>
                <div class="col-4 footer__copyright">
                    <p class="footer__copyright__text">Copyright © 2017 Hercha</p>
                </div>
                <div class="col-2 footer__links">
                    <?php bootstrap_footer(); ?>
                </div>
                <div class="col-2 footer__links">
                    <?php bootstrap_footer2(); ?>
                </div>
                <div class="col-2 footer__links">
                    <?php bootstrap_footer3(); ?>
                </div>
            </div>
        </div>
    </div>
</footer>


<?php get_footer(); ?>