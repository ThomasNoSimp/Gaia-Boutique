const form = document.querySelector('.form');
const fullName = document.querySelector('#name');
const email = document.querySelector('#email');
const address = document.querySelector('#address');
const creditCardOption = document.querySelector('#credit_card');

form.addEventListener('submit', (event) => {
    event.preventDefault();

    if (fullName.value.trim() !== '' && email.value.trim() !== '' && address.value.trim() !== '' && creditCardOption.value.trim() !== '') {
        if (!/^[a-zA-Z ]+$/.test(fullName.value.trim())) {
            alert('Please enter a valid name');
            return;
        }
        else if (!/^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/.test(email.value.trim())) {
            alert('Please enter a valid email address');
            return;
        }
        else if (!/^[#.0-9a-zA-Z\s,-]+$/.test(address.value.trim())) {
            alert('Please enter a valid address');
            return;
        }
        else {
            window.location.href = 'payment.php';
        }
    }
    else {
        alert('Please fill in all fields');
    }
});
