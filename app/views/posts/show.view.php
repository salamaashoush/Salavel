<?php partial('header', ['title' => $post->title]); ?>
<div class="ui container">
    <h1 class="ui header"><?= $post->title ?></h1>
    <p>Author: <?= $post->user()->username ?></p>
    <div class="ui segment">
<!--        --><?php //uploaded_image($post->image, ['class' => 'ui fluid image', 'id' => '']) ?>
        <p><?= $post->body ?></p>
        <form class="ui reply form" method="post" action="/comments/">
            <div class="field">
                <textarea></textarea>
            </div>
            <div class="ui blue labeled submit icon button">
                <i class="icon edit"></i> Add Reply
            </div>
        </form>
    </div>
    <div class="ui comments">
        <h3 class="ui dividing header">Comments</h3>
        <?php foreach ($post->comments() as $comment): ?>
            <?php partial('comment', ['comment' => $comment]); ?>
        <?php endforeach; ?>
    </div>
</div>

<?php partial('footer'); ?>

