<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Login</div>

                    <div class="card-body">
                        <form @submit.prevent="login" method="POST" action="/login">
                            <div class="form-group row">
                                <label for="email" class="col-sm-4 col-form-label text-md-right">Email Address</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control" name="email" v-model="email" required autofocus>
<!--                                    <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="" required autofocus>-->

<!--
                                    @if ($errors->has('email'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
-->
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control" name="password" v-model="password" required>
<!--                                    <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>-->

<!--
                                    @if ($errors->has('password'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
-->
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-6 offset-md-4">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="remember"> Remember Me
<!--                                            <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> {{ __('Remember Me') }}-->
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button id="login-button" type="submit" class="btn btn-primary">Login</button>

                                    <a class="btn btn-link" href="/password/reset">Forgot Your Password?</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script lang="ts">
import axios, { AxiosResponse } from 'axios';
import Vue from 'vue';
import { Component } from 'vue-property-decorator';

@Component
export default class Login extends Vue {
  public email: string = '';
  public password: string = '';

  public login(): void {
    console.log(this.email, this.password);
    axios.post('/api/login',
      {
        email: this.email,
        password: this.password,
      })
      .then(({data}: AxiosResponse) => {
        axios.defaults.headers.common['Authorization'] = `Bearer ${(data.token)}`;
        axios.get('/api/user');
      })
      .catch((error: AxiosResponse) => {
        console.error(error);
      });
    // axios.post('/login')
    //   .then((response: AxiosResponse) => {
    //     console.log(response);
    //   })
    //   .catch((error: AxiosResponse) => {
    //     console.error(error);
    //   });
  }
}
</script>
<style></style>
