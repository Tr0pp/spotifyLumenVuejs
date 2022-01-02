import Auth from "../components/pages/Auth";

let routes = [
    {
        name: 'auth',
        path: '/',
        component: Auth
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