<?php

/**
 * Search box
 *
 * @package tri
 *
 */
?>

<section class="_search-box bg-red py-6 transition">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 md-10 col-lg-9">
                <form class="search-form d-flex flex-wrap justify-content-around align-items-center" role="search" method="get" action="<?php echo esc_url(home_url('/')); ?>">
                    <h3 class="mb-0 mb-4 mb-lg-0 text-white"> BUSCAR POR </h3>
                    <input type="search" class="bg-red px-3 pb-2 mr-2" name="s" placeholder="Ex: Saúde" required>
                    <button type="submit" class="btn-send px-3 pb-2 transition"> <i class="icon-search"></i> </button>
                </form>
            </div>
        </div>
    </div>
</section>