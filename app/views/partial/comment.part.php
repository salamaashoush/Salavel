
    <div class="comment">
        <a class="avatar" href="/users/<?= $comment->user()->id?>">
            <?php uploaded_image($comment->user()->image)?>
        </a>
        <div class="content">
            <a class="author" href="/users/<?= $comment->user()->id?>"><?= $comment->user()->username?> </a>
            <div class="metadata">
                <span class="date"><?= $comment->updated_at?></span>
            </div>
            <div class="text">
                <?= $comment->content?>
            </div>
            <?php if(\App\Core\Session::isLogin()&&\App\Core\Session::getLoginUser()->id==$comment->uid):?>
            <div class="actions">
                <?php start_form("delete","/comments/{$comment->id}")?>
                    <button class="ui small red button" type="submit"><i class="remove icon"></i> Delete</button>
                <?php close_form()?>
            </div>
            <?php endif;?>
        </div>
    </div>
