document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('form');

    form.addEventListener('submit', function(event) {
        if(!validateForm()) {
            event.preventDefault();
        }
    });

    function validateForm(){
        const firstName = document.getElementById('firstName').value;
        const lastName = document.getElementById('lastName').value;
        const email = document.getElementById('email').value;
        const address = document.getElementById('address').value;
        const city = document.getElementById('city').value;
        const country = document.getElementById('country').value;
        const postalCode = document.getElementById('postalCode').value;
        const phoneNumber = document.getElementById('phoneNumber').value;
        const comments = document.getElementById('comments').value;

        if(firstName==''||lastName==''||email==''||address==''||city==''||country==''||postalCode==''||phoneNumber==''||comments==''){
            alert('Please fill out all fields.');
            return false;
        }

        return true;
    }
});
