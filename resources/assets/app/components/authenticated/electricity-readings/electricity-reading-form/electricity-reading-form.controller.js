class ElectricityReadingFormController {
    constructor(ElectricityReadings, Messages, $state) {
        'ngInject';

        this._Messages = Messages;
        this._ElectricityReadings = ElectricityReadings;
        this._$state = $state;
    }

    $onInit() {
        if (this.electricityReading) {
            this.title = 'EDIT_READING';
            this.edit = true;
        } else {
            this.title = 'NEW_READING';
            this.edit = false;

            this.electricityReading = {
                date: new Date(),
                fixed_usage: false
            };
        }
    }

    setDate($event) {
        this.electricityReading.date = $event.dt;
    }

    submit() {
        if (this.edit) {
            this._ElectricityReadings.update(this.electricityReading.id, this.electricityReading).then(
                res => {
                    this._Messages.setMessage('READING_UPDATED', 'success');
                    this._$state.go('app.authenticated.electricity-readings.list', null, {reload: true})
                },
                err => {
                    this._Messages.showMessage('READING_UPDATE_ERROR', 'error');
                }
            );
        } else {
            this._ElectricityReadings.store(this.electricityReading).then(
                res => {
                    this._Messages.setMessage('READING_CREATED', 'success');
                    this._$state.go('app.authenticated.electricity-readings.list', null, {reload: true})
                },
                err => {
                    this._Messages.showMessage('READING_CREATE_ERROR', 'error');
                }
            );
        }
    }
}

export default ElectricityReadingFormController;