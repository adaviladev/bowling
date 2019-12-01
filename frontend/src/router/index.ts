import Vue from "vue";
import VueRouter from "vue-router";
import Home from "../views/Home.vue";
import GameList from "@/components/GameList.vue";
import GameShow from "@/views/PageGameShow.vue";
import GameCreate from "@/views/PageGameCreate.vue";

Vue.use(VueRouter);

const routes = [
    {
        path: "/",
        name: "Home",
        component: Home
    },
    {
        path: "/games",
        name: "Games",
        // route level code-splitting
        // this generates a separate chunk (about.[hash].js) for this route
        // which is lazy-loaded when the route is visited.
        component: GameList,
        props: true
    },
    {
        path: "/games/create",
        name: "GameCreate",
        component: GameCreate
    },
    {
        path: "/games/:id",
        name: "GameShow",
        component: GameShow,
        props: true
    }
];

const router = new VueRouter({
    mode: "history",
    base: process.env.BASE_URL,
    routes
});

export default router;
