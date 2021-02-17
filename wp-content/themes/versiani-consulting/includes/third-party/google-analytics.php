<?php
/**
 * Google Analytics
 * 
 * gtag.js script for Google Analytics
 * 
 * Inputs: $ua_code
 * 
 * Reference: https://developers.google.com/analytics/devguides/collection/gtagjs
 */

if(!isset($ua_code)) { return; }
?>

<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=<?= $ua_code; ?>"></script>
<script>
	window.dataLayer = window.dataLayer || [];
	function gtag(){dataLayer.push(arguments); }
	gtag('js', new Date());
	gtag('config', '<?= $ua_code; ?>');
</script>