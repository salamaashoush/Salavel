<div class="item">
    <div class="image">
        <?=uploaded_image($post->image)?>
    </div>
    <div class="content">
        <?php html_link("/posts/".$post->id,$post->title,['class'=>'header'])?>
        <div class="meta">
            <span>Author: <?php html_link("users/".$post->user()->id,$post->user()->username)?></span>
            <span>Last edit: <?=$post->updated_at?></span>
        </div>
        <div class="description">
            <p><?=$post->body?></p>
        </div>
        <?php if((\App\Core\Session::isLogin()&&\App\Core\Session::getLoginUser()->id==$post->uid)||\App\Core\Session::getLoginUser()->role=='admin'):?>
        <div class="extra">
            <div class="ui buttons">
                <?php start_form('get',"/posts/".$post->id."/edit")?>
                <button type="submit" class="ui primary button" >Edit</button>
                <?php close_form()?>
                <?php start_form('delete',"/posts/".$post->id)?>
                <button type="submit" class="ui red button">Delete</button>
                <?php close_form()?>
            </div>
        </div>
        <?php endif;?>
    </div>
</div>
