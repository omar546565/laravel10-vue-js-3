<script setup>
import { ref } from 'vue'
import   photoComponent from  '@/components/photoComponent.vue'

const name = ref('')
const email = ref('')
const props = defineProps([
    "user"]
)


const UserUpdate = () => {
    if (props.user.name === '' || props.user.email === '' ) {
           alert('Please fill all fields');
       } else {
    axios.post('/user-update', {
        name: props.user.name,
        email: props.user.email,

    }).then((res) => {

       alert(res.data.message)
    }).catch((err) => {

        alert(err.response.data.message)
    })
}
}
const submitFile = (file) => {
     alert(file);
}
</script>
<template>
     <div class="container">

<div class="card o-hidden border-0 shadow-lg my-5">
    <div class="card-body p-0">
        <!-- Nested Row within Card Body -->
        <div class="row">
            <div class="col-lg-5 d-none d-lg-block bg-profile-image"></div>
            <div class="col-lg-7">
                <div class="p-5">
                    <div class="text-center">
                        <h1 class="h4 text-gray-900 mb-4">profile</h1>
                    </div>
                    <form class="user">
                        <div class="form-group row">
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <input type="text" v-model="props.user.name" class="form-control form-control-user" id="exampleName"
                                    placeholder="  Name">
                            </div>

                        </div>
                        <div class="form-group">
                            <input type="email" v-model="props.user.email" class="form-control form-control-user" id="exampleInputEmail"
                                placeholder="Email Address">
                        </div>

                        <a @click="UserUpdate()" class="btn btn-primary btn-user btn-block">
                            update
                        </a>

                    </form>
                    <hr>

                    <div class="text-center">
                        <router-link
                            class="small"
                            to="/reset-password-form-sent"
                        >
                        change password

                        </router-link>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
        <div class="col-12">
        <div class="card pb-5">
         <photoComponent
         class="m-auto"
         @isEmit="submitFile($event)"
           />

        </div>
        </div>
        </div>
    </div>
</div>

</div>
</template>
