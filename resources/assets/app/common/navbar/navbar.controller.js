class NavbarController {
    constructor(Auth) {
        'ngInject';

        this._Auth = Auth;
    }

    logout() {
        this._Auth.logout();
    }
}

export default NavbarController;