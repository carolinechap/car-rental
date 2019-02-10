<?php ob_start(); ?>

<?//TODO: ajouter un récapitulatif de location?>


<?php $content = ob_get_clean(); ?>
<?php view('template', compact('content')); ?>