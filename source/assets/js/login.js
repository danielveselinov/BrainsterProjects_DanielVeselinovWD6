import { path } from './modules.js'
$(function() {    
    $('#signInAction').on('click', function(e) {
        e.preventDefault()

        let email = $('#email').val()
        let password = $('#password').val()

        $.post(path + 'source/actions/Auth/login.php', {
            process: 'authLogin', email, password
        })
        .then(function(response) {
            let data = JSON.parse(response)

            if (data.auth) {
                alert(data.auth)
            } else {
                alert(data.auth)
                // $('#email').addClass('is-invalid')
                // $('#password').addClass('is-invalid')
                // $('#validationServerEmailAddress').text('Wrong credentials')
                // $('#validationServerPassword').text('Wrong credentials')
            }
        })
        .catch(function(err) {
            console.log(err)
        })
    })
})