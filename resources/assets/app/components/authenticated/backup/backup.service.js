class BackupService {
    constructor($http, Auth, FileSaver, Upload, AppConstants) {
        'ngInject';

        this._$http = $http;
        this._Auth = Auth;
        this._FileSaver = FileSaver;
        this._Upload = Upload;
        this._AppConstants = AppConstants;
    }

    create() {
        return this._$http({
            url: this._getBaseUrl() + '/create',
            method: 'GET',
            responseType: 'blob'
        }).then(res => {
            this._FileSaver.saveAs(res.data, 'dump.zip');
        });
    }

    restore(file, onSuccess, onError) {
        file.upload = this._Upload.upload({
            url: this._getBaseUrl() + '/restore',
            data: {dump: file}
        });

        file.upload.then(onSuccess, onError);
    }

    _getBaseUrl() {
        return this._AppConstants.api + '/users/' + this._Auth.current.id + '/backup';
    }
}

export default BackupService;