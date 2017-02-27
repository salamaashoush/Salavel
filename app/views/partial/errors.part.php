<?php if ($errors): ?>
    <?php foreach ($errors as $field => $error): ?>
        <p>
            <strong><?= $field ?></strong>
            <?php foreach ($error as $err): ?>
                <i><?= $err ?></i>
            <?php endforeach; ?>
        </p>
    <?php endforeach; ?>
<?php endif; ?>