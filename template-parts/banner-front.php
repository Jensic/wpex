<div class="container-fluid frontbanner">
  <div class="row frontbanner__container">
   <div class="frontbanner__container__logo-box">
       <i class="fa fa-users" aria-hidden="true"></i>
    </div>
    <div class="col-12 frontbanner__container__text-box">
        
        <h1 class="heading-primary">
            <span class="heading-primary--main">Worktogether</span>
            <span class="heading-primary--sub">connect with people</span>
        </h1>
                 
        <?php if (is_user_logged_in()) { ?>

        <?php } else { ?>
            <a href="<?php echo wp_registration_url(); ?>" class="btn-ex btn-ex--white btn-ex--animated">Join</a>
            <a href="<?php echo wp_login_url(); ?>" class="btn-ex btn-ex--white btn-ex--animated">Log In</a>
       <?php } ?>
    
    </div>
  </div>
</div>