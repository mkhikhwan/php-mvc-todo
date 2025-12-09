<h1>Tasks</h1>

<div class="header-area">
    <h2>Welcome, <?php echo htmlspecialchars($_SESSION['username'] ?? '');  ?>!</h2>
    <p>Start working on tasks below!</p>
</div>

<?php if(!empty($message['success'])): ?>
<div class="flash flash-success">
    <p><?php echo htmlspecialchars($message['success']) ?></p>
    <div class="flash-closeButton">&times;</div>
</div>
<?php endif ?>

<div style="margin: 8px 0px">
    <a href="/tasks/add" class="btn btn-primary">Add Task</a>
    <a href="" class="btn btn-secondary">Filter Tasks</a>
</div>

<ul class="task-list">
    <?php if(!empty($tasks)): ?>
        <?php foreach($tasks as $index => $task): ?>
            <li class="task-item">
                <div class="task-name-wrapper">
                    <div class="task-name <?= $task['is_done'] ? 'task-done' : '' ?>">
                        <p><?= htmlspecialchars($task['name']) ?></p> 
                        <span class="task-priority task-priority-<?= $task['priority'] ?>"><?= $task['priority'] ?></span>
                    </div>
                    <div class="task-buttons" data-id="<?= $task['id'] ?>">
                        <button class="btn btn-success <?= $task['is_done'] ? 'btn-unDone' : 'btn-done' ?>">
                            <?= $task['is_done'] ? 'Un-done' : 'Done' ?>
                        </button> |
                        <button class="btn btn-primary btn-edit">Edit</button> | 
                        <button class="btn btn-danger btn-delete">Delete</button>
                    </div>
                </div>
                <p class="task-desc"><?= $task['description'] ?></p>
                <p class="task-due">Due: <?= $task['due_date'] ?></p>
            </li>
        <?php endforeach ?>
    <?php else: ?>
        <p>You have no tasks as of now!</p>
    <?php endif ?>
</ul>
