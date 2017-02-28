<?php
$errors = getErrors();
?>
<?php partial('header', ['title' => $post->title]); ?>
<?php if(\App\Core\Session::isLogin()):?>
    <div class="ui container">
        <h1>New Post</h1>
        <div class="column">
            <form class="ui form" action="/posts/<?=$post->id?>" method="post" enctype="multipart/form-data">
                <?= method_field("PUT");?>
                <?= csrf_field();?>
                <div class="ui stacked segment">
                    <div class="field">
                        <div class="ui input">
                            <input type="text" name="title" placeholder="Title" value="<?= $post->title ?>">
                        </div>
                    </div>
                    <div class="field">
                        <label>Image</label>
                        <input type="file" name="image">
                    </div>
                    <div class="field">
                        <textarea name="body" id="" cols="30" rows="10" ><?= $post->body ?></textarea>
                    </div>

                    <input class="ui fluid large teal submit button"  type="submit" value="Update" />
                </div>

                <div class="ui error message"></div>

            </form>
        </div>
        <?php partial('errors', ['errors' => $errors]) ?>
    </div>
<?php else:?>
    <div class="ui middle aligned center aligned grid" style="margin-top: 200px;margin-left:200">
        <div class="column">
            <div class="ui vertical beg segment transition visible" >
                <div class="ui red header">
                    <i class="disabled warning sign icon"></i>
                    <div class="content">
                        <h1>You cant edit Posts now!!</h1>
                        <div class="sub header">
                            <p>Please login first</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endif;?>
<?php partial('footer'); ?>
