class WaterReadingFormController {
    constructor(WaterReadings, Messages, $state) {
        'ngInject';

        this._Messages = Messages;
        this._WaterReadings = WaterReadings;
        this._$state = $state;
    }

    $onInit() {
        if (this.waterReading) {
            this.title = 'EDIT_READING';
            this.edit = true;
        } else {
            this.title = 'NEW_READING';
            this.edit = false;

            this.waterReading = {
                date: new Date(),
                fixed_usage: false
            };
        }
    }

    setDate($event) {
        this.waterReading.date = $event.dt;
    }

    submit() {
        if (this.edit) {
            this._WaterReadings.update(this.waterReading.id, this.waterReading).then(
                res => {
                    this._Messages.setMessage('READING_UPDATED', 'success');
                    this._$state.go('app.authenticated.water-readings.list', null, {reload: true})
                },
                err => {
                    this._Messages.showMessage('READING_UPDATE_ERROR', 'error');
                }
            );
        } else {
            this._WaterReadings.store(this.waterReading).then(
                res => {
                    this._Messages.setMessage('READING_CREATED', 'success');
                    this._$state.go('app.authenticated.water-readings.list', null, {reload: true})
                },
                err => {
                    this._Messages.showMessage('READING_CREATE_ERROR', 'error');
                }
            );
        }
    }
}

export default WaterReadingFormController;