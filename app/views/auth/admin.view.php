<?php partial('header', ['title' => "Admin"]); ?>
<?php if(\App\Core\Session::isLogin()&&\App\Core\Session::getLoginUser()->role=="admin"):?>
<div class="ui container" style="padding: 200px">
    <h1 class="header">Welcome <?= \App\Core\Session::getLoginUser()->username?></h1>
    <div class="ui horizontal divider">What do you want do?</div>
    <div class="blue ui buttons">
        <a class="ui button" href="/users">List Users</a>
        <a class="ui button" href="/users/create">Create User</a>
        <a class="ui button" href="/posts">List Posts</a>
    </div>
</div>
<?php else:?>
<div class="ui middle aligned center aligned grid" style="padding: 200px">
    <div class="column">
        <div class="ui vertical beg segment transition visible" >
            <div class="ui red header">
                <i class="disabled warning sign icon"></i>
                <div class="content">
                    <h1>No No No go away!!!</h1>
                    <div class="sub header">
                        <p>You don't have permissions</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php endif;?>
<?php partial('footer'); ?>
