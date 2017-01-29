import angular from "angular";

class GasInvoicesListController {
    constructor(GasInvoices, Messages) {
        'ngInject';

        this._Messages = Messages;
        this._GasInvoices = GasInvoices;
    }

    $onInit() {
        this.table = {
            gasInvoices: angular.copy(this.gasInvoices)
        }
    }

    destroy(id) {
        this._GasInvoices.destroy(id).then(
            res => {
                this._Messages.showMessage('INVOICE_DELETED', 'success');
                this._GasInvoices.index().then(res => this.gasInvoices = res);
            },
            err => {
                this._Messages.showMessage('INVOICE_DELETE_ERROR', 'error');
            }
        );
    }

    dump() {
        this._GasInvoices.dump().then(
            res => {
                this._Messages.showMessage('DATA_EXPORTED', 'success');
            },
            err => {
                this._Messages.showMessage('DATA_EXPORT_ERROR', 'error');
            }
        )
    }
}

export default GasInvoicesListController;