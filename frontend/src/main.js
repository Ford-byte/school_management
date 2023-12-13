import { createApp, ref } from "vue";
import App from "./App.vue";
import Login from "./views/LoginView.vue";
import adminPrivilage from './AdminPrivilage.vue';
import router from "./router";

const isLog = ref(false);
const isUser = ref("");

isLog.value = localStorage.getItem("isLog") === "true";
isUser.value = localStorage.getItem("isUser");

console.log(isLog.value);
if (isLog.value) {
  if (isUser.value == "admin") {
    const app = createApp(App);
    router.push('/'); 
    app.use(router);
    app.mount("#app");
  } else if (isUser.value == "adminPrivilage") {
    const privilage = createApp(adminPrivilage);
    router.push('/'); 
    privilage.use(router);
    privilage.mount("#app");
  } else if (isUser.value == "faculty") {
    const app = createApp(App);
    router.push('/'); 
    app.use(router);
    app.mount("#app");
  }
} else {
  const Log = createApp(Login);
  Log.use(router);
  Log.mount("#app");
}
