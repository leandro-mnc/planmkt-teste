export default class FormErrorHelper {
    constructor(form, fieldIds) {
        this.form = form;
        this.fieldIds = fieldIds;
        this.fields = [];
        this.fieldsHelp = [];
        this.loadFields();
    }

    setErrors(errors) {
        Object.keys(errors).forEach((error, index) => {
            this.setClassName(this.fieldsHelp[error], 'invalid-feedback');
            this.fieldsHelp[error].innerHTML = errors[error].join('<br/>');
        });
        this.setFormWasValidatedClass(true);
    }

    cleanErrors() {
        this.setFormWasValidatedClass(false);

        Object.keys(this.fields).forEach((fieldId) => {

            this.fieldsHelp[fieldId].innerHTML = '';
            this.removeClassName(this.fieldsHelp[fieldId], 'invalid-feedback');
        });
    }

    loadFields() {
        this.fieldIds.forEach((fieldId) => {
            this.fields[fieldId] = document.getElementById(fieldId);
            this.fieldsHelp[fieldId] = document.getElementById(fieldId + 'Help');
        });
    }

    setFormWasValidatedClass(set) {
        if (set === true) {
            this.setClassName(this.form, 'was-validated');
        } else {
            this.removeClassName(this.form, 'was-validated');
        }
    }

    setClassName(el, className) {
        let hasClassName = false;
        let classes = el.className.split(' ');

        if (classes[0] === '') {
            classes = [];
        }

        classes.forEach((item) => {
            if (item === className) {
                hasClassName = true;
            }
        });

        if (hasClassName === false) {
            classes.push(className);
        }

        el.className = classes.join(' ');
    }

    removeClassName(el, className) {
        const newClasses = [];
        const classes = el.className.split(' ');

        classes.forEach((item) => {
            if (item !== className) {
                newClasses.push(item);
            }
        });

        if (newClasses.length < 1) {
            el.removeAttribute('class');
        } else {
            el.className = newClasses.join(' ');
        }
    }
}
