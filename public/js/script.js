document.addEventListener('DOMContentLoaded', ()=>{
    const flashMessage = document.querySelector(".flash");
    if(flashMessage){
        // If there is flash message, auto close it after a few seconds.
        setTimeout(()=>{
            flashMessage.style.opacity = "0";
            flashMessage.style.transition = "opacity 0.5s";
            setTimeout(()=>{
                flashMessage.remove()
            }, 500);
        }, 5000);

        const closeButton = flashMessage.querySelector(".flash-closeButton");
        if(closeButton){
            closeButton.addEventListener('click', ()=>{
                flashMessage.remove();
            });
        }
    }
});

// Add Task Form
const addTaskForm = document.getElementById("add-task-form");
if(addTaskForm){
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
}


// Task Button Actions
const taskButtons = document.querySelectorAll(".task-buttons");
if(taskButtons){
    taskButtons.forEach((e)=>{
        const taskId = e.dataset.id;

        const deleteButton = e.querySelector(".btn-delete");
        deleteButton.addEventListener('click', ()=>{
            const delConfirm = confirm('Are you sure you want to delete?');
            if(delConfirm){
                callServer( 'tasks/delete', { 'id': taskId } );
            }
        });

        const doneButton = e.querySelector(".btn-done");
        const undoneButton = e.querySelector(".btn-unDone");

        if(doneButton){
            doneButton.addEventListener('click', ()=>{
                callServer( 'tasks/setDone', { 'id': taskId } );
            });
        }
        else if(undoneButton){
            undoneButton.addEventListener('click', ()=>{
                callServer( 'tasks/setUndone', { 'id': taskId } );
            });
        }
    });
}

function callServer(url, data){
    const form = document.createElement("form");
    form.method = "POST";
    form.action = url;

    for(const key in data){
        const input = document.createElement("input");
        input.type = "hidden";
        input.name = key;
        input.value = data[key];
        form.appendChild(input);
    }

    document.body.appendChild(form);
    form.submit();
}