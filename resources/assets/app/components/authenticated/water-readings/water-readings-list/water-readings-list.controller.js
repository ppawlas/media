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

    destroy(id) {
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

    dump() {
        this._WaterReadings.dump().then(
            res => {
                this._Messages.showMessage('DATA_EXPORTED', 'success');
            },
            err => {
                this._Messages.showMessage('DATA_EXPORT_ERROR', 'error');
            }
        )
    }
}

export default WaterReadingsListController;