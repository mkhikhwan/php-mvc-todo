<div class="main-content">
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
        <button class="btn btn-secondary btn-filter">Filter Tasks</button>
    </div>

    <div class="filter-menu">
        <form action="" method="GET">

            <!-- Completion -->
            <div class="form-group">
                <label class="form-label">Task Completion:</label>
                <select name="completion">
                    <option value="" <?= $_GET['completion'] ? 'selected' : '' ?> >All</option>
                    <option value="1" <?= $_GET['completion'] ? 'selected' : '' ?> >Completed</option>
                    <option value="0" <?= $_GET['completion'] ? 'selected' : '' ?> >Incomplete</option>
                </select>
            </div>

            <!-- Due Date Range -->
            <div class="form-group">
                <label class="form-label">Due Date Range:</label>
                <input type="datetime-local" name="due_after" 
                    value="<?= isset($_GET['due_after']) ? htmlspecialchars($_GET['due_after']) : '' ?>"
                >
                <p style="font-weight: 600; display:flex; align-items:center; font-size:20px; margin: 0px 1rem;"> ~ </p>
                <input type="datetime-local" name="due_before" 
                    value="<?= isset($_GET['due_before']) ? htmlspecialchars($_GET['due_before']) : '' ?>"
                >
            </div>

            <!-- Priority -->
            <div class="form-group">
                <?php 
                    $priority = $_GET['priority'] ?? [];
                ?>
                <label class="form-label">Priority:</label>
                <div style="display:block;">
                    <label style="display:flex; gap:20px; margin-bottom:16px;">
                        <input type="checkbox" class="chk" name="priority[]" value="low" 
                            <?= in_array('low', $priority) ? 'checked' : '' ?>
                        >
                        <span class="task-priority task-priority-low">low</span>
                    </label>

                    <label style="display:flex; gap:20px; margin-bottom:16px;">
                        <input type="checkbox" class="chk" name="priority[]" value="medium"
                            <?= in_array('medium', $priority) ? 'checked' : '' ?>
                        >
                        <span class="task-priority task-priority-medium">medium</span>
                    </label>

                    <label style="display:flex; gap:20px;">
                        <input type="checkbox" class="chk" name="priority[]" value="high"
                            <?= in_array('high', $priority) ? 'checked' : '' ?>
                        >
                        <span class="task-priority task-priority-high">high</span>
                    </label>
                </div>
            </div>

            <!-- Name -->
            <div class="form-group">
                <label class="form-label">Task Name:</label>
                <input type="text" name="name" placeholder="Grab some milk...">
            </div>

            <div style="display:flex; justify-content:left;">
                <button class="btn btn-ghost" style="width:240px;">Filter</button>
            </div>
        </form>
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
</div>