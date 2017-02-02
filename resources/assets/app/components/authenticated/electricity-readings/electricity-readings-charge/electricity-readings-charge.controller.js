class ElectricityReadingsChargeController {
    constructor(ElectricityReadings, Messages, $state) {
        'ngInject';

        this._Messages = Messages;
        this._ElectricityReadings = ElectricityReadings;
        this._$state = $state;
    }

    $onInit() {
        this.chrageComponents = [
            {symbol: 'component_c', token: 'COMPONENT_C'},
            {symbol: 'component_ssvn', token: 'COMPONENT_SSVN'},
            {symbol: 'component_szvnk', token: 'COMPONENT_SZVNK'},
            {symbol: 'component_sop', token: 'COMPONENT_SOP'},
            {symbol: 'component_sosj', token: 'COMPONENT_SOSJ'},
            {symbol: 'component_os', token: 'COMPONENT_OS'},
        ];
    }

    submit() {
        this._ElectricityReadings.setCharge(this.electricityCharge).then(
            res => {
                this._Messages.setMessage('CHARGE_UPDATED', 'success');
                this._$state.go('app.authenticated.electricity-readings.list', null, {reload: true})
            },
            err => {
                this._Messages.showMessage('CHARGE_UPDATE_ERROR', 'error');
            }
        );
    }
}

export default ElectricityReadingsChargeController;