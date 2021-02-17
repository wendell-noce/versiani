<?php
/**
 * Feature Post
 * 
 * Home feature post
 * 
 * @package vec
 */
$bgColor = Utils::hexToRgb($category_color);
?>

<div class="_feature-post my-6">
    <div class='container'>
        <div class='row align-items-strech'>
            <div class='col-12 col-md-6 col-lg-9 px-0'> 
                <div class="image" data-style data-border-color="<?php echo  $category_color; ?>">
                    <span class="category d-inline-block px-2 pb-2" data-style data-background-color="<?php echo  $category_color; ?>">
                        <a href="<?php echo $cat_url; ?>" class="undecorated-link text-white"> <?php echo $category; ?> </a>
                    </span>
                    <a href="<?= $url_post; ?>" class="undecorated-link">
                        <img src="<?php echo $image_src; ?>" alt="<?php echo $image_alt; ?>" width="<?php echo $image_width; ?>" height="<?php echo $image_height; ?>" >
                    </a>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-3 px-0">
                <div class="content py-4 px-3 h-100" data-style data-border-color="<?php echo  $category_color; ?>" data-background-color="rgba(<?= $bgColor['r']; ?>,<?= $bgColor['g']; ?>, <?= $bgColor['b']; ?>, .07)">
                    <a href="<?= $url_post; ?>" class="d-block undecorated-link">
                        <h2 class="title mb-5" data-style data-color="<?php echo $category_color; ?>"> <?= $title; ?></h2>
                        <p>
                            <?= $content; ?>
                        </p>
                        <span class="post-link mt-4"> LER MAIS <i class="triangle"></i> </span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>