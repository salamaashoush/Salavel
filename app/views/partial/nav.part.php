<div class="ui large top inverted fixed main menu">
    <div class="ui container">
        <a class="item active" href="/">
            Home
        </a>
        <a class="item" href="/posts">
            Posts
        </a>
        <a class="item " href="/users/<?php \App\Core\Session::getLoginUser()->id ?>">
            Profile
        </a>
        <div class="right menu">
            <div class="ui category search item">
                <div class="ui transparent icon input">
                    <input id="search" class="prompt" type="text" placeholder="Search posts...">
                    <i class="search link icon"></i>
                </div>
                <div class="results"></div>
            </div>

            <?php if (\App\Core\Session::isLogin()): ?>
                <a class="ui item" href="/logout"> Logout</a>
            <?php else: ?>
                <a class="ui item" href="/login"> Login</a>
            <?php endif; ?>
        </div>
    </div>
</div>
