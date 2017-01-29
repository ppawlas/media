class GasInvoicesService {
    constructor($http, Auth, FileSaver, Upload, AppConstants) {
        'ngInject';

        this._$http = $http;
        this._Auth = Auth;
        this._FileSaver = FileSaver;
        this._Upload = Upload;
        this._AppConstants = AppConstants;
    }

    index() {
        return this._$http({
            url: this._getBaseUrl(),
            method: 'GET'
        }).then(res => res.data);
    }

    show(id) {
        return this._$http({
            url: this._getBaseUrl(id),
            method: 'GET'
        }).then(res => res.data);
    }

    store(data) {
        return this._$http({
            url: this._getBaseUrl(),
            method: 'POST',
            data: data
        }).then(res => res.data);
    }

    update(id, data) {
        return this._$http({
            url: this._getBaseUrl(id),
            method: 'PUT',
            data: data
        }).then(res => res.data);
    }

    destroy(id) {
        return this._$http({
            url: this._getBaseUrl(id),
            method: 'DELETE'
        }).then(res => res.data);
    }

    dump() {
        return this._$http({
            url: this._getBaseUrl() + '/dump',
            method: 'GET',
            responseType: 'blob'
        }).then(res => {
            this._FileSaver.saveAs(res.data, 'gas-invoices.csv');
        });
    }

    restore(file, onSuccess, onError) {
        file.upload = this._Upload.upload({
            url: this._getBaseUrl() + '/restore',
            data: {dump: file}
        });

        file.upload.then(onSuccess, onError);
    }

    _getBaseUrl(id) {
        return this._AppConstants.api + '/users/' + this._Auth.current.id + '/gas-invoices' + (id ? '/' + id : '')
    }
}

export default GasInvoicesService;