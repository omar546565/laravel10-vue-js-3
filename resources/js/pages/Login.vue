<script setup>
import { ref } from "@vue/reactivity"

const name = ref("")
const email = ref("")
const password = ref("")
const error = ref(null)

const login = () => {
    error.value = null
    if (email.value === "" || password.value === "") {
        error.value = "Please fill in all fields"
        return
    }
    // call login api here
    alert("welcome "+ name.value)
}
</script>
<template>
    <div>
      <!-- add  login form here -->
      <div class="card">

      <h1>Login Page</h1>

        <form @submit.prevent="login">
            <div class="form-control">
            <label for="name">Name</label>
            <input type="text" id="name" v-model="name" />
            </div>
            <div class="form-control">
            <label for="email">Email</label>
            <input type="email" id="email" v-model="email" />
            </div>
            <div class="form-control">
            <label for="password">Password</label>
            <input type="password" id="password" v-model="password" />
            </div>
            <div class="form-control">
            <button type="submit" class="btn btn-primary" >Login</button>
            </div>
        </form>
        <div v-if="error">{{ error }}</div>
    </div>
    </div>
</template>
<style scoped>
h1 {
    font-size: 2rem;
    font-weight: bold;
}
form {
    display: flex;
    flex-direction: column;
    gap: 1rem;
}
label {
    font-size: 1.2rem;
    font-weight: bold;
}
input {
    padding: 0.5rem;
    border-radius: 0.5rem;
    border: 1px solid #ccc;
}
button {
    padding: 0.5rem;
    border-radius: 0.5rem;
    border: 1px solid #ccc;
    background-color: #ccc;
    cursor: pointer;
}
button:hover {
    background-color: #bbb;
}
.card {
    padding: 2rem;
    border-radius: 0.5rem;
    border: 1px solid #ccc;
    width: 400px;
    margin: 0 auto;
    /* center page */
    margin-top: 5rem;


}
.form-control {
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
}




</style>


