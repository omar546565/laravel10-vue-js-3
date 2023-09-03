
<script setup>
import { ref } from "vue";
import Sidebar from "./SidBarComponent.vue";
import TopBar from "./TopBarComponent.vue";
import Footer from "./FooterComponent.vue";

const toggled = ref("");

const token = localStorage.getItem("token");
const user = ref("");

axios.get('/user').then((res) => {
  user.value = res.data.user;
  localStorage.setItem("perUser", JSON.stringify(res.data.user.role.permissions));
});

</script>
<template>
  <div id="wrapper">
    <!-- Sidebar -->
    <Sidebar v-if="token" :toggled="toggled" />
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">
      <!-- Main Content -->
      <div id="content">
        <!-- Topbar -->
        <TopBar v-if="token" @emitToggled="toggled = $event" :user="user" />
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">
          <router-view :user="user" ></router-view>
        </div>
        <!-- /.container-fluid -->
      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <Footer v-if="token" />
      <!-- End of Footer -->
    </div>
    <!-- End of Content Wrapper -->
  </div>
</template>
<style scoped>
</style>


