class GasInvoiceFormController {
    constructor(GasInvoices, Messages, $state) {
        'ngInject';

        this._Messages = Messages;
        this._GasInvoices = GasInvoices;
        this._$state = $state;
    }

    $onInit() {
        if (this.gasInvoice) {
            this.title = 'EDIT_INVOICE';
            this.edit = true;
        } else {
            this.title = 'NEW_INVOICE';
            this.edit = false;

            this.gasInvoice = {
                date: new Date(),
                fixed_usage: false
            };
        }
    }

    setDate($event) {
        this.gasInvoice.date = $event.dt;
    }

    submit() {
        if (this.edit) {
            this._GasInvoices.update(this.gasInvoice.id, this.gasInvoice).then(
                res => {
                    this._Messages.setMessage('INVOICE_UPDATED', 'success');
                    this._$state.go('app.authenticated.gas-invoices.list', null, {reload: true})
                },
                err => {
                    this._Messages.showMessage('INVOICE_UPDATE_ERROR', 'error');
                }
            );
        } else {
            this._GasInvoices.store(this.gasInvoice).then(
                res => {
                    this._Messages.setMessage('INVOICE_CREATED', 'success');
                    this._$state.go('app.authenticated.gas-invoices.list', null, {reload: true})
                },
                err => {
                    this._Messages.showMessage('INVOICE_CREATE_ERROR', 'error');
                }
            );
        }
    }
}

export default GasInvoiceFormController;