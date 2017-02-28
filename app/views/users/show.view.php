
<?php partial('header', ['title' => $user->username]); ?>
<div class="pusher">
    <div class="ui inverted vertical masthead center aligned segment" style="padding: 200px">
        <div class="ui text container">
            <h1 class="ui inverted header">
                <div class="ui small circular rotate reveal image">
                    <?php uploaded_image($user->image,['class'=>"visible content",'id'=>''])?>
                    <?php uploaded_image($user->image,['class'=>"hidden content",'id'=>''])?>
                </div>
                <h1>Welcome <?= $user->firstname." ".$user->lastname?></h1>
            </h1>
            <a class="ui huge primary button" href="/posts/create" >Write a Post <i class="write icon"></i></a>
        </div>
    </div>
</div>

<div class="ui container">
    <div class="ui horizontal divider">
        Your Posts
    </div>
    <?php if($user->posts()):?>
        <div class="ui items">
            <?php foreach ($user->posts() as $post): ?>
                <?php partial('post',['post'=>$post]);?>
            <?php endforeach; ?>
        </div>
    <?php endif;?>
</div>

<?php partial('footer'); ?>

