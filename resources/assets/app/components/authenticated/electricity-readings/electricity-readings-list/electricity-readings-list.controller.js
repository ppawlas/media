import angular from "angular";

class ElectricityReadingsListController {
    constructor(ElectricityReadings, Messages) {
        'ngInject';

        this._Messages = Messages;
        this._ElectricityReadings = ElectricityReadings;
    }

    $onInit() {
        this.table = {
            electricityReadings: angular.copy(this.electricityReadings)
        }
    }

    destroy(id) {
        this._ElectricityReadings.destroy(id).then(
            res => {
                this._Messages.showMessage('READING_DELETED', 'success');
                this._ElectricityReadings.index().then(res => this.electricityReadings = res);
            },
            err => {
                this._Messages.showMessage('READING_DELETE_ERROR', 'error');
            }
        );
    }

    dump() {
        this._ElectricityReadings.dump().then(
            res => {
                this._Messages.showMessage('DATA_EXPORTED', 'success');
            },
            err => {
                this._Messages.showMessage('DATA_EXPORT_ERROR', 'error');
            }
        )
    }
}

export default ElectricityReadingsListController;