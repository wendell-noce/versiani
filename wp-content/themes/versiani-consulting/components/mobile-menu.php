<?php
/**
 * Mobile Menu
 *
 * The togglable menu template used for mobile devices
 *
 * @package Versiani
 */
?>

<div class="_mobile-menu d-lg-none pt-3" id="toggleable-menu">

    <div class="container">
        <div class="row align-items-center">
            <div class="col-2">
                <!-- Control button of toggleable menu -->
                <input type="checkbox"  class="d-lg-none" id="open-menu" aria-controls="toggleable-menu" aria-expanded="false">

                <!-- Menu bars -->
                <label for="open-menu" class="menu-icon mb-0 d-inline-block d-lg-none">
                    <span class="menu-bar mx-auto d-block"></span>
                    <span class="menu-bar mx-auto d-block"></span>
                    <span class="menu-bar mx-auto d-block"></span>
                </label>

                 <!-- Overlay menu-mobile -->
                <div class="menu-overlay d-lg-none"></div>

                <!-- MOBILE MENU -->
                <div class="_nav-menu">
                    <?php if( has_nav_menu( 'mobile-menu' ) ) : ?>
                        <nav class="mobile-navigation px-5" role="navigation">
                            <?php
                                wp_nav_menu( array(
                                    'theme_location'    => 'mobile-menu',
                                    'menu_class'        => 'mobile-menu list-unstyled',
                                    'container'         => false
                                    ) );
                            ?>
                        </nav>
                    <?php else: ?>
                        <p>No mobile menu found.</p>
                    <?php endif; ?>

                    <div class="tel px-5">
                        <span class="d-flex undecorated-link">
                            <span class="ico px-2"> <i class="icon-phone"></i> </span>
                            <span class="tel-number px-3"> <?= get_field('options_phone', 'option'); ?> </span>
                        </span>
                    </div>  

                    <div class="mail px-5 my-3">
                        <p>
                            <i class="icon-mail mr-2"></i> <?= get_field('contact_mail', 'option'); ?>
                        </p>
                    </div>

                    <div class="list-markets px-5 text-center">
                        <?= do_shortcode("[wpml_language_selector_widget]"); ?> 
                    </div>

                    <?php $linkdein = get_field('linkedin', 'option'); ?>
                    <div class="text-center">
                    <p class=""> <?= $linkdein['linkedin_text']; ?> <a href="<?= $linkdein['linkedin_url']; ?> " class="mt-3 undecorated-link pl-2"> <i class="icon-linkedin"></i> </a> </p>
                    </div>

                    <div class="friday px-5 text-center mt-4">
                        <p>
                            <a href="">
                                Developed by <img src="<?= Utils::get_image_asset( 'logo-friday.jpg' ); ?>" alt="Friday">
                            </a>
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-8 text-center">
            <?php Utils::get_template( 'components/logo' , array(
					'is_h1'=> true,
					'image_logo' => "logo.svg" 
				)); ?>
            </div>
        </div>
    </div>

</div><!-- ._menu-mobile -->

