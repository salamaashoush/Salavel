<div class="ui large top inverted fixed main menu">
    <div class="ui container">
        <a class="item" href="/">
            Home
        </a>
        <a class="item" href="/posts">
            Posts
        </a>
        <?php if (\App\Core\Session::isLogin()): ?>
            <a class="item " href="/users/<?= \App\Core\Session::getLoginUser()->id ?>">
                Profile
            </a>
            <a class="item " href="/users/<?= \App\Core\Session::getLoginUser()->id ?>\edit">
                Edit Info
            </a>
        <?php endif; ?>
        <?php if (\App\Core\Session::getLoginUser()->role == "admin"): ?>
            <a class="item " href="admin">
                Admin
            </a>
        <?php endif; ?>
        <div class="right menu">
            <div class="ui category search item">
                <div class="ui transparent icon input">
                    <form action="/search" method="get">
                        <input id="search" name="search" class="prompt" type="text" placeholder="Search posts...">
                        <button type="submit"><i class="search link icon"></i></button>
                    </form>

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
