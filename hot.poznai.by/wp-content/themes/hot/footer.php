<div id="my-modal" class="modal-box hide">
    <div class="modal">
        <span class="close"></span>
        <div class="modal-header">Перезвонить Вам?</div>
        <div class="modal-body text-center"><p>Оставьте Ваш номер телефона, Наш менеджер свяжется с Вами в течение 10 минут!</p><?php echo do_shortcode('[contact-form-7 id="6" title="Перезвонить"]'); ?></div>
    </div>
</div>
<div id="my-modal-3" class="modal-box hide">
    <div class="modal">
        <span class="close"></span>
        <div class="modal-header">Задать вопрос менеджеру</div>
        <div class="modal-body text-center"><?php echo do_shortcode('[contact-form-7 id="8" title="Вопрос"]'); ?></div>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/dist/js/kube.js"></script>
<script>$('#tabs').on('init.tabs', function()
{
    // do something...
});</script>
<?php wp_footer(); ?>
</body>
</html>