class WaterReadingsService {
    constructor($http, Auth, AppConstants) {
        'ngInject';

        this._$http = $http;
        this._Auth = Auth;
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

    _getBaseUrl(id) {
        return this._AppConstants.api + '/users/' + this._Auth.current.id + '/water-readings' + (id ? '/' + id : '')
    }
}

export default WaterReadingsService;