<?php ob_start(); ?>

vous êtes perdus sur internet 
<?php $content = ob_get_clean(); ?>

<?php view('template', compact('content')); ?>