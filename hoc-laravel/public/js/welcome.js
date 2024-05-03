function changeStatus() {
    var submodal = document.getElementById('sub-modal');
    var input = document.querySelector('input[type=submit]');
    var formSignIn = document.getElementById('form-sign-in');
    var formSignUp = document.getElementById('form-sign-up');
    function sleep(ms) {
        return new Promise(function (resolve) {
            setTimeout(resolve, ms);
        });
    }
    if (input.value === 'ĐĂNG KÝ') {
        sleep(0)
            .then(function () {
                submodal.classList.add('slide-right');
                submodal.classList.remove('slide-left');
                formSignIn.style.display = 'none';
                return sleep(400)
            }).then(function () {
                formSignUp.style.display = 'flex';
                formSignUp.classList.add('show');
                document.querySelector('.modal').style.boxShadow = '-16px 9px 8px -6px rgba(0, 0, 0, .1)';
            });
        input.value = 'ĐĂNG NHẬP';
        document.getElementById('sign-up-btn').innerText = 'Đăng ký';
    }
    else {
        sleep(0)
            .then(function () {
                submodal.classList.add('slide-left');
                submodal.classList.remove('slide-right');
                formSignUp.style.display = 'none';
                return sleep(400)
            }).then(function () {
                formSignIn.style.display = 'flex';
                formSignIn.classList.add('show');
                document.querySelector('.modal').style.boxShadow = '16px 9px 8px -6px rgba(0, 0, 0, .1)';
            });
        input.value = 'ĐĂNG KÝ';

    }
}