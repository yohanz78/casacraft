console.log('____app.js');

const baseUrl = window.location.origin;
const apiHeaders = {
    headers: {
        "Accept": "*/*",
        "Access-Control-Allow-Origin": "*",
        // "Content-Type": "application/json",
        "Content-Type": "multipart/form-data",
    }
};

function randomIntFromInterval(min, max) {
    return Math.floor(Math.random() * (max - min + 1) + min);
}

function breakWord(text) {
    let array = text.split(' ');
    let len = 2;

    let newText = '';
    for (let i = 0; i < array.length; i++) {
        newText += array[i] + ' ';
        if (i % len == 0) {
            newText += '</br>';
        }
    }
    return newText;
}

function getCookie(name) {
    let value = `; ${document.cookie}`
    let parts = value.split(`; ${name} =`);

    if (parts.length === 2) {
        return parts.pop().split(';').shift();
    }
}

// AXIOS implementation for Logout with authorization
$("#logout-btn").on('click', function (e) {
    apiHeaders['headers']['Authorization'] = 'Bearer ' + getCookie('ut');
    let url = baseUrl + 'api/user/logout';

    axios.post(url, {}, apiHeaders)
    .then(function (response) {
        console.log('[DATA] response..', response.data)
        document.cookie = 'ue=';
        document.cookie = 'ut=';

        Swal.fire({
            position: "top-end",
            icon: "info",
            title: "Logout Successfully!",
            showConfirmButton: false,
            timer: 1500
        });
        setTimeout(function() {
            window.location=baseUrl
        }, 1500)
    })
    .catch(function (error) {
        console.log('[ERROR] response..', error);

        Swal.fire({
            position: "top-end",
            icon: "warning",
            title: "Failed to logout",
            html: error.response?error.response.data.message:error.message,
            showConfirmButton: false,
            timer: 5000
        });
    });
})

// AXIOS implementation for Login
$("#form-login-btn").on('click', function (e) {
    const form = document.getElementById('form-login');
    form.reportValidty();

    if (!form.checkValidity()) {
    } else {
        $('#form-login-error').html('');
        $('#form-login-loading').show();
        $('#form-loggin').hide();
        let url = baseUrl + '/api/user/login';
        let formData = new FormData(form);

        axios.post(url, formData, apiHeaders)
        .then(function (response) {
            console.log('[DATA] response..', response.data)
            document.cookie = 'ue=' + formData.get('email');
            document.cookie = 'ut=' + response.data.token;

            Swal.fire({
                position: "top-end",
                icon: "success",
                title: "Login Successfully!",
                showConfirmButton: false,
                timer: 1500
            });
            setTimeout(function() {
                window.location=baseUrl
            }, 1500)
        })
        .catch(function (error) {
            console.log('[ERROR] response..', error);
            $('#form-login-error').html(error.response?error.response.data.message:error.message);
            $('#form-login-loading').hide();
            $('#form-login').show();
        });
    }
});

// AXIOS implementation for Register
$("#form-register-btn").on('click', function (e) {
    const form = document.getElementById('form-register');
    form.reportValidty();
    if (!form.checkValidity()) {
    } else {
        $('#form-login-error').html('');
        $('#form-login-loading').show();
        $('#form-loggin').hide();
        let url = baseUrl + '/api/user/register';
        let formData = new FormData(form);

        axios.post(url, formData, apiHeaders)
        .then(function (response) {
            console.log('[DATA] response..', response.data)
            document.cookie = 'ue=' + formData.get('email');
            document.cookie = 'ut=' + response.data.token;

            Swal.fire({
                position: "top-end",
                icon: "success",
                title: "Registered Successfully! Log in automatically",
                showConfirmButton: false,
                timer: 1500
            });
            setTimeout(function() {
                window.location=baseUrl
            }, 1500)
        })
        .catch(function (error) {
            console.log('[ERROR] response..', error);
            $('#form-login-error').html(error.message);
            $('#form-login-loading').hide();
            $('#form-login').show();
        });
    }
});