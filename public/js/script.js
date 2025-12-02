// Add Task Form
const addTaskForm = document.getElementById("add-task-form");
document.getElementById("add-task-form").addEventListener('submit', (e)=>{
    const data = new FormData(addTaskForm);
    let errors = [];

    for (const [key, value] of data.entries()) {
        console.log(key, value);
    }

    if (data.get("task-name") === ''){
        errors.push("Task Name is empty.");
    } 

    if (data.get("task-due") === ''){
        errors.push("Task Due is empty.");
    } 

    if (data.get("task-priority") === ''){
        errors.push("Task Priority is empty.");
    }

    if(errors.length !== 0){
        e.preventDefault();

        let errorMsg = "There is an error on the form: \n";
        errors.forEach(err => {
            errorMsg += "- " + err + "\n";
        });

        alert(errorMsg);
    }else{
        // Submit Successful
    }
});