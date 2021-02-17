<?php
/**
 * Share Box
 * 
 * Add the component description here...
 * 
 * @package tri
 */

$actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

$urlimage;
$href_facebook = "https://www.facebook.com/sharer/sharer.php?u=" . urlencode(get_permalink(get_the_ID())) . "&t=" . urlencode(get_the_title()) . "";
$href_twitter;
$href_pinterest;
$href_email;
$href_whatsapp;

$href_vk = "http://vk.com/share.php?url" . $actual_link;
$href_ok = "https://connect.ok.ru/dk?st.cmd=WidgetSharePreview&amp;st.shareUrl=" . $actual_link;
if (isset($image_id)) {
    $urlimage = wp_get_attachment_image_src($image_id, 'full');
    $href_twitter = "https://twitter.com/intent/tweet?text=" . $urlimage[0] . " - " . urlencode(get_the_title()) . "";
    $href_pinterest = "https://pinterest.com/pin/create/button/?url=" . urlencode(get_permalink(get_the_ID())) . "&media=" . $urlimage[0] . "&description=" . urlencode(get_the_title()) . "";
    $href_email = "mailto:?subject=" . get_the_title() . "&amp;body=" . $urlimage[0] . "";
    $href_whatsapp = "https://api.whatsapp.com/send?text=" . $urlimage[0] . " - " . urlencode(get_the_title()) . "";
} else {
    $urlimage = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'full');
    $href_twitter = "https://twitter.com/intent/tweet?text=" . urlencode(get_permalink(get_the_ID())) . " - " . urlencode(get_the_title()) . "";
    $href_pinterest = "https://pinterest.com/pin/create/button/?url=" . urlencode(get_permalink(get_the_ID())) . "&media=" . $urlimage[0] . "&description=" . urlencode(get_the_title()) . "";
    $href_email = "mailto:?subject=" . get_the_title() . "&amp;body=" . urlencode(get_permalink(get_the_ID())) . "";
    $href_whatsapp = "https://api.whatsapp.com/send?text=" . urlencode(get_permalink(get_the_ID())) . " - " . urlencode(get_the_title()) . "";
}
?>

<div class="_share-box text-center px-3 py-2">
    <a href="#" class="open-share d-block"> <i class="icon-share"></i> </a>
    <ul class="list-unstyled _share-box-list">
        <li>
            <a aria-label="<?php _e('Share on Whatsapp', 'ath'); ?>" name="Whatsapp" title="Whatsapp - <?php _e('Link opens in a new window', 'ath'); ?>" href="<?php echo $href_whatsapp; ?>" class="button whatsapp">
                <i class="icon-whatsapp"></i>
            </a>
        </li>

        <li>
            <a aria-label="<?php _e('Share on Facebook', 'ath'); ?>" name="Facebook" title="Facebook - <?php _e('Link opens in a new window', 'ath'); ?>" href="<?php echo $href_facebook; ?>" onclick="window.open(this.href, 'facebookwindow','left=20,top=20,width=670,height=320,toolbar=0,resizable=1'); return false;" class="button facebook">
                <i class="icon-facebook"></i>
            </a>
        </li>

        <li>
            <a aria-label="<?php _e('Share on Twitter', 'ath'); ?>" name="Twitter" title="Twitter - <?php _e('Link opens in a new window', 'ath'); ?>" href="<?php echo $href_twitter; ?>" onclick="window.open(this.href, 'twitterwindow','left=20,top=20,width=626,height=252,toolbar=0,resizable=1'); return false;" class="button twitter">
                <i class="icon-twitter"></i>
            </a>
        </li>

        <li>
            <a href="https://telegram.me/share/url=<?= urlencode(get_permalink(get_the_ID())); ?>&text=teste" onclick="window.open(this.href, 'telegramwindow','left=20,top=20,width=626,height=252,toolbar=0,resizable=1'); return false;" class="telegram">
                <i class="icon-telegram"></i>
            </a>
        </li>

        <li>
            <a aria-label="<?php _e('Share on e-mail', 'ath'); ?>" name="Email" title="Email - <?php _e('Link opens in a new window', 'ath'); ?>" href="<?php echo $href_email; ?>" class="button mail">
                <i class="icon-mail"></i>
            </a>
        </li>

        <li>
            <a aria-label="<?php _e('Printo to page', 'ath'); ?>" name="Print" class="button mail" onclick="window.print()" class="print">
                <i class="icon-print"></i>
            </a>
        </li>
    </ul>    
</div>