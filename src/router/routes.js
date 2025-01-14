import Main from 'layouts/Main'
import Users from 'pages/Users'

const routes = [
    {
        path: '/',
        component: Main,
        children: [
            // users page
            {
                path: '/',
                component: Users
            }
        ]
    }
]
