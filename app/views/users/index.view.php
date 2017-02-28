<?php partial('header', ['title' => 'Users']); ?>
<?php if (\App\Core\Session::getLoginUser()->role == 'admin'): ?>
    <?php if (!is_null($users)): ?>
        <div style="padding-top:100px">
            <div class="ui special cards">
                <?php foreach ($users as $user): ?>
                    <?php partial('user', ['user' => $user]); ?>
                <?php endforeach; ?>
            </div>
        </div>
    <?php endif; ?>
<?php else: ?>
    <div class="ui middle aligned center aligned grid" style=padding: 300px">
    <div class="column">
        <div class="ui vertical beg segment transition visible">
            <div class="ui red header">
                <i class="disabled warning sign icon"></i>
                <div class="content">
                    <h1>You are not allowed here</h1>
                    <div class="sub header">
                        <p>You are not allowed here</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
<?php endif; ?>
<?php partial('footer'); ?>

