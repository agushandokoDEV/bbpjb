<link rel="stylesheet" href="<?php echo site_url('assets/vendor/gallery/css/prettyPhoto.css') ?>" />
<script src="<?php echo site_url('assets/vendor/gallery/js/vendor/modernizr-2.6.2-respond-1.1.0.min.js') ?>"></script>
<script src="<?php echo site_url('assets/vendor/gallery/js/plugins.js') ?>"></script>
<script src="<?php echo site_url('assets/vendor/gallery/js/jquery.prettyPhoto.js') ?>"></script>

<script>
    var _gaq=[['_setAccount','UA-XXXXX-X'],['_trackPageview']];
    (function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];
    g.src=('https:'==location.protocol?'//ssl':'//www')+'.google-analytics.com/ga.js';
    s.parentNode.insertBefore(g,s)}(document,'script'));

    // Colorbox Call

    $(document).ready(function(){
        $("[rel^='lightbox']").prettyPhoto({
            social_tools: false
        });
    });
</script>