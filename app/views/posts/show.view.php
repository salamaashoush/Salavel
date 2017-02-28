<?php partial('header', ['title' => $post->title]); ?>
<div class="ui container" style="padding-top:100px">
    <h1 class="ui header"><?= $post->title ?></h1>
    <p>Author: <?= html_link("/users/{$post->user()->id}","{$post->user()->username}");?></p>
    <div class="ui segment">
        <?php uploaded_image($post->image, ['class' => 'ui fluid image', 'id' => '']) ?>
        <h3><?= $post->body ?></h3>
    </div>
    <div class="ui horizontal divider">
        Comments
    </div>
    <div class="ui comments">
        <?php foreach ($post->comments() as $comment): ?>
            <?php partial('comment', ['comment' => $comment]); ?>
        <?php endforeach; ?>
    </div>
    <?php if (\App\Core\Session::isLogin()):?>
    <div class="ui horizontal divider">
        Leave a Comment
    </div>
    <form class="ui reply form" method="post" action="/comments/">
        <div class="field">
            <input type="hidden" name="pid" id="" value="<?=$post->id?>">
            <textarea name="content"></textarea>
        </div>
        <button class="ui blue labeled submit icon button" type="submit">
            <i class="icon edit"></i> Add Comment
        </button>
    </form>
    <?php else:?>
    <div class="ui horizontal divider">
        Login to leave a comment
    </div>
    <?php endif;?>
</div>

<?php partial('footer'); ?>

