<p class="info">
    <?php OC_Util::getEditionString() === '' ? '' : p('© 2013 '); ?>
    <a href="<?php p(OC_Defaults::getBaseUrl())?>">
        <?php  p(OC_Defaults::getEntity()); ?></a>
    <?php OC_Util::getEditionString() === '' ? print_unescaped(' &ndash; ') : print_unescaped('<br/>'); ?>
<?php p(OC_Defaults::getSlogan()); ?></p>
