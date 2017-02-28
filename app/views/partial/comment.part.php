
    <div class="comment">
        <a class="avatar" href="/users/<?= $comment->user()->id?>">
            <?php uploaded_image($comment->user()->image)?>
        </a>
        <div class="content">
            <a class="author" href="/users/<?= $comment->user()->id?>"><?= $comment->user()->name?> </a>
            <div class="metadata">
                <span class="date"><?= $comment->updated_at?></span>
            </div>
            <div class="text">
                <?= $comment->content?>
            </div>
<!--            <div class="actions">-->
<!--                <a class="reply">Reply</a>-->
<!--            </div>-->
        </div>
    </div>
