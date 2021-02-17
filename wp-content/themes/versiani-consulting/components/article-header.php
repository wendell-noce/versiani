<?php
/**
 * Article Header
 * 
 * Add the component description here...
 * 
 * @package tri
 */
?>

<div class="_article-header mb-6">
    <span class="category d-inline-block px-2 pb-2 mt-4" data-style data-background-color="<?php echo  $color; ?>">
        <a href="<?php echo $cat_url; ?>" class="undecorated-link"> <?php echo $category; ?> </a>
    </span>
    
    <h1 class="title mb-5 mt-2" data-style data-color="<?php echo $color; ?>"> <?php echo $title; ?> </h1>

    <div class="excerpt">
        <p> <?php echo $excerpt; ?></p>
    </div>

    <div class="author-date font-roboto">
        <p class="autor mb-1"> <?php echo $autor; ?> </p>
        <p class="date" itemprop="datePublished"> <?php echo $date; ?> </p>
    </div>
    
</div>