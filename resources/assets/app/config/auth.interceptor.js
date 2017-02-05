function authInterceptor(JWT, AppConstants, $window, $q) {
    'ngInject';

    return {
        // automatically attach Authorization header
        request: function (config) {
            if (config.url.indexOf(AppConstants.api) === 0 && JWT.get()) {
                config.headers.Authorization = 'Bearer ' + JWT.get();
            }
            return config;
        },

        // handle and 400 401
        responseError: function (rejection) {
            if ((rejection.status === 400) || (rejection.status === 401)) {
                // clear any JWT token being stored
                JWT.destroy();
                if (!rejection.config.url.endsWith('/authenticate/authenticate')) {
                    // if response came from action different than authentication, do a hard refresh
                    $window.location.reload();
                }
            }
            return $q.reject(rejection);
        }
    }
}

export default authInterceptor;