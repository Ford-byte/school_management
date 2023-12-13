<template>
  <div>
    <div class="p-5 bg-image" style="
        background-image: url('https://t4.ftcdn.net/jpg/02/34/39/07/360_F_234390794_zcrrLzztOzyat9hhPf2OKoHHfOIarSrh.jpg');
        height: 350px;
        margin-top:50px;
      "></div>
    <div class="container h-100">
      <div class="d-flex justify-content-center h-100">

        <div class="user_card" style="top: -271px; background-color: white;">
          <form @submit.prevent="login">

            <div class="input-group mb-3">
              <div class="input-group-append">
                <span class="input-group-text" style="background: #14243c ;
			"><svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor" class="bi bi-person-fill"
                    viewBox="0 0 16 16">
                    <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6" />
                  </svg></span>
              </div>
              <input type="text" name="" class="form-control input_user" placeholder="username" v-model="username">
            </div>
            <div class="input-group mb-2">
              <div class="input-group-append">
                <span class="input-group-text" style="background: #14243c ;
			"><svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor" class="bi bi-key-fill"
                    viewBox="0 0 16 16">
                    <path
                      d="M3.5 11.5a3.5 3.5 0 1 1 3.163-5H14L15.5 8 14 9.5l-1-1-1 1-1-1-1 1-1-1-1 1H6.663a3.5 3.5 0 0 1-3.163 2zM2.5 9a1 1 0 1 0 0-2 1 1 0 0 0 0 2" />
                  </svg></span>
              </div>
              <input type="password" v-model="password" class="form-control input_pass" placeholder="password">
            </div>

            <div class="d-flex justify-content-center mt-5 login_container">
              <button type="submit" class="btn login_btn" style="background: #14243c ;">Login</button>

            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>
<script setup>
import { ref, onMounted } from 'vue';

const responseMessage = ref('');
const username = ref('');
const password = ref('');

const login = async () => {
  try {
    const datas = {
      Email: username.value,
      Password: password.value
    };

    const response = await fetch('http://localhost/management/backend/Router/authfacultyRoute.php?action=auth', {
      method: 'POST',
      body: JSON.stringify(datas),
    });

    const data = await response.json();
    console.log(data);

    if (data.authenticated) {
      localStorage.setItem('isLog', 'true');
      localStorage.setItem('isUser', data.isUser);
      localStorage.setItem('Id', data.id);
      localStorage.setItem('role', data.role);

      location.reload();

      username.value = '';
      password.value = '';
    } else {
      responseMessage.value = 'Login failed: ' + data.message;
    }
  } catch (error) {
    responseMessage.value = 'Error: ' + error.message;
  }
};

onMounted(async () => {
  console.log('Component mounted');
});
</script>
<style scoped>
.user_card {
  height: 340px;
  width: 350px;
  margin-top: auto;
  margin-bottom: auto;
  padding: 0 2rem;
  /* background: #14243c ; */
  position: relative;
  display: flex;
  justify-content: center;
  flex-direction: column;

  box-shadow: rgba(60, 64, 67, 0.3) 0px 1px 2px 0px, rgba(60, 64, 67, 0.15) 0px 1px 3px 1px;

}
.login_btn {
  width: 100%;

  color: white !important;
}

.login_btn:focus {
  box-shadow: none !important;
  outline: 0px !important;
}

.login_container {
  padding: 0 2rem;
}

.input-group-text {

  color: white !important;
  border: 0 !important;
  border-radius: 0.25rem 0 0 0.25rem !important;
}

.input_user,
.input_pass:focus {
  box-shadow: none !important;
  outline: 0px !important;
}
</style>