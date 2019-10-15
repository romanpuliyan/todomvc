<?php if(count($list)): ?>
    <ul class="d-flex flex-column-reverse todo-list">
        <?php foreach($list as $row): ?>
            <?php
                $statusClass = "";
                $checked = "";
                if($row['status'] == application\models\Task::STATUS_COMPLETED) {
                    $statusClass = "completed";
                    $checked = "checked='checked'";
                }
            ?>

            <li class="<?= $statusClass ?>">
                <div class="form-check">
                    <label class="form-check-label">
                        <input class="checkbox" type="checkbox" <?= $checked ?> id="checkbox_<?= $row['id'] ?>">
                        <?= $row['title']; ?>
                        <i class="input-helper"></i>
                    </label>
                    <span><?= $row['description'] ?></span>
                </div>
                <i class="remove mdi mdi-close-circle-outline delete-button" id="delete_<?= $row['id'] ?>"></i>
            </li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>
