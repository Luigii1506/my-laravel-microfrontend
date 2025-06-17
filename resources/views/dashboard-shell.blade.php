<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel Dashboard - Single-SPA Shell</title>
    <style>
    body {
        font-family: sans-serif;
        margin: 0;
        padding: 0;
        background-color: #f0f2f5;
    }

    #dashboard-header {
        background-color: #333;
        color: white;
        padding: 1rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    #dashboard-header nav ul {
        list-style: none;
        margin: 0;
        padding: 0;
        display: flex;
    }

    #dashboard-header nav li {
        margin-left: 1rem;
    }

    #dashboard-header nav a {
        color: white;
        text-decoration: none;
        padding: 0.5rem 1rem;
        border-radius: 5px;
        transition: background-color 0.3s ease;
    }

    #dashboard-header nav a:hover {
        background-color: #555;
    }

    main {
        padding: 2rem;
        background-color: white;
        margin: 1rem;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        min-height: 500px;
    }

    #dashboard-footer {
        text-align: center;
        padding: 1rem;
        color: #777;
        font-size: 0.9rem;
    }
    </style>
</head>

<body>

    <script>
    // Check if 'process' is already defined (e.g., by another script)
    if (typeof process === 'undefined') {
        window.process = {
            env: {
                NODE_ENV: 'production',
                // Add any other specific Next.js env vars that appear in your bundle
                // and were not replaced by Rollup. Check your 'out/single-spa-entry.js' for these.
                __NEXT_MANUAL_TRAILING_SLASH: false,
                __NEXT_ROUTER_BASEPATH: '',
                __NEXT_I18N_SUPPORT: false,
                __NEXT_MANUAL_CLIENT_BASE_PATH: '',
            },
            // Provide a mock for emit method, which you found.
            emit: function(eventName, ...args) {
                // console.warn('Mock process.emit called:', eventName, args); // Optional: for debugging
            },
            // Add other common properties/methods if they show up in errors later
            cwd: function() {
                return '/';
            },
            version: '',
            platform: 'browser',
            browser: true,
            // Add any other properties of 'process' that you found in the bundle if they cause errors
            // For example, if you see 'process.nextTick', you'd add:
            // nextTick: function(cb) { setTimeout(cb, 0); }
        };
    }
    // Also polyfill 'global' if it's referenced directly
    if (typeof global === 'undefined') {
        window.global = window;
    }
    </script>

    <div id="dashboard-header">
        <h1>Laravel Dashboard</h1>
        <nav>
            <ul>
                <li><a href="/">Home</a></li>
                <li><a href="/app">Mi Aplicación Next.js</a></li>
            </ul>
        </nav>
    </div>

    <main id="single-spa-application-container"></main>

    <div id="dashboard-footer">
        <p>&copy; {{ date('Y') }} Laravel Dashboard</p>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/systemjs@6.12.1/dist/system.min.js"></script>

    <script type="systemjs-importmap">
        {
        "imports": {
            "single-spa": "https://cdn.jsdelivr.net/npm/single-spa@5.9.0/lib/system/single-spa.min.js",
            "single-spa-react": "https://cdn.jsdelivr.net/npm/single-spa-react@5.0.0/lib/system/single-spa-react.min.js",
            "nextjs-app": "http://localhost:3001/single-spa-entry.js"
        }
    }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/single-spa@5.9.0/lib/system/single-spa.min.js"></script>

    <script>
    System.import('single-spa').then(function(singleSpa) {
        singleSpa.registerApplication({
            name: 'nextjs-app',
            app: () => System.import('nextjs-app'), // Esto carga tu microfrontend
            activeWhen: ['/app'], // La aplicación se activa cuando la ruta es /app
            customProps: {}
        });

        singleSpa.start();
    });
    </script>
</body>

</html>