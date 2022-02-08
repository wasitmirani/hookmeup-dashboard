import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)

function setComponent(path_file) {
    const route_path = "./components/backend/" + path_file + "Component.vue";
    return import ("" + route_path);
}

const routes = [{
        path: '/',
        component: () => setComponent("dashboard/Home"),
        name: "dashboard",
    },
    {
        path: '/articles',
        component: () => setComponent("content/article/Articles"),
        name: "stripe",
    },
    {
        path: "/new/article",
        component: () => setComponent("content/article/CreateArticle")
    },
    {
        path: "/update/article/:id",
        component: () => setComponent("content/article/CreateArticle")
    },
    {
        path: "/blogs",
        component: () => setComponent("content/blog/Blogs")

    },
    {
        path: "/new/blog",
        component: () => setComponent("content/blog/CreateBlog")
    },
    {
        path: "/update/blog/:id",
        component: () => setComponent("content/blog/CreateBlog")
    },
    {
        path: "/events",
        component: () => setComponent("content/event/Events")

    },
    {
        path: "/new/event",
        component: () => setComponent("content/event/CreateEvent")
    },
    {
        path: "/update/event/:id",
        component: () => setComponent("content/event/CreateEvent")
    },

    {
        path: "/users",
        component: () => setComponent("user/Users")

    },
    {
        path: "/new/event",
        component: () => setComponent("user/Users")
    },
    {
        path: "/update/event/:id",
        component: () => setComponent("user/Users")
    },
    {
        path: "/categories",
        component: () => setComponent("Category/categories")
    },



]

// 3. Create the router instance and pass the `routes` option
// You can pass in additional options here, but let's
// keep it simple for now.
const router = new VueRouter({
    routes,

    // short for `routes: routes`
})




export default router;
