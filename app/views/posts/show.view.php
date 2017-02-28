<?php partial('header', ['title' => $post->title]); ?>
<div class="ui container">
    <h1 class="ui header"><?= $post->title ?></h1>
    <p>Author: <?= $post->user()->username ?></p>
    <div class="ui segment">
        <?php uploaded_image($post->image, ['class' => 'ui fluid image', 'id' => '']) ?>
        <p><?= $post->body ?></p>
    </div>
    <div class="ui horizontal divider">
        Comments
    </div>
    <div class="ui comments">
        <?php foreach ($post->comments() as $comment): ?>
            <?php partial('comment', ['comment' => $comment]); ?>
        <?php endforeach; ?>
    </div>
    <div class="ui horizontal divider">
        Leave a Comment
    </div>
    <form class="ui reply form" method="post" action="/comments/">
        <div class="field">
            <textarea></textarea>
        </div>
        <button class="ui blue labeled submit icon button" type="submit">
            <i class="icon edit"></i> Add Comment
        </button>
    </form>
</div>

<?php partial('footer'); ?>

