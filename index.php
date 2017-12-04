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
        <a href="#" class="btn btn--white btn--animated">Join</a>
        <a href="#" class="btn btn--white btn--animated">Log In</a>
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
    <div class="row">
        <div class="col-12">
           <h1 class="test">Hello</h1>
        </div>
        <div class="col-sm">
          One of three columns
        </div>
        <div class="col-sm">
          One of three columns
        </div>
        <div class="col-sm">
          One of three columns
        </div>
    </div>
</div>
<footer>
    <div class="container-fluid footer">
        <div class="row">
            <div class="col-12">
               <h1 class="test">Hello</h1>
            </div>
            <div class="col-sm">
              One of three columns
            </div>
            <div class="col-sm">
              One of three columns
            </div>
            <div class="col-sm">
              One of three columns
            </div>
        </div>
    </div>
</footer>


<?php get_footer(); ?>