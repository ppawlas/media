import angular from "angular";

class WaterReadingsListController {
    constructor(WaterReadings, Messages) {
        'ngInject';

        this._Messages = Messages;
        this._WaterReadings = WaterReadings;
    }

    $onInit() {
        this.table = {
            waterReadings: angular.copy(this.waterReadings)
        }
    }

    delete(id) {
        this._WaterReadings.destroy(id).then(
            res => {
                this._Messages.showMessage('READING_DELETED', 'success');
                this._WaterReadings.index().then(res => this.waterReadings = res);
            },
            err => {
                this._Messages.showMessage('READING_DELETE_ERROR', 'error');
            }
        );
    }
}

export default WaterReadingsListController;