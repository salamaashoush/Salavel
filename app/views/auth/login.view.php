<?php
$oldreq = \App\Core\Session::get('request');
\App\Core\Session::delete('request');
?>
<?php partial('header', ['title' => "Register"]); ?>

<div class="ui middle aligned center aligned grid">
    <div class="four wide column">
        <h2 class="ui teal image header">
            <img src="assets/images/logo.png" class="image">
            <div class="content">
                Log-in to your account
            </div>
        </h2>
        <form class="ui large form" method="post" action="/login">
            <?= csrf_field() ?>
            <div class="ui stacked segment">
                <div class="field">
                    <div class="ui left icon input">
                        <i class="user icon"></i>
                        <?php if ($oldreq): ?>
                            <input type="text" name="email" placeholder="E-mail address"
                                   value="<?= $oldreq['fields']['email'] ?>">
                        <?php else: ?>
                            <input type="text" name="email" placeholder="E-mail address">
                        <?php endif; ?>
                    </div>
                </div>
                <div class="field">
                    <div class="ui left icon input">
                        <i class="lock icon"></i>
                        <input type="password" name="password" placeholder="Password">
                    </div>
                </div>
                <div class="inline field">
                    <div class="ui toggle checkbox">
                        <input type="checkbox" tabindex="0" class="hidden" name="remember">
                        <label>Remember Me</label>
                    </div>
                </div>
                <input type="submit" value="Login" class="ui fluid large teal submit button">
            </div>

        </form>

        <div class="ui message">
            New to us? <a href="/register">Sign Up</a>
        </div>
        <?php if (!is_null($oldreq['errors'])): ?>
            <div class="ui error message">
                <div class="header">Validation Errors</div>
                <?php partial('errors', ['errors' => $oldreq['errors']]) ?>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php partial('footer'); ?>

