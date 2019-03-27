<section class="cid-r9g8XOYiYv mbr-fullscreen mbr-parallax-background" id="header15-3">
    <div class="mbr-overlay" style="opacity: 0.5; background-color: rgb(7, 59, 76);"></div>
    <div class="container align-right">
      <div class="row">
        <div class="mbr-white col-lg-8 col-md-7 content-container header-caption">
          <h1 class="mbr-section-title mbr-bold pb-3 mbr-fonts-style display-1">
            ВОРОХТА</h1>
            <p class="mbr-text pb-3 mbr-fonts-style display-5">Недельный тур
              <br>«КАРПАТЫ - ВОРОХТА КРУГЛЫЙ ГОД»
              <br>8 вариантов отдыха на выбор каждый день, <br>ГОВЕРЛА, РАФТИНГ, Почаевская лавра,
              <br>+ с ноября по апрель - «ЛЫЖНЫЙ ТУР на БУКОВЕЛЬ»</p>
            </div>
            <div class="col-lg-4 col-md-5">
              <div class="form-container">
                <div class="media-container-column" data-form-type="formoid">
                  <?php
                  if($alert === true){
                    echo '<div class="alert alert-form alert-success text-xs-center align-center">Ваша заявка успешно отправлена</div>';
                  }
                  ?>
                  <form class="mbr-form" action="<?php echo $url; ?>?action=send" method="post">
                    <div data-for="name">
                      <div class="form-group">
                        <input type="text" class="form-control px-3" name="name"  placeholder="Имя" required="" id="name-header15-3">
                      </div>
                    </div>
                    <div data-for="phone">
                      <div class="form-group">
                        <input type="tel" class="form-control px-3" name="phone" placeholder="Телефон" id="phone-header15-3" required>
                      </div>
                    </div>
                    <span class="input-group-btn">
                      <button type="submit" class="btn btn-secondary btn-form display-4">обратный звонок</button>
                    </span>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="mbr-arrow hidden-sm-down" aria-hidden="true">
          <a href="#content4-k">
            <i class="mbri-down mbr-iconfont"></i>
          </a>
        </div>
      </section>
