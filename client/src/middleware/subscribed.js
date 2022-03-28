export default function auth ({next, store}) {
    if(!store.getters['auth/user'].subscribed) {
        return next({
            name: 'home'
        })
    }
    return next()
}
