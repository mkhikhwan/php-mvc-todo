<div class="main-content">
    <h1>Add Task</h1>

    <form action="" method="POST" class="add-task-form" id="add-task-form">
        <!-- name -->
        <div class="form-group">
            <label for="task-name" class="form-label">Task Name:</label>
            <input type="text" name="task-name" placeholder="Grab some milk...">
        </div>

        <!-- description -->
        <div class="form-group">
            <label for="task-description" class="form-label">Task Description:</label>
            <textarea name="task-description" placeholder="Grab milk at Ikea" rows="4"></textarea>
        </div>

        <!-- due_date -->
        <div class="form-group">
            <label for="task-due" class="form-label">Task Due Date:</label>
            <input type="datetime-local" name="task-due">
        </div>

        <!-- priority -->
        <div class="form-group">
            <label for="task-priority" class="form-label">Task Priority:</label>
            <select name="task-priority">
                <option value="low">Low</option>
                <option value="medium">Medium</option>
                <option value="high">High</option>
            </select>
        </div>
        
        <a href="/tasks" class="btn btn-primary">Back</a>
        <button type="submit" id="taskAddSubmit" class="btn btn-success">Submit</button>
        <button type="button" id="taskAddClear" onclick="addTaskClear()" class="btn btn-ghost">Clear Form</button>
    </form>
</div>