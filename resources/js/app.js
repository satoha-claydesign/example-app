import './bootstrap.js';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

// Image form handler
window.inputFormHandler = () => {
    return {
        fields: [],
        addField() {
            const i = this.fields.length;
            this.fields.push({
                file: '',
                id: `input-image-${i}`,
            });
        },
        removeField(index) {
            this.fields.splice(index, 1);
        }
    }
}

Alpine.start();
