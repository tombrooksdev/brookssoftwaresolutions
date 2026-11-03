<?php
/** Closes the document. In WordPress, the script is enqueued via wp_enqueue_script instead. */
get_template_part('template-parts/site-footer');
?>
<script src="<?= esc_url(bb_asset('build/app.js')) ?>" defer></script>
</body>
</html>
