class BackupController {
    constructor($state, Backup, Messages) {
        'ngInject';

        this._$state = $state;
        this._Backup = Backup;
        this._Messages = Messages;
    }

    create() {
        this._Backup.create().then(
            res => {
                this._Messages.showMessage('DATA_EXPORTED', 'success');
            },
            err => {
                this._Messages.showMessage('DATA_EXPORT_ERROR', 'error');
            }
        )
    }

    restore(file) {
        this._Backup.restore(
            file,
            res => {
                this._Messages.setMessage('DATA_IMPORTED', 'success');
                this._$state.go('app.authenticated.dashboard', {}, {reload: true});
            },
            err => {
                this._Messages.showMessage('DATA_IMPORT_ERROR', 'error');
            }
        );
    }
}

export default BackupController;