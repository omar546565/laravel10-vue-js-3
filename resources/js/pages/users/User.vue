<script setup>
import { ref } from 'vue';
import { onMounted } from "@vue/runtime-core";
import axios from "axios";
import { toast } from "vue3-toastify";

const Users = ref([]);
const page = ref(1);
const notify = (message) => {
  toast.success(message, {
    autoClose: 3000,
    position: toast.POSITION.TOP_CENTER,
  });
};
const notifyError = (message) => {
  toast.error(message, {
    autoClose: 3000,
    position: toast.POSITION.TOP_CENTER,
  });
};

const getUsers= (page) =>{
    axios.get(`index-users?page=${page}`).then((res) => {
        Users.value = res.data.users.data;
        notify(res.data.message);
    });
}
onMounted(() => {
    getUsers(page);
});
</script>
<template>
  <div>
    <div class="card o-hidden border-0 shadow-lg my-5">
      <div class="card-header">users table</div>
      <div class="card-body p-0">
        <div class="table-responsive">
          <table class="table table-bordered text-center" width="100%">
            <thead>
              <tr>
                <th>Actions</th>
                <th>id</th>
                <th>name</th>
                <th>email</th>
                <th>mobile</th>
              </tr>
            </thead>
            <tfoot></tfoot>
            <tbody>
              <tr v-for="user in Users" :key="user.id">
                <td>
                  <button class="btn btn-danger btn-circle btn-sm m-1">
                    <i class="fas fa-trash"></i>
                  </button>

                  <button class="btn btn-info btn-circle btn-sm">
                    <i class="fas fa-edit"></i>
                  </button>
                </td>
                <td>
                    {{ user.id }}
                </td>
                <td>
                    {{ user.name }}
                </td>
                <td>
                    {{ user.email }}
                </td>
                <td>
                    {{ user.mobile }}
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</template>
