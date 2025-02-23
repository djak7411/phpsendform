<div class="form-container">
    <span class="error"></span>
    <form id="auth_form">
        <label for="email">Email*</label>
        <label for="password">Пароль*</label>
        <label for="confirm_password">Подтвердите пароль*</label>
        <div class="hint hint-hide">Неверный формат email</div>
        <input type="email" id="email"/>
        <input type="password" id="password"/>
        <input type="password" id="confirm_password"/>
        <button id="send_creds" disabled>Submit</button>
    </form>
</div>
<script>
    const EMAIL_REGEXP = /^(([^<>()[\].,;:\s@"]+(\.[^<>()[\].,;:\s@"]+)*)|(".+"))@(([^<>()[\].,;:\s@"]+\.)+[^<>()[\].,;:\s@"]{2,})$/iu;

    function isEmailValid(value) {
        return EMAIL_REGEXP.test(value);
    }

    $('#email').on('change', function () {
        const $hint = $('.hint');
        const $sendButton = $('#send_creds');
        if (isEmailValid(this.val())) {
            $sendButton.removeAttr('disabled');
            $hint.addClass('hint-hide');
        }else{
            $sendButton.attr('disabled', true);
            $hint.removeClass('hint-hide');
        }
    });

    $('#send_creds').on('click', () => {
        const email = $('#email').val(),
              pass = $.md5($('#password').val()),
              confirm = $.md5($('#confirm_password').val());
        const $errorArea = $('.error'),
              $form = $('#auth_form'),
              $container = $('.form-container');

        if(pass === confirm){
            $.ajax({
                type: 'POST',
                data: {
                    email,
                    pass,
                    confirm
                },
                success: (data) => {
                    $container.html(`Успешная регистрация пользователя ${email}`);
                },
                error: (, status, error) => {
                    $errorArea.val(error);
                }
            });
        }else {
            $errorArea.val('Введенные пароли не совпадают');
        }
    });
</script>