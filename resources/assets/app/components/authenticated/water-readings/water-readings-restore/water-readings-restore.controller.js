class WaterReadingsRestoreController {
    constructor($state, WaterReadings, Messages) {
        'ngInject';

        this._$state = $state;
        this._WaterReadings = WaterReadings;
        this._Messages = Messages;
    }

    restore(file) {
        this._WaterReadings.restore(
            file,
            res => {
                this._Messages.setMessage('READING_IMPORTED', 'success');
                this._$state.go('app.authenticated.water-readings.list', {}, {reload: true});
            },
            err => {
                this._Messages.showMessage('READING_IMPORT_ERROR', 'error');
            }
        );
    }
}

export default WaterReadingsRestoreController;