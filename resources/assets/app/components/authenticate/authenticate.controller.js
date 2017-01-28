class AuthenticateController {
    constructor(Auth, Messages, $state) {
        'ngInject';

        this._Auth = Auth;
        this._Messages = Messages;
        this._$state = $state;
    }

    $onInit() {
        this.formData = {};
    }

    submitForm() {
        let credentials = {
            email: this.formData.email,
            password: this.formData.password
        };

        this._Auth.authenticate(credentials).then(
            // on success
            (res) => {
                this._Messages.setMessage('WELCOME');
                this._$state.go('app.authenticated.dashboard');
            },
            // on failure
            (err) => {
                this._Messages.showMessage('AUTHENTICATION_FAILED', 'error');
            }
        );
    }
}

export default AuthenticateController;