<h1>Tasks</h1>

<h2>Welcome, <?php echo htmlspecialchars($_SESSION['username'] ?? '');  ?>!</h2>
<p>Start working on tasks below!</p>

<div class="task-list">
    <?php if(!empty($tasks)): ?>
        <?php foreach($tasks as $index => $task): ?>
            <p><?= $index + 1 ?> - <span><?= $task['name'] ?></span> <a href="">Edit</a> | <a href="">Delete</a></p>
        <?php endforeach ?>
    <?php else: ?>
        <p>You have no tasks as of now!</p>
    <?php endif ?>
</div>
