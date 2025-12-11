<div class="main-content">
    <h1>Edit Task</h1>

    <form action="" method="POST" class="add-task-form" id="add-task-form">
        <!-- name -->
        <div class="form-group">
            <label for="task-name" class="form-label">Task Name:</label>
            <input type="text" name="task-name" placeholder="Grab some milk..." value="<?= htmlspecialchars($task['name']) ?>">
        </div>

        <!-- description -->
        <div class="form-group">
            <label for="task-description" class="form-label">Task Description:</label>
            <textarea name="task-description" placeholder="Grab milk at Ikea" rows="4"><?= htmlspecialchars($task['description']) ?></textarea>
        </div>

        <!-- due_date -->
        <div class="form-group">
            <label for="task-due" class="form-label">Task Due Date:</label>
            <input type="datetime-local" name="task-due" value="<?= htmlspecialchars($task['due_date']) ?>">
        </div>

        <!-- priority -->
        <div class="form-group">
            <label for="task-priority" class="form-label">Task Priority:</label>
            <select name="task-priority" >
                <?php foreach($priority as $key => $value): ?>
                    <option 
                        value="<?= $value ?>"
                        <?= $task['priority'] == $value ? 'selected' : '' ?>
                    ><?= ucfirst($value) ?></option>
                <?php endforeach ?>
            </select>
        </div>
        
        <a href="/tasks" class="btn btn-primary">Back</a>
        <button type="submit" id="taskAddSubmit" class="btn btn-success">Apply</button>
    </form>
</div>