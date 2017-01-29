class GasInvoicesRestoreController {
    constructor($state, GasInvoices, Messages) {
        'ngInject';

        this._$state = $state;
        this._GasInvoices = GasInvoices;
        this._Messages = Messages;
    }

    restore(file) {
        this._GasInvoices.restore(
            file,
            res => {
                this._Messages.setMessage('DATA_IMPORTED', 'success');
                this._$state.go('app.authenticated.gas-invoices.list', {}, {reload: true});
            },
            err => {
                this._Messages.showMessage('DATA_IMPORT_ERROR', 'error');
            }
        );
    }
}

export default GasInvoicesRestoreController;