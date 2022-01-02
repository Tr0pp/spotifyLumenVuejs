import Home from "../components/pages/Home";

let routes = [
    {
        name: 'home',
        path: '/',
        component: Home
    },
    // {
    //     path: '/',
    //     redirect: '/'
    // },
    // {
    //     name: 'movie',
    //     path: '/movie/:name',
    //     component: MovieDetails,
    //     props(route) {
    //         return { infoMovie: route.query.infoMovie }
    //     }
    // },
]

export default routes