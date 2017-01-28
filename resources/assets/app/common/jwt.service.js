class JWTService {
    constructor(AppConstants, $window) {
        'ngInject';

        this._AppConstants = AppConstants;
        this._$window = $window;
    }

    /**
     * Save token in local storage.
     *
     * @param token
     */
    save(token) {
        this._$window.localStorage[this._AppConstants.jwtKey] = token;
    }

    /**
     * Get token from local storage.
     *
     * @returns {*}
     */
    get() {
        return this._$window.localStorage[this._AppConstants.jwtKey];
    }

    /**
     * Remove token from local storage.
     *
     */
    destroy() {
        this._$window.localStorage.removeItem(this._AppConstants.jwtKey);
    }
}

export default JWTService;