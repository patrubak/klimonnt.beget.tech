document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('login-form');
    if (!form) return;
    
    form.addEventListener('submit', function(event) {
        event.preventDefault(); // Предотвращаем стандартную отправку формы
        
        const usernameInput = document.getElementById('username');
        const passwordInput = document.getElementById('password');
        const errorMessage = document.createElement('p');
        
        let isValid = true;
        
        // Простая проверка на пустые поля
        if(usernameInput.value.trim().length === 0 || passwordInput.value.trim().length === 0){
            errorMessage.textContent = 'Заполните все поля!';
            form.appendChild(errorMessage);
            isValid = false;
        }
        
        if(isValid){
            this.submit(); // Отправляем форму, если всё нормально
        }
    });
});