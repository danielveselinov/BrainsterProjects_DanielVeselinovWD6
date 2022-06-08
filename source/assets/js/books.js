import { success, danger, path } from './modules.js'
$(function () {

    $('#createBookModalBtn').on('click', function() {
        $('#modal-load').load(path + 'source/layouts/books.modal.php', { modal: "createBookModal" }, function() {
            $('#createBookModal').modal('show')
        })
    })

    $('body').on('click', '#createBookAction', function() {
        // let 

        $.post(path + 'source/actions/Category/update.php', {
            process: 'bookCreate'
        }).then((response) => {
            let data = JSON.parse(response)

            if (data.auth) {
                success('You have successfully created new book')
                $('#books_list').load(location.href + ' #books_list');
            } else if (!data.auth && data.message) {
                danger(`${data.message}`)
            }
        }).catch((err) => {
            let data = JSON.parse(err.responseText)
            danger(`${data.message}`)
        })
    })

})