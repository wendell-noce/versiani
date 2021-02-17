<div class="site-logo<?= isset($logo_class) ? $logo_class : ""; ?>">
    <a href="<?= home_url('/'); ?>" aria-label="<?php bloginfo('name'); ?>" class="undecorated-link d-block">
        <img src="<?= Utils::get_image_asset($image_logo); ?>" alt="Planeta Notícia" class="" width="">
    </a>
</div>