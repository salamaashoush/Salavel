<?php
$errors = getErrors();

?>
<?php partial('header', ['title' => "about"]); ?>
<div class="ui container">
    <h1>New Post</h1>
    <div class="column">
        <form class="ui large form" method="post" action="/posts/">
            <?= csrf_field() ?>
            <div class="ui stacked segment">
                <div class="field">
                    <div class="ui input">
                        <input type="text" name="title" placeholder="Title">
                    </div>
                </div>
                <div class="field">
                    <textarea name="body" id="" cols="30" rows="10"></textarea>
                </div>

                <input class="ui fluid large teal submit button"  type="submit" value="Create" />
            </div>

            <div class="ui error message"></div>

        </form>
    </div>
    <?php partial('errors', ['errors' => $errors]) ?>
</div>

<?php partial('footer'); ?>
