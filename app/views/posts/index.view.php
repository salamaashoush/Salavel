<?php
$errors=getErrors();
?>
<?php partial('header', ['title' => "Posts"]); ?>
<div class="ui container">
    <h1>Posts</h1>
    <?php if($posts):?>
    <div class="ui items">
        <?php foreach ($posts as $post): ?>
            <?php partial('post',['post'=>$post]);?>
        <?php endforeach; ?>
    </div>
    <?php endif;?>
    <?php partial('errors',['errors'=>$errors])?>
</div>

<?php partial('footer'); ?>
