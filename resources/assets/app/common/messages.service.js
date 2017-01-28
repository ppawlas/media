class MessagesService {
    constructor(Notification, $translate) {
        'ngInject';

        this._Notification = Notification;
        this._$translate = $translate;

        // set empty messages dictionary
        this.messages = {};
    }

    /**
     * Set message to be shown after next state change.
     * Message will be translated.
     * Accepted message types:
     *  primary (default), error, success, information, warning
     *
     * @param messageContent
     * @param messageType
     */
    setMessage(messageContent, messageType = 'primary') {
        this._$translate(messageContent).then(translation => {
            this.messages[messageType] = translation;
        });
    }

    /**
     * Show translated message.
     * Accepted message types:
     *  primary (default), error, success, information, warning
     *
     * @param messageContent
     * @param messageType
     */
    showMessage(messageContent, messageType = 'primary') {
        this._$translate(messageContent).then(translation => {
            this._Notification({message: translation}, messageType);
        });
    }

    /**
     * Show all pending messages.
     */
    showMessages() {
        for (let messageType in this.messages) {
            if (this.messages.hasOwnProperty(messageType)) {
                this._Notification({message: this.messages[messageType]}, messageType);
                delete this.messages[messageType];
            }
        }
    }
}

export default MessagesService;