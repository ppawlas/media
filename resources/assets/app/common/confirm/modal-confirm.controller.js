class ModalConfirmController {
    $onInit() {
        this.message = this.resolve.message; // set the confirm message
    }

    ok() {
        this.close(); // close the modal instance
    }

    cancel() {
        this.dismiss(); // dismiss the modal instance
    }
}

export default ModalConfirmController;