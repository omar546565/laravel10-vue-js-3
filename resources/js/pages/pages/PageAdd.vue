<script setup>
import { ref } from 'vue'
import { toast } from "vue3-toastify";
import { watchEffect } from '@vue/runtime-core';

const emit = defineEmits(['goBack']);
const props = defineProps(["page","Pages"]);

const Pages =ref([]);

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



const item = ref({})



const goBack = () => {
 item.value = {}
    emit('goBack',false)
}
const createPage = () => {

    if (item.value.page === ''  ) {
           alert('Please fill all fields');
       } else {
    axios.post('/create-page',  item.value).then((res) => {
        notify(res.data.message)

        emit('goBack',false)
        item.value = {}


    }).catch((err) => {
        notifyError(err.response.data.message)
    })
}
}
watchEffect(()=>{
  if(props.page){
    item.value = props.page
  }else{
    item.value = {
        page:'',
        path:'#',
        icon:'fa fa-file-text-o',
        page_id:0,
        order:0,
    }
  }
  if(props.Pages){
    Pages.value =props.Pages
    Pages.value.push({id:0,page:'no page'})
  }
});
</script>
<template>
     <div class="container">

<div class="card o-hidden border-0 shadow-lg my-5">
    <div class="card-body p-0">
        <!-- Nested Row within Card Body -->
        <div class="row">

            <div class="col-lg-7">
                <div class="p-5">
                    <div class="text-center">
                        <h1    class="h4 text-gray-900 mb-4">
                            {{  props.page ? 'update an Account' : 'Create an Account'   }}
                        </h1>

                    </div>
                    <form class="page">
                        <div class="form-group row">
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <input type="text" v-model="item.page" class="form-control form-control-page"
                                    placeholder="  page">
                            </div>
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <input type="text" v-model="item.path" class="form-control form-control-page"
                                    placeholder="  path">
                            </div>


                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <input type="text" v-model="item.icon" class="form-control form-control-page"
                                    placeholder="  icon">
                            </div>
                            <div class="col-sm-6 mb-3 mb-sm-0">

                                    <select class="form-control" v-model="item.page_id">
                                <option v-for="Page in Pages" :key="Page.id" :value="Page.id">
                                    {{Page.page}} </option>
                               </select>
                            </div>

                        </div>
                        <div class="form-group row">

                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <input type="number" v-model="item.order" class="form-control form-control-page"
                                    placeholder="order">
                            </div>

                        </div>


                        <a @click="createPage()" class="btn btn-primary btn-page btn-block">
                             {{  props.page  ? 'update Page' : 'create Page'   }}
                        </a>
                        <a @click="goBack()" class="btn btn-info btn-page btn-block">
                            back
                        </a>

                    </form>
                    <hr>


                </div>
            </div>
        </div>
    </div>
</div>

</div>
</template>
