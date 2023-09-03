<script setup>
import { ref } from 'vue';
import PageAdd from "./PageAdd.vue";
import { onMounted } from "@vue/runtime-core";
import axios from "axios";
import { toast } from "vue3-toastify";

const isEdit = ref(false);
const page = ref({});
const Pages = ref([]);

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

const pageEdit = (pageSelect) => {
  isEdit.value = true;
  page.value = pageSelect;
};
const addPage = () => {
  isEdit.value = true;
  page.value = false;
};
const getPages= () =>{
    axios.get(`get-pages`).then((res) => {
        Pages.value = res.data.pages;
        notify(res.data.message);
    });
}
const goBack = (event) => {
  isEdit.value = event;
  page.value = false;
  getPages(page);
};
onMounted(() => {
    getPages();
});
</script>
<template>
  <div>
    <PageAdd v-if="isEdit"  @goBack="goBack($event)" :page="page" />
    <div v-if="!isEdit" class="card o-hidden border-0 shadow-lg my-5">
      <div class="card-header">
        <h4 class="card-title" > page table</h4>
        <button
          class="btn btn-primary btn-circle btn-sm float-end"
          @click="addPage"
        >
            <i class="fas fa-plus"></i>
        </button>
      </div>
      <div class="card-body p-0">
        <div class="table-responsive">
          <table class="table table-bordered text-center" width="100%">
            <thead>
              <tr>
                <th>Actions</th>
                <th>id</th>
                <th>name</th>


              </tr>
            </thead>
            <tfoot></tfoot>
            <tbody>
              <tr v-for="page in Pages" :key="page.id">
                <td>
                  <button hidden class="btn btn-danger btn-circle btn-sm m-1">
                    <i class="fas fa-trash"></i>
                  </button>

                  <button @click="pageEdit(page)" class="btn btn-info btn-circle btn-sm">
                    <i class="fas fa-edit"></i>
                  </button>
                </td>
                <td>
                    {{ page.id }}
                </td>
                <td>
                    {{ page.page }}
                </td>

              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</template>
