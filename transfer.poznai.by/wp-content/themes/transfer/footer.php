<div id="my-modal-4" class="modal-box hide">
    <div class="modal">
        <span class="close"></span>
        <div class="modal-header">Заказать звонок</div>
        <?php echo do_shortcode('[contact-form-7 id="39" title="Заказать звонок"]'); ?></div>
    </div>
</div>
<div id="my-modal-5" class="modal-box hide">
    <div class="modal">
        <span class="close"></span>
        <div class="modal-header">Забронировать номер</div>
        <?php echo do_shortcode('[contact-form-7 id="40" title="Забронировать номер"]'); ?></div>
    </div>
</div>
<div id="my-modal" class="modal-box hide">
    <div class="modal">
        <span class="close"></span>
        <div class="modal-header">3D-тур по отельному комплексу "Райский сад"</div>
        <div class="modal-body text-center"> <iframe src="http://edem-garden.com.ua/wp-content/themes/sad/360/Garden_of_Eden_360_Tour.html" width="100%" height="600px">
    Ваш браузер не поддерживает 3d тур, приносим свои извинения!
 </iframe></div>
    </div>
</div>

<div id="my-modal-2" class="modal-box hide">
    <div class="modal">
        <span class="close"></span>
        <div class="modal-header">Заказать трансфер</div>
        <div class="modal-body text-center"><p>Оставьте свои контактные данные для бронирования трансфера.</p><?php echo do_shortcode('[contact-form-7 id="41" title="Трансфер"]'); ?></div>
    </div>
</div>

<div id="my-modal-3" class="modal-box hide">
    <div class="modal">
        <span class="close"></span>
        <div class="modal-header">Задать вопрос менеджеру</div>
        <div class="modal-body text-center"><?php echo do_shortcode('[contact-form-7 id="42" title="Задать вопрос"]'); ?></div>
    </div>
</div>
<!-- Yandex.Metrika counter --> <script type="text/javascript"> (function (d, w, c) { (w[c] = w[c] || []).push(function() { try { w.yaCounter45077970 = new Ya.Metrika({ id:45077970, clickmap:true, trackLinks:true, accurateTrackBounce:true, webvisor:true }); } catch(e) { } }); var n = d.getElementsByTagName("script")[0], s = d.createElement("script"), f = function () { n.parentNode.insertBefore(s, n); }; s.type = "text/javascript"; s.async = true; s.src = "https://mc.yandex.ru/metrika/watch.js"; if (w.opera == "[object Opera]") { d.addEventListener("DOMContentLoaded", f, false); } else { f(); } })(document, window, "yandex_metrika_callbacks"); </script> <noscript><div><img src="https://mc.yandex.ru/watch/45077970" style="position:absolute; left:-9999px;" alt="" /></div></noscript> <!-- /Yandex.Metrika counter -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/dist/js/kube.js"></script>
<script>$('#tabs').on('init.tabs', function()
{
    // do something...
});</script>
<?php wp_footer(); ?>

</body>
</html>