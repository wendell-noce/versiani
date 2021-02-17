<?php
/**
 * Page Header
 * 
 * Add the component description here...
 * 
 * @package vec
 */
?>

<div class="_page-header py-8 position-relative">
    <?php Utils::get_template( 'components/languages', array() ); ?>

    <div class='container'>
        <div class='row'>
            <div class='col-12'>
                

                <div class="content <?= (isset($bg)) ? $bg : 'bg-blue'; ?> py-8 position-relative">
                    <div class="title"> 
                        <hr class="barra">
                        <h1 class="animated fadeInLeft"> <?= $title; ?> </h1>
                        <p class="animated fadeInLeft"> <?= $desc; ?></p>
                    </div>

                    <div class="image text-right">
                        <img src="<?= $img_url; ?>" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>