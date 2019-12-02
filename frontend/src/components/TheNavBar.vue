<template>
    <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
        <div class="container">
            <router-link class="navbar-brand"
                :to="{ name: 'Home' }">
                Laravel
            </router-link>
            <button class="navbar-toggler"
                type="button"
                data-toggle="collapse"
                data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent"
                aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse"
                id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav mr-auto">
                    <li class="navbar-item">
                        <router-link :to="{ name: 'Games' }">
                            Games
                        </router-link>
                    </li>
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto">
                    <!-- Authentication Links -->
                    <li class="nav-item">
                        <a class="nav-link"
                            href="/login">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link"
                            href="/register">Register</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</template>

<script>
export default {}
</script>

<style scoped></style>
