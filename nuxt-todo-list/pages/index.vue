<template>
    <div class="todo-container">
      <h1>My To-Do List</h1>
      <form @submit.prevent="addTask">
        <input
          v-model="newTask"
          placeholder="Add a new task"
          class="task-input"
        />
        <button type="submit" class="add-task-btn">Add Task</button>
      </form>
      <ul class="task-list">
        <li 
          v-for="task in tasks" 
          :key="task.id"
          class="task-item"
        >
          {{ task.todo }}
          <button @click="deleteTask(task.id)" class="delete-task-btn">Delete</button>
        </li>
      </ul>
    </div>
  </template>

<script setup lang="ts">
import { ref } from 'vue';

interface Task {
  id: number;
  todo: string;
  done: boolean;
}

const tasks = ref<Task[]>([]);
const newTask = ref('');

const addTask = () => {
  if (newTask.value.trim()) {
    const newId = tasks.value.length + 1;
    tasks.value.push({ id: newId, todo: newTask.value, done: false });
    newTask.value = ''; // Clear the input after adding
  }
};

const deleteTask = (id: number) => {
  tasks.value = tasks.value.filter(task => task.id !== id);
};
</script>


<style scoped>
.todo-container {
  max-width: 600px;
  margin: 0 auto;
  padding: 20px;
}

.task-input, .add-task-btn, .delete-task-btn {
  margin: 10px 0;
}

.task-input {
  width: calc(100% - 110px);
  padding: 10px;
  margin-right: 10px;
}

.add-task-btn, .delete-task-btn {
  cursor: pointer;
  padding: 10px 15px;
  background-color: #007bff;
  border: none;
  color: white;
  border-radius: 5px;
}

.delete-task-btn {
  background-color: #dc3545;
}

.task-list {
  list-style: none;
  padding: 0;
}

.task-item {
  margin-bottom: 10px;
  display: flex;
  justify-content: space-between;
  align-items: center;
}
</style>
