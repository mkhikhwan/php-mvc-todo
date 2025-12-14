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
            <?php
                $completion = $_GET['completion'] ?? '';

                $dueAfter = $_GET['due_after'] ?? '';
                $dueBefore = $_GET['due_before'] ?? '';

                $priority = $_GET['priority'] ?? [];
                if (!is_array($priority)) {
                    $priority = [];
                }

                $name = $_GET['name'] ?? '';

                $sortBy = $_GET['sort_by'] ?? 'created_date';
                $sortOrder = $_GET['sort_order'] ?? 'ASC';
            ?>

            <!-- Completion -->
            <div class="form-group">
                <label class="form-label">Task Completion:</label>
                <select name="completion">
                    <option value="" <?= $completion === '' ? 'selected' : '' ?>>All</option>
                    <option value="1" <?= $completion === '1' ? 'selected' : '' ?>>Completed</option>
                    <option value="0" <?= $completion === '0' ? 'selected' : '' ?>>Incomplete</option>
                </select>
            </div>

            <!-- Due Date Range -->
            <div class="form-group">
                <label class="form-label">Due Date Range:</label>

                <input
                    type="datetime-local"
                    name="due_after"
                    value="<?= htmlspecialchars($dueAfter) ?>"
                >

                <p style="font-weight:600; display:flex; align-items:center; font-size:20px; margin:0 1rem;">~</p>

                <input
                    type="datetime-local"
                    name="due_before"
                    value="<?= htmlspecialchars($dueBefore) ?>"
                >
            </div>

            <!-- Priority -->
            <div class="form-group">
                <label class="form-label">Priority:</label>

                <div style="display:block;">
                    <label style="display:flex; gap:20px; margin-bottom:16px;">
                        <input
                            type="checkbox"
                            name="priority[]"
                            value="low"
                            <?= in_array('low', $priority, true) ? 'checked' : '' ?>
                        >
                        <span class="task-priority task-priority-low">low</span>
                    </label>

                    <label style="display:flex; gap:20px; margin-bottom:16px;">
                        <input
                            type="checkbox"
                            name="priority[]"
                            value="medium"
                            <?= in_array('medium', $priority, true) ? 'checked' : '' ?>
                        >
                        <span class="task-priority task-priority-medium">medium</span>
                    </label>

                    <label style="display:flex; gap:20px;">
                        <input
                            type="checkbox"
                            name="priority[]"
                            value="high"
                            <?= in_array('high', $priority, true) ? 'checked' : '' ?>
                        >
                        <span class="task-priority task-priority-high">high</span>
                    </label>
                </div>
            </div>

            <!-- Task Name -->
            <div class="form-group">
                <label class="form-label">Task Name:</label>
                <input
                    type="text"
                    name="name"
                    placeholder="Grab some milk..."
                    value="<?= htmlspecialchars($name) ?>"
                >
            </div>

            <!-- Sort By -->
            <div class="form-group">
                <label class="form-label">Sort By:</label>

                <div style="display: flex; gap: 16px;">
                    <select name="sort_by" style="width: 160px;">
                        <option value="name" <?= $sortBy === 'name' ? 'selected' : '' ?>>Name</option>
                        <option value="created_date" <?= $sortBy === 'created_date' ? 'selected' : '' ?>>Created Date</option>
                        <option value="due_date" <?= $sortBy === 'due_date' ? 'selected' : '' ?>>Due Date</option>
                    </select>

                    <select name="sort_order" style="width: 160px;">
                        <option value="ASC" <?= $sortOrder === 'ASC' ? 'selected' : '' ?>>Ascending</option>
                        <option value="DESC" <?= $sortOrder === 'DESC' ? 'selected' : '' ?>>Descending</option>
                    </select>
                </div>
            </div>

            <!-- Actions -->
            <div style="display:flex; justify-content:left;">
                <button class="btn btn-primary" style="width:50%; margin-right:24px;">
                    Filter
                </button>

                <a href="/tasks" class="btn btn-ghost" style="width:50%">
                    Clear Filters
                </a>
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