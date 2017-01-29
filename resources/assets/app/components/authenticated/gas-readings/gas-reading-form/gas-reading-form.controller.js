class GasReadingFormController {
    constructor(GasReadings, Messages, $state) {
        'ngInject';

        this._Messages = Messages;
        this._GasReadings = GasReadings;
        this._$state = $state;
    }

    $onInit() {
        if (this.gasReading) {
            this.title = 'EDIT_READING';
            this.edit = true;
        } else {
            this.title = 'NEW_READING';
            this.edit = false;

            this.gasReading = {
                date: new Date(),
                fixed_usage: false
            };
        }
    }

    setDate($event) {
        this.gasReading.date = $event.dt;
    }

    submit() {
        if (this.edit) {
            this._GasReadings.update(this.gasReading.id, this.gasReading).then(
                res => {
                    this._Messages.setMessage('READING_UPDATED', 'success');
                    this._$state.go('app.authenticated.gas-readings.list', null, {reload: true})
                },
                err => {
                    this._Messages.showMessage('READING_UPDATE_ERROR', 'error');
                }
            );
        } else {
            this._GasReadings.store(this.gasReading).then(
                res => {
                    this._Messages.setMessage('READING_CREATED', 'success');
                    this._$state.go('app.authenticated.gas-readings.list', null, {reload: true})
                },
                err => {
                    this._Messages.showMessage('READING_CREATE_ERROR', 'error');
                }
            );
        }
    }
}

export default GasReadingFormController;