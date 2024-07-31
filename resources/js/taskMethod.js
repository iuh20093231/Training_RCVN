import axios from 'axios';
export const showTask = (component) => {
    axios.get('/tasks').then(response => {
        component.tasks = response.data;
    });
};
export const addTask = (component) => {
    const taskDate = component.newTaskDate ? component.newTaskDate : new Date();
    axios.post('/tasks', {
      name: component.newTaskName,
      date: taskDate 
    }).then(response => {
        component.tasks.data.unshift(response.data);
        component.newTaskName = '';
        component.newTaskDate = '';
        component.errors = {};
    })
    .catch(error => {
      if (error.response && error.response.status === 422) {
        component.errors = error.response.data.errors;
      }
    });
};
export const editTask = (component,task) => {
    component.editTaskId = task.id;
};
export const cancelUpdate = (component,id) => {
    const task = component.tasks.data.find(task => task.id === id);
    if(task)
    {
        component.editTaskId = null;
        task.name = task.name;
        component.errors[task.id]={};
    }
}
export const updateTask = (component,id) => {
    const task = component.tasks.data.find(task => task.id === id);
    const data = {
        name: task.name,
        created_at: component.formatDate(task.created_at),
    };
    axios.put(`/tasks/${id}`, data).then(() => {
        component.editTaskId = null;
        component.errors = {};
    }).catch(error => {
      if (error.response && error.response.data.errors) {
        component.errors[task.id] = error.response.data.errors;
      }
    });
};
export const deleteTask = (component,id) => {
    axios.delete(`/tasks/${id}`).then(() => {
        component.tasks.data = component.tasks.data.filter(task => task.id !== id);
    });
};
export const updateCompleted = (component,id) => {
    const task = component.tasks.data.find(task => task.id === id);
    task.completed = !task.completed;
    const data = {
        name: task.name,
        created_at: component.formatDate(task.created_at),
        completed: task.completed
    };
    axios.put(`/tasks/${id}`,data).then(response => {
        console.log('update status success');
    });
};
export const loadMore = (component) => {
    axios.get(component.tasks.next_page_url).then(response => {
        component.tasks.data.push(...response.data.data);
        component.tasks.next_page_url = response.data.next_page_url;
    });
}
