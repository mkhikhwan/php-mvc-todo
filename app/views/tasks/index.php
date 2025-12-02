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
                    <p class="task-name"><?= $task['name'] ?> <span class="task-priority task-priority-<?= $task['priority'] ?>"><?= $task['priority'] ?></span></p>
                    <div class="task-buttons">
                        <a href="" class="btn btn-success">Done</a> |
                        <a href="" class="btn btn-primary">Edit</a> | 
                        <a href="" class="btn btn-danger">Delete</a>
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
