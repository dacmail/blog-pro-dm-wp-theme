	<footer class="footer">
        <div class="container">
            &copy; Ayuntamiento de Madrid
            <?php wp_nav_menu(array(
                        'container' => 'span',
                        'items_wrap' => '%3$s',
                        'container_class' => '',
                        'theme_location' => 'footer',
                        'walker' => new ungrynerd_walker_nav_menu));
            ?>
            <div class="pull-right">
                 <a href="https://www.facebook.com/pages/Ayuntamiento-de-Madrid" target="_blank">facebook</a>,
                <a href="http://instagram.com/madrid" target="_blank">instagram</a>,
                <a href="http://twitter.com/Madrid" target="_blank">twitter</a>,
                <a href="https://www.youtube.com/channel/UCYY0va5t-KZncOOctoGva7A" target="_blank">youtube</a>
            </div>
        </div>
	</footer>
	<?php wp_footer(); ?>
    <!-- Piwik -->
    <script type="text/javascript">
        var _paq = _paq || [];
    // tracker methods like "setCustomDimension" should be called before "trackPageView"
    _paq.push(['trackPageView']);
    _paq.push(['enableLinkTracking']);
    (function() {
        var u="//webanalytics01.madrid.es/";
        _paq.push(['setTrackerUrl', u+'piwik.php']);
        _paq.push(['setSiteId', '8']);
        var d=document, g=d.createElement('script'), s=d.getElementsByTagName('script')[0];
        g.type='text/javascript'; g.async=true; g.defer=true; g.src=u+'piwik.js'; s.parentNode.insertBefore(g,s);
    })();
    </script>
    <!-- End Piwik Code -->
</body>
</html>
