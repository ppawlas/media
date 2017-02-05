class ElectricityReadingsRestoreController {
    constructor($state, ElectricityReadings, Messages) {
        'ngInject';

        this._$state = $state;
        this._ElectricityReadings = ElectricityReadings;
        this._Messages = Messages;
    }

    setFile($event) {
        this.dumpFile = $event.file;
    }

    restore(file) {
        this._ElectricityReadings.restore(
            file,
            res => {
                this._Messages.setMessage('DATA_IMPORTED', 'success');
                this._$state.go('app.authenticated.electricity-readings.list', {}, {reload: true});
            },
            err => {
                this._Messages.showMessage('DATA_IMPORT_ERROR', 'error');
            }
        );
    }
}

export default ElectricityReadingsRestoreController;