class ReportService {
    constructor($http, Auth, AppConstants) {
        'ngInject';

        this._$http = $http;
        this._Auth = Auth;
        this._AppConstants = AppConstants;
    }

    aggregates() {
        return this._$http({
            url: this._AppConstants.api + '/users/' + this._Auth.current.id + '/reports/aggregates',
            method: 'GET'
        }).then(res => res.data);
    }
}

export default ReportService;