
<template>
    <div>
      <!-- add  login form here -->
      <div class="card">

      <h1>main</h1>
       <router-view></router-view>

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


