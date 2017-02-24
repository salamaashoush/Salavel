<?php
try {
    $response = Session::r('response');
} catch (Exception $e) {
    $e->getMessage();
}
?>
<?php partial('header', [$title => "about"]); ?>
<h1>Home</h1>
<?php partial('footer'); ?>

