<?php
include 'app/views/header.php'
?>
<div class="container">
    <table class="table-bordered table text-center">
        <thead>
        <tr>
            <th colspan="5">Tasks</th>
        </tr>
        <tr>
            <th>Status</th>
            <th>Task name</th>
            <th>User</th>
            <th>Email</th>
            <th>Description</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($tasks as $task): ?>
            <tr>
                <?php if ($user->isAdmin()): ?>
                <td>
                    <select class="status-select" data-id="<?= $task['ID'] ?>">
                        <option class="status" <?php if($task['status'] === 'not in work') echo 'selected'?> value="not in work">not in work</option>
                        <option class="status" <?php if($task['status'] === 'in work') echo 'selected'?> value="in work">in work</option>
                        <option class="status" <?php if($task['status'] === 'done') echo 'selected'?> value="done">done</option>
                    </select>
                </td>
                <td><?= $task['name'] ?></td>
                <td><?= $task['user_name'] ?></td>
                <td><?= $task['user_email'] ?></td>
                <td>
                    <div class="description-block">
                    <?php if (isset($task['label'])) echo '<div class="label" data-title="'. $task['label'] .'"></div>'?>
                        <div class="description" data-id="<?= $task['ID'] ?>">
                            <textarea><?= $task['description'] ?></textarea>
                            <a class="btn save-btn">Save</a>
                        </div>
                    </div>
                </td>
                <?php else:?>
                <td><span class="status"><?= $task['status'] ?></span></td>
                <td><?= $task['name'] ?></td>
                <td><?= $task['user_name'] ?></td>
                <td><?= $task['user_email'] ?></td>
                <td>
                    <div class="description-block">
                    <?php if (isset($task['label'])) echo '<div class="label" data-title="'. $task['label'] .'"></div>'?>
                        <?= $task['description'] ?>
                    </div>
                    <?php endif; ?>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    <div class="pagination">
        <?php for ($i = 1; $i <= $count_pages; $i++): ?>
            <input type="button" class="btn btn-outline-primary <?php if ($i === $page) echo 'active' ?>"
                   style="display: inline-block" value="<?= $i ?>">
        <?php endfor; ?>
    </div>
    <div class="add-task">
        <form id="add" name="add-task">
            <label for="user_name">User name</label>
            <input class="form-control" id="user_name" name="user_name" placeholder="Enter user name">
            <label for="user_email">Email</label>
            <input class="form-control" id="user_email" name="user_email" placeholder="Enter user email">
            <label for="name">Task name</label>
            <input class="form-control" id="name" name="name" placeholder="Enter task name">
            <label for="description">Description</label>
            <input class="form-control" id="description" name="description" placeholder="Enter description">
            <input class="btn btn-outline-primary submit" type="submit" value="Add">
        </form>
    </div>
</div>
<?php
include 'app/views/footer.php'
?>