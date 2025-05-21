document.addEventListener('DOMContentLoaded', function() {
    const codeTextarea = document.querySelector('textarea[name="code"]');
    if(codeTextarea) {
        codeTextarea.addEventListener('input', function() {
            this.style.height = 'auto';
            this.style.height = (this.scrollHeight) + 'px';
        });
    }
});