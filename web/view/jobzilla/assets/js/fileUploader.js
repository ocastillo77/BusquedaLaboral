class FileUploader {
    constructor(button, options) {
        this.button = document.getElementById(button);
        this.settings = Object.assign({
            action: 'upload.php', // URL del script de carga
            name: 'userfile',     // Nombre del archivo en el formulario
            data: {},             // Datos adicionales a enviar
            autoSubmit: true,     // Si el archivo se sube al seleccionarlo
            allowedTypes: ['pdf', 'doc', 'jpg'], // Tipos permitidos
            onChange: () => { },   // Callback al seleccionar el archivo
            onSubmit: () => { },   // Callback antes de subir el archivo
            onComplete: () => { }  // Callback al completar la subida
        }, options);

        this.createInput();
        this.bindEvents();
    }
    createInput() {
        this.input = document.createElement("input");
        this.input.setAttribute('type', 'file');
        this.input.setAttribute('name', this.settings.name);
        this.input.style.display = 'none';
        document.body.appendChild(this.input);
    }
    bindEvents() {
        this.button.addEventListener('click', () => this.input.click());
        this.input.addEventListener('change', (event) => this.onChange(event));
    }
    onChange(event) {
        const file = event.target.files[0];
        const ext = file.name.split('.').pop().toLowerCase();

        if (!this.settings.allowedTypes.includes(ext)) {
            alert(`Formato no permitido: ${ext}`);
            return;
        }

        if (this.settings.onChange(file, ext) !== false && this.settings.autoSubmit) {
            this.submit();
        }
    }
    submit() {
        const formData = new FormData();
        formData.append(this.settings.name, this.input.files[0]);

        for (let key in this.settings.data) {
            formData.append(key, this.settings.data[key]);
        }

        fetch(this.settings.action, {
            method: 'POST',
            body: formData
        })
            .then(response => response.text())
            .then(response => this.settings.onComplete(this.input.files[0].name, response))
            .catch(error => console.error('Error al subir:', error));
    }
}
