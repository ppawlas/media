class NavbarController {
    constructor(Auth) {
        'ngInject';

        this._Auth = Auth;
    }

    $onInit() {
        this.collapse();
    }

    collapse() {
        this.isNavCollapsed = true;
    }

    logout() {
        this._Auth.logout();
    }
}

export default NavbarController;