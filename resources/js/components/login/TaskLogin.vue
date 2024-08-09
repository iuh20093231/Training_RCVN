<template>
    <form class="form mt-3" method="post" @submit.prevent="submitLogin">
        <div class=" frm-top user ms-4">
            <label for="email" class="label me-5"><i class="fa fa-user" aria-hidden="true"></i></label>
            <input type="text" name="email" id="email" v-model="email"  placeholder="Email" ><br>
            <span v-if="errors.email" class="text-danger">{{ errors.email[0] }}</span>
        </div>
        <div class=" frm-top pass mt-2 ms-4">
            <label for="password" class="label me-5"><i class="fa fa-lock" aria-hidden="true"></i></label>
            <input type="password" name="password" v-model="password" id="password" placeholder="Mật khẩu"><br>
            <span v-if="errors.password" class="text-danger">{{ errors.password[0] }}</span>
        </div>
        <div class="form group mt-3 ms-4">
            <input type="checkbox" class="me-5" name="remember_token" v-model="remember_token">
            <label for="remember_token">Remmber</label>
        </div>
        <div class="form-group mt-3 text-center">
            <button type="submit" class="btn btn-primary"><b>Đăng nhập</b></button>
        </div>
    </form>
</template>
<script>
import axios from 'axios';

export default {
    data() {
        return {
            email: '',
            password: '',
            remember_token: false,
            errors: {}
        };
    },
    methods: {
        submitLogin() {
            axios.post('/login',{
                email: this.email,
                password: this.password,
                remember_token: this.remember_token
            }).then(response => {
                window.location.href = response.data.redirect || '/product';
            }).catch(error => {
                if (error.response && error.response.status === 422) {
                    this.errors = error.response.data.errors;
                }
            })
        }
    }
}
</script>
