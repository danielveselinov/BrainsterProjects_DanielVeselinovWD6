import { path, success, danger, formatDate } from './modules.js'
$(function() {

    $('#addMyNoteAction').on('click', function() {
        $('#new_note').fadeToggle()
    })

    $('#createMyNoteAction').on('click', function() {
        let user = $(this).attr('data-user-id')
        let book_code = $(this).attr('data-book-code')
        let note = $('#newNote').val()

        $.post(path + 'source/actions/Note/create.php', {
            process: 'noteCreate', user, note, book_code
        })
        .then((response) => {
            let data = JSON.parse(response)

            if (data.auth) {
                success('You have successfully added new note')
                $('#newNote').val('')
                $('#ajax').append(`
                <div class="accordion mt-2" id="accordion">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="heading">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse">
                            Note # - ${formatDate(new Date())}
                            </button>
                        </h2>
                        <div id="collapse" class="accordion-collapse collapse" data-bs-parent="#accordion">
                            <div class="accordion-body">
                                <div class="form-floating">
                                    <textarea class="form-control" placeholder="Leave a note here" id="noteContent" style="height: 100px; resize: none;">${note}</textarea>
                                    <label for="noteContent">Leave a note here</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                `)
                $('#new_note').fadeToggle()
            } else if (!data.auth && data.message) {
                danger(`${data.message}`)
            }
        }).catch((err) => {
            let data = JSON.parse(err)
            danger(`${data.message}`)
        })
    })

    $('#updateMyNoteAction').on('click', function() {

    })

    $('#deleteMyNoteAction').on('click', function() {

    })
})