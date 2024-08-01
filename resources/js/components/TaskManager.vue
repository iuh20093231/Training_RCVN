<template>
      <div class="mt-5">
       <form action="" class="row" @submit.prevent="addTask" method="POST">
        <input type="text" v-model="newTaskName" placeholder="Task Name" class="form-control form-control-lg float-left w-50" id="name" />
        <input v-model="newTaskDate" type="date" class="form-control form-control-lg float-left w-25" id="days" />
        <button class="btn btn-success btn-lg float-left w-25" id="btn-add">ADD+</button>
        <span v-if="errors.name" class="text-danger pt-2" style="text-align: left; font-weight: bold;">{{ errors.name[0] }}</span>
      </form>
      </div>
      <div class="row mt-5">
        <table class="table table-hover">
            <thead class="thead-danger">
              <tr>
                <th>DONE?</th>
                <th>TASK</th>
                <th>DATE</th>
                <th>ACTIONS</th>
              </tr>
            </thead>
            <draggable tag="tbody" :list="tasks.data" @end="onDragEnd">
              <template #item="{element}">
                <tr :key="element.id">
                  <td class="p-3">
                    <input type="checkbox" name="completed"  :checked="element.completed === 1 "
                    @change="updateCompleted(element.id)"/>
                  </td>
                  <td class="p-3">
                    <input v-if="editTaskId === element.id" v-model="element.name" class="form-control" />
                    <span v-else>{{ element.name }}</span>
                    <div v-if="errors[element.id]?.name" class="error text-danger">{{ errors[element.id].name }}</div>
                  </td>
                  <td class="p-3">
                    <input v-if="editTaskId === element.id" type="date" v-model="element.created_at"  class="form-control"/>
                    <span v-else >{{ formatDate(element.created_at) }}</span>
                  </td>
                  <td>
                    <button v-if="editTaskId === element.id" @click="updateTask(element.id)" class="btn btn-success m-2">Save</button>
                    <button v-else @click="editTask(element)" class="btn btn-primary m-2">Edit</button>
                    <button @click="deleteTask(element.id)" class="btn btn-danger m-2">Delete</button>
                  </td>
                </tr>
              </template>
            </draggable>
          </table>
      <div class="text-center">
        <button v-if="tasks.next_page_url" @click="loadMore" class="btn btn-info btn-lg w-50">Load More</button>
      </div>
    </div>
  </template>

 <script>
import { showTask, addTask, editTask, updateTask, deleteTask, loadMore, updateCompleted, onDragEnd } from '../taskMethod';
import draggable from 'vuedraggable';
import axios from 'axios';
  export default {
    components: {
      draggable,
    },
    data() {
      return {
        newTaskName: '',
        newTaskDate: '',
        tasks: { data: [], next_page_url: null },
        editTaskId: null,
        errors: {}
      };
    },
    created() {
      this.showTask();
    },
    methods: {
        formatDate(inputDate) {
        const date = new Date(inputDate);
        const year = date.getFullYear();
        const month = String(date.getMonth() + 1).padStart(2, '0');
        const day = String(date.getDate()).padStart(2, '0');
        return [month, day, year].join('/');
        },
        showTask() {
          showTask(this);
        },
        addTask() {
            addTask(this);
        },
        editTask(task) {
            editTask(this,task);
        },
        updateTask(id) {
            updateTask(this,id);
        },
        deleteTask(id) {
            deleteTask(this,id);
        },
        updateCompleted(id) {
          updateCompleted(this,id);
        },
        loadMore() {
            loadMore(this);
        },
        onDragEnd() {
          onDragEnd(this);
        }
      },
      mounted() {
        this.showTask();
      }
    };
  </script> 
  