
    <div class="card">
       <div class="blurring dimmable image">
            <div class="ui inverted dimmer">
                <div class="content">
                    <div class="center">
                        <a class="ui primary button" href="users/<?=$user->id?>">Show Profile</a>
                    </div>
                </div>
            </div>
            <?php uploaded_image($user->image)?>
        </div>
        <div class="content">
            <a class="header" href="users/<?=$user->id?>"><?= $user->firstname." ".$user->lastname?></a>
            <div class="meta">
                <span class="date">Registered at: <?= $user->created_at?></span>
            </div>
        </div>
        <div class="extra content">
            <a>
                <i class="edit icon"></i>
                <?= "Posts: ".count($user->posts())?>
            </a>
            <div class="ui two buttons">
                <a class="ui basic green button" href="users/<?=$user->id?>/edit">Edit</a>
                <?php start_form("delete","users/$user->id")?>
                <button class="ui basic red button" type="submit">Delete</button>
                <?php close_form()?>
            </div>
        </div>
    </div>
