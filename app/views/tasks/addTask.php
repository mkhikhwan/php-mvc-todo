<h1>Add Task</h1>

<form action="" method="POST">
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
        <input type="datetime" name="task-due">
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
    
    <button id="taskAddSubmit" onclick="alert('Form Submitted')" class="btn btn-primary">Submit</button>
    <button id="taskAddClear" onclick="alert('Clear Form')" class="btn btn-secondary">Clear Form</button>
</form>
<!-- 
#	Name	Type	Collation	Attributes	Null	Default	Comments	Extra	Action
	1	id Primary	int			No	None		AUTO_INCREMENT	Change Change	Drop Drop	
	2	user_id Index	int			No	None			Change Change	Drop Drop	
	3	name	varchar(255)	utf8mb4_0900_ai_ci		No	None			Change Change	Drop Drop	
	4	description	text	utf8mb4_0900_ai_ci		Yes	NULL			Change Change	Drop Drop	
	5	created_date	datetime			No	CURRENT_TIMESTAMP		DEFAULT_GENERATED	Change Change	Drop Drop	
	6	due_date	datetime			Yes	NULL			Change Change	Drop Drop	
	7	priority	enum('low', 'medium', 'high')	utf8mb4_0900_ai_ci		No	low			Change Change	Drop Drop
-->
