<div class="footer-wrap">

  <div class="footer like-section" data-aos="fade-up">

    <div class="foot-col about">
      <div class="foot-col-content">
        <div class="foot-logo">
          <img src="<?= $src_url.$about['info']->logo['img']; ?>" alt="<?= $about['info']->logo['title']; ?>">
        </div>
        <p class="foot-about-content">
          <?= $about['info']->companyDesc; ?>
        </p>
        <h6 class="foot-contact-title">Адрес:</h6>
        <p class="foot-about-content address">
          <?= $about['contacts']->address; ?>
        </p>
      </div>
    </div>


    <div class="foot-col contact">
      <div class="foot-col-content">

        <?php if(isset($about['contacts']->phone) && count($about['contacts']->phone) > 0): ?>

          <div class="foot-block telephon">
            <h6 class="foot-contact-title">Телефон:</h6>

            <?php foreach($about['contacts']->phone as $phone): ?>
              <div class="foot-row">
                <i class="<?= $phone->ico; ?> contact-ico"></i>
                <?php if(isset($phone->messenger) && count($phone->messenger) > 0): ?>
                  <?php foreach($phone->messenger as $mess): ?>
                    <i class="<?= $mess['ico']; ?> contact-ico"></i>
                  <?php endforeach; ?>
                <?php endif; ?>
                <a href="tel:<?= $phone->num_link; ?>" class="contact-link" title="<?= $phone->operator; ?>"><?= $phone->num_value; ?></a>
              </div>
            <?php endforeach; ?>
          </div>
        <?php endif; ?>
        <?php if(isset($about['contacts']->email) && count($about['contacts']->email > 0)): ?>
          <div class="foot-block email">
            <h6 class="foot-contact-title">Email:</h6>
            <?php foreach($about['contacts']->email as $email): ?>
              <div class="foot-row">
                <i class="contact-ico email-ico"></i>
                <a href="mailto://<?= $email; ?>" class="contact-link"><?= $email; ?></a>
              </div>
            <?php endforeach; ?>
          </div>
        <?php endif; ?>
      </div>
    </div>

    <?php if(isset($about['contacts']->social) && count($about['contacts']->social) > 0): ?>
      <div class="foot-col social">
        <?php foreach($about['contacts']->social as $social): ?>
          <a href="<?= $social->link; ?>" class="social-ico <?= $social->ico; ?>" title="<?= $social->name; ?>" target="_blank"></a>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>
  </div>

</div>
