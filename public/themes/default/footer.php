    <?php if ( ! isset($show) || $show == true) : ?>
    <hr />
    <footer class="footer">
        <div class="row">
            <p class="text-center">In case of any queries, please write to : <a href="mailto:register@youthdelhpicgames.com">register@youthdelphicgames.com</a>
            or call on <span class="glyphicon glyphicon-earphone"></span>&nbsp;<small>+91-9866 722 247</small></p>
        </div>
        <!--<div class="container">
            <p>Powered by <a href="http://cibonfire.com" target="_blank">Bonfire <?php echo BONFIRE_VERSION; ?></a></p>
        </div>-->
    </footer>
    <?php endif; ?>
	<div id="debug"><!-- Stores the Profiler Results --></div>
    <!-- Grab Google CDN's jQuery, with a protocol relative URL; fall back to local if offline -->
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="<?php echo js_path(); ?>jquery.min.js"><\/script>');</script>
    <?php echo Assets::js(); ?>
</body>
</html>