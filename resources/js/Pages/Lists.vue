<script setup lang="ts">
import ShowTodo from '@/Components/Dashboard/Show/ShowTodo.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { TodoList, User } from '@/types';
import { toRefs, watchEffect } from 'vue';
import { displayedTodos, allLists } from '@/Components/Menu/menu';
import NavLink from '@/Components/Defaults/NavLink.vue';
import Menu from '@/Components/Menu/Menu.vue';
const props = defineProps<{
    users: User[];
    currentUser: User;
    currentLists: TodoList[];
}>();
const { users, currentUser, currentLists } = toRefs(props);
watchEffect(() => (allLists.value = currentLists.value));
allLists.value = currentLists.value;
</script>

<template>
    <AuthenticatedLayout>
        <Menu />
        <TransitionGroup name="todo">
            <ShowTodo
                v-for="todo of displayedTodos.filter(e => e.todo_item_user.find(e => e.id == currentUser.id))"
                :todo="todo"
                :users="users"
                :current-user="currentUser"
                :key="todo.id"
                class="my-3"
                style="max-height: max-content"
            />
        </TransitionGroup>
        <template v-if="!displayedTodos.length">
            <div class="text-center mt-5">
                <h4>Alle Aufgaben sind erledigt, {{ currentUser.name.slice(0, 1).toLocaleUpperCase() + currentUser.name.slice(1) }}!</h4>
                <NavLink :href="route('Dashboard')" :active="route().current('dashboard')" class="text-decoration-none text-dark">
                    <i>Finde oder erstelle Aufgaben hier.</i>
                </NavLink>
            </div>
        </template>
    </AuthenticatedLayout>
</template>

<style scoped lang="scss">
.todo-move,
.todo-enter-active,
.todo-leave-active {
    transition: all 0.1s ease;
}

.todo-enter-from,
.todo-leave-to {
    opacity: 0;
}

.todo-leave-active .todo-enter-active {
    position: relative;
}
</style>
