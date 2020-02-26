<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="w-1/2 mx-auto">
                <div class="card">
                    <div class="card-body">
                        <form @submit.prevent="register">

                            <div class="form-group row md:flex md:items-center mb-6">
                                <div class="md:w-1/3">
                                    <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4"
                                        for="first_name">First Name</label>
                                </div>
                                <div class="md:w-2/3">
                                    <input class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500"
                                        id="first_name"
                                        type="text"
                                        v-model="firstName"
                                        required
                                        autofocus>
                                </div>
                            </div>

                            <div class="form-group row md:flex md:items-center mb-6">
                                <div class="md:w-1/3">
                                    <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4"
                                        for="last_name">Last Name</label>
                                </div>
                                <div class="md:w-2/3">
                                    <input class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500"
                                        id="last_name"
                                        type="text"
                                        v-model="lastName"
                                        required
                                        autofocus>
                                </div>
                            </div>

                            <div class="form-group row md:flex md:items-center mb-6">
                                <div class="md:w-1/3">
                                    <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4"
                                        for="email"> Email </label>
                                </div>
                                <div class="md:w-2/3">
                                    <input class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500"
                                        id="email"
                                        type="email"
                                        v-model="email"
                                        required
                                        autofocus>
                                </div>
                            </div>

                            <div class="form-group row md:flex md:items-center mb-6">
                                <div class="md:w-1/3">
                                    <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4"
                                        for="password"> Password </label>
                                </div>
                                <div class="md:w-2/3">
                                    <input class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500"
                                        id="password"
                                        type="password"
                                        v-model="password">
                                </div>
                            </div>

                            <div class="form-group row md:flex md:items-center mb-6">
                                <div class="md:w-1/3">
                                    <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4"
                                        for="password">Confirm Password</label>
                                </div>
                                <div class="md:w-2/3">
                                    <input class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500"
                                        id="password_confirmation"
                                        type="password"
                                        v-model="passwordConfirmation">
                                </div>
                            </div>

                            <div class="md:flex md:items-center mb-6">
                                <div class="md:w-1/3"></div>
                                <label class="md:w-2/3 block text-gray-500 font-bold">
                                    <input class="mr-2 leading-tight"
                                        type="checkbox"
                                    >
                                        <span class="text-sm">
                                            Remember Me
                                        </span>
                                </label>
                            </div>

                            <div class="md:flex md:items-center">
                                <div class="md:w-1/3"></div>
                                <div class="md:w-2/3">
                                    <button class="shadow btn btn-primary w-full focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded"
                                        type="submit"
                                    >
                                        Login
                                    </button>

                                    <a class="text-sm"
                                        href="/password/reset">Forgot Your Password?</a>
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
export default class Register extends Vue {
  public firstName: string = '';
  public lastName: string = '';
  public email: string = '';
  public password: string = '';
  public passwordConfirmation: string = '';
  public token: string = '';
  public message?: string;
  public errors: Object[] = [];

  public register(): void {
    axios.post('/api/register',
      {
        first_name: this.firstName,
        last_name: this.lastName,
        email: this.email,
        password: this.password,
        password_confirmation: this.passwordConfirmation,
      })
      .then(({ data }: AxiosResponse) => {
        axios.defaults.headers.common['Authorization'] = `Bearer ${(data.token)}`;
        this.$store.dispatch('login', data);
        this.$router.push({ name: 'Games' })
      });
  }
}
</script>

<style></style>
