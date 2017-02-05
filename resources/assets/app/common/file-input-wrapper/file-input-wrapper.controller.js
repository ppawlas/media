import angular from "angular";

class FileInputWrapperController {
    /**
     * On Click and Space or Enter key press trigger the click event on the actual hidden file input.
     *
     * @param $event
     */
    onWrapperClick($event) {
        if (($event.type === 'click') || ($event.code === 'Enter') || ($event.code === 'Space')) {
            $event.stopPropagation();
            document.querySelector('#' + this.inputId).click();
        }
    }

    /**
     * After each change, if there is an event handler defined, emmit new event containing file object.
     */
    onChange() {
        if (this.onFileChange) {
            this.onFileChange({
                $event: {
                    file: this.file
                }
            });
        }
    }
}

export default FileInputWrapperController;