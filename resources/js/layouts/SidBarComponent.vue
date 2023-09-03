<script setup>
import { ref } from 'vue'
import { onMounted, watchEffect } from "@vue/runtime-core";

onMounted(async () => {
   await  getPages();
});
const props = defineProps([
    "toggled"]
)
const filteredSubPages=(pages,per)=>{
    return pages.filter((page) => {
        return  chickPermission(page.id,per)}
        )
}
const chickPermission=(page_id,per)=>{
    let permission = perUser.value.find(
        permission => permission.page_id === page_id
        && permission[per] === 1
        );
        if(permission){
            return true;
        }else{
            return false;
        }
}
const pages = ref([]);
const getPages = async () => {
   await  axios.get(`get-pages`).then((res) => {
        pages.value = res.data.pages;
        // notify(res.data.message);
    });
}
const perUser = ref(JSON.parse(localStorage.getItem("perUser")));
watchEffect(() => {
    if ( perUser.value == null) {
        window.location.reload();
    }
});
</script>
<template>
    <ul :class="`navbar-nav bg-gradient-primary sidebar sidebar-dark accordion ${props.toggled}`" id="accordionSidebar">

<!-- Sidebar - Brand -->
<a class="sidebar-brand d-flex align-items-center justify-content-center" href="/">
    <div class="sidebar-brand-icon rotate-n-15">
        <i class="fas fa-code"></i>
    </div>
    <div class="sidebar-brand-text mx-3">tebiyan <sup>code</sup></div>
</a>

<!-- Divider -->
<hr class="sidebar-divider my-0">

<!-- Nav Item - Dashboard -->
<li class="nav-item active">
    <a class="nav-link" href="index.html">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Dashboard</span></a>
</li>

<!-- Divider -->
<hr class="sidebar-divider">

<!-- Heading -->
<div class="sidebar-heading">
    Interface
</div>

<!-- Nav Item - Pages Collapse Menu -->
<li v-for="page in pages" :key="page.id" class="nav-item">
    <a v-if="filteredSubPages(page.pages,'read').length > 0 && chickPermission(page.id,'read')" class="nav-link collapsed"
    href="#"
    data-toggle="collapse"
    :data-target="`#collapseTwo${page.id}`"
        aria-expanded="true"
         :aria-controls="`collapseTwo${page.id}`">
        <i :class="page.icon"></i>
        <span>{{ page.page }}</span>
    </a>
    <div :id="`collapseTwo${page.id}`" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">{{ page.page }}:</h6>

            <RouterLink
            v-for="sub in filteredSubPages(page.pages,'read')"
            :key="sub.id"
            :to="sub.path"
             class="collapse-item">
            <i :class="sub.icon"></i>
            <span>{{ sub.page }}</span>
        </RouterLink>
        </div>
    </div>
    <RouterLink
     v-if="page.path != '#' && chickPermission(page.id,'read')"
     :to="page.path"
     class="nav-link">
            <i :class="page.icon"></i>
            <span>{{ page.page }}</span>
        </RouterLink>
</li>
    <!-- Divider -->
    <hr class="sidebar-divider" />







<!-- Nav Item - Charts -->
<!-- <li class="nav-item">

        <RouterLink to="/users" class="nav-link">
            <i class="fas fa-fw fa-user"></i>
            <span>Users</span>
        </RouterLink>
</li> -->







</ul>
</template>
