<div class="item">
    <div class="image">
        <?=html_image($post->image)?>
    </div>
    <div class="content">
        <a class="header"><?=$post->title?></a>
        <div class="meta">
            <span>Author: <?php html_link("users/".$post->user()->id,$post->user()->username)?></span>
            <span>Last edit: <?=$post->updated_at?></span>
        </div>
        <div class="description">
            <p><?=$post->body?></p>
        </div>
        <div class="extra">
            <div class="ui small buttons">
                <?php start_form('get',"/posts/".$post->id."/edit")?>
                <input type="submit" class="ui primary button" value="Edit">
                <?php close_form()?>
                <?php start_form('delete',"/posts/".$post->id)?>
                <input type="submit" class="ui red button" value="Delete">
                <?php close_form()?>
            </div>
        </div>
    </div>
</div>
