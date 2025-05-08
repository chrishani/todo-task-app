<script setup>
import { ref, reactive, onMounted } from 'vue';
import {Head, router, useForm} from "@inertiajs/vue3";

const form = useForm({
    title: '',
    description: '',
    is_completed: false,
});

// Add a new task
const addTask = () => {
    form.post(route("tasks.store"), {
        onSuccess: () => {
            form.reset();
            fetchTasks();
        },
        onError: () => {
            // push.error('Something went to wrong!');
        },
        preserveScroll: true,
        preserveState: true,
    });
};
const baseUrl = ref("/tasks");

// Tasks data with initial values
const tasks = ref([]);
const fetchTasks = async () => {
    try {
        const response = await axios.get(baseUrl.value);
        tasks.value = response.data;
    } catch (error) {
        console.error("Error fetching session history:", error);
    } finally {

    }
};

onMounted(() => {
    fetchTasks();
});

const formDone = useForm();
// Mark a task as done
const markAsDone = (taskId) => {
    formDone.post(route("tasks.complete", taskId), {
        onSuccess: () => {
            fetchTasks();
        },
        onError: () => {
            console.log("error");
        },
        onFinish: () => console.log("finish"),
        preserveScroll: true,
        preserveState: true,
    });
};
</script>

<template>
    <div class="task-manager">
        <div class="container">
            <!-- Add Task Form -->
            <div class="add-task-section">
                <h2>Add a Task</h2>
                <form @submit.prevent="addTask">
                    <div class="form-group">
                        <input
                            v-model="form.title"
                            type="text"
                            class="form-control"
                            placeholder="Title"
                            required
                        >
                    </div>
                    <div class="form-group">
                        <textarea
                            v-model="form.description"
                            class="form-control"
                            placeholder="Description"
                            rows="4"
                            required
                        ></textarea>
                    </div>
                    <div class="btn-container">
                        <button
                            type="submit"
                            class="btn-add"
                        >
                            Add
                        </button>
                    </div>
                </form>
            </div>

            <!-- Task List -->
            <div class="task-list-section">
                <div v-for="task in tasks" :key="task.id" class="task-card">
                    <div class="task-content">
                        <h3>{{ task.title }}</h3>
                        <p>{{ task.description }}</p>
                    </div>
                    <div class="task-actions">
                        <button
                            @click="markAsDone(task.id)"
                            class="btn-done"
                            :disabled="task.is_completed"
                        >
                            Done
                        </button>
                    </div>
                </div>
                <div v-if="tasks.length === 0" class="no-tasks">
                    <p>No tasks available. Add a task to get started!</p>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>
.task-manager {
    font-family: Arial, sans-serif;
    background-color: #f5f5f5;
    min-height: 100vh;
}

.container {
    max-width: 800px;
    margin: 0 auto;
    padding: 20px;
}

.add-task-section {
    background-color: white;
    padding: 20px;
    border-radius: 4px;
    margin-bottom: 20px;
}

.add-task-section h2 {
    font-size: 1.5rem;
    margin-bottom: 20px;
    font-weight: bold;
}

.form-group {
    margin-bottom: 15px;
}

.form-control {
    width: 100%;
    border: 1px solid #ddd;
    border-radius: 4px;
    padding: 10px;
    font-size: 1rem;
}

.btn-container {
    display: flex;
    justify-content: flex-end;
}

.btn-add {
    background-color: #0000ff;
    border: none;
    border-radius: 4px;
    color: white;
    font-weight: bold;
    padding: 10px 25px;
    cursor: pointer;
}

.task-list-section {
    display: flex;
    flex-direction: column;
    gap: 15px;
}

.task-card {
    background-color: #e6e6e6;
    padding: 20px;
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
}

.task-content {
    flex: 1;
}

.task-content h3 {
    font-size: 1.25rem;
    margin-bottom: 8px;
    font-weight: bold;
}

.task-content p {
    color: #555;
    margin-bottom: 0;
}

.btn-done {
    background-color: #f8f9fa;
    border: 1px solid #ddd;
    border-radius: 4px;
    padding: 8px 16px;
    cursor: pointer;
}

.no-tasks {
    text-align: center;
    padding: 20px;
    background-color: white;
}
</style>
