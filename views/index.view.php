<?php $title="Home";?>
<?php require 'partial/header.php';?>
        <ul>
            <?php foreach ($tasks as $task): ?>
                <li>
                    <?php if($task->complated): ?>
                        <strike><?=$task->description?></strike>
                    <?php else: ?>
                        <?=$task->description?>
                    <?php endif ?>
                </li>
            <?php endforeach; ?>
        </ul>
<?php require 'partial/footer.php';?>

