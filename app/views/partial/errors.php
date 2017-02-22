<?php
session_start();
if(isset($_SESSION['ERROR_MESSAGE']))
{
    $errors=$_SESSION['ERROR_MESSAGE'];
    unset($_SESSION['ERROR_MESSAGE']);
}
?>
<div class="error">
    <ul>
        <?php if($errors):?>
            <?php foreach ($errors as $field=>$error):?>
                <li>
                    <ul>
                        <p><?= $field?></p>
                        <?php foreach ($error as $err):?>
                            <li><?=$err?></li>
                        <?php endforeach;?>
                    </ul>
                </li>
            <?php endforeach;?>
        <?php endif;?>
    </ul>
</div>