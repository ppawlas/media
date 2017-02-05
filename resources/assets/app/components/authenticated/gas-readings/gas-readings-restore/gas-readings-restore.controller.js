class GasReadingsRestoreController {
    constructor($state, GasReadings, Messages) {
        'ngInject';

        this._$state = $state;
        this._GasReadings = GasReadings;
        this._Messages = Messages;
    }

    setFile($event) {
        this.dumpFile = $event.file;
    }

    restore(file) {
        this._GasReadings.restore(
            file,
            res => {
                this._Messages.setMessage('DATA_IMPORTED', 'success');
                this._$state.go('app.authenticated.gas-readings.list', {}, {reload: true});
            },
            err => {
                this._Messages.showMessage('DATA_IMPORT_ERROR', 'error');
            }
        );
    }
}

export default GasReadingsRestoreController;