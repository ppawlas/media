function AppRun($state, $transitions, $window, Messages) {
    'ngInject';

    // show pending messages after state change success
    $transitions.onSuccess({}, () => {
        Messages.showMessages();
    });

    // if there was an error due to forbidden request, set message and redirect
    $transitions.onError({}, (trans) => {
        if (trans._error.status === 403) {
            Messages.setMessage('FORBIDDEN', 'error');
            $state.go('app.authenticate', {}, {reload: true});
        }
        if (trans._error.status === -1) {
            Messages.setMessage('NOT_FOUND', 'error');
            $state.go('app.authenticate', {}, {reload: true});
        }
    });

    // after successful state transition scroll to top
    $transitions.onSuccess({}, () => {
        $window.scrollTo(0, 0);
    });
}

export default AppRun;