class WaterReadingsRestoreController {
    constructor($state, WaterReadings, Messages) {
        'ngInject';

        this._$state = $state;
        this._WaterReadings = WaterReadings;
        this._Messages = Messages;
    }

    setFile($event) {
        this.dumpFile = $event.file;
    }

    restore(file) {
        this._WaterReadings.restore(
            file,
            res => {
                this._Messages.setMessage('DATA_IMPORTED', 'success');
                this._$state.go('app.authenticated.water-readings.list', {}, {reload: true});
            },
            err => {
                this._Messages.showMessage('DATA_IMPORT_ERROR', 'error');
            }
        );
    }
}

export default WaterReadingsRestoreController;