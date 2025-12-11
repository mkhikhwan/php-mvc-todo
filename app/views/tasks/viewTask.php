<div class="main-content">
    <h1>View Task</h1>

    <div class="add-task-form">
        <!-- name -->
        <div class="form-group">
            <label for="task-name" class="form-label">Task Name:</label>
            <p><?= htmlspecialchars($task['name']) ?></p>
        </div>

        <!-- description -->
        <div class="form-group">
            <label for="task-description" class="form-label">Task Description:</label>
            <p><?= htmlspecialchars($task['description']) ?></p>
        </div>

        <!-- due_date -->
        <div class="form-group">
            <label for="task-due" class="form-label">Task Due Date:</label>
            <p><?= htmlspecialchars($task['due_date']) ?></p>
        </div>

        <!-- priority -->
        <div class="form-group">
            <label for="task-priority" class="form-label">Task Priority:</label>
            <p class="task-priority task-priority-<?= $task['priority'] ?>"><?= $task['priority'] ?></p>
        </div>

        <!-- created_date -->
        <div class="form-group">
            <label for="task-priority" class="form-label">Created Date:</label>
            <p><?= htmlspecialchars($task['created_date']) ?></p>
        </div>
        
        <a class="btn btn-secondary" href="/tasks">Back</a>
        <a class="btn btn-warning" href="/tasks/edit/<?= $task['id'] ?>">Edit</a>
    </div>
</div>