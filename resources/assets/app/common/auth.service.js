class AuthService {
    constructor(JWT, AppConstants, Messages, $http, $state, $q) {
        'ngInject';

        this._JWT = JWT;
        this._AppConstants = AppConstants;
        this._Messages = Messages;
        this._$http = $http;
        this._$state = $state;
        this._$q = $q;

        // current user properties
        this.current = null;
    }

    /**
     * Attempt to authenticate user.
     *
     * @param credentials
     */
    authenticate(credentials) {
        return this._$http({
            url: this._AppConstants.api + '/authenticate/authenticate',
            method: 'POST',
            data: credentials
        }).then(
            // on success
            (res) => {
                // set the JWT token
                this._JWT.save(res.data.token);

                // store the user's information for easy lookup
                this.current = res.data.user;

                return res;
            }
        );
    }

    /**
     * Attempt to log out user.
     */
    logout() {
        this.current = null;
        this._JWT.destroy();
        this._Messages.setMessage('USER_LOGGED_OUT');
        // redirect to the authenticate state with hard reload
        this._$state.go('app.authenticate', {}, {reload: true});
    }

    /**
     * Verify if the user is authenticated.
     */
    verifyAuth() {
        let deferred = this._$q.defer();

        // check for the JWT token first
        if (!this._JWT.get()) {
            deferred.resolve(false);
            return deferred.promise;
        }

        // if there is a JWT and user is already set
        if (this.current) {
            deferred.resolve(true);
        } else {
            // if current user is not set, get him from the server
            // if server doesn't return 401, set current user and resolve promise
            this._$http({
                url: this._AppConstants.api + '/authenticate/authenticated',
                method: 'GET'
            }).then(
                (res) => {
                    this.current = res.data.user;
                    deferred.resolve(true);
                },
                // if an error happens, that means the user's token was invalid
                (err) => {
                    this._JWT.destroy();
                    deferred.resolve(false);
                }
            );
        }

        return deferred.promise;
    }

    /**
     * Ensure that user is authenticated.
     *
     * @returns {Promise}
     */
    isAuthenticated() {
        let deferred = this._$q.defer();

        this.verifyAuth().then((authenticated) => {
            if (!authenticated) {
                this._Messages.setMessage('ONLY_AUTHENTICATED_ALLOWED', 'error');
                // redirect to the authentication
                this._$state.go('app.authenticate');
                deferred.resolve(false);
            } else {
                deferred.resolve(true);
            }
        });

        return deferred.promise;
    }
}

export default AuthService;