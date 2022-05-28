$(function(){
    $.get(`http://api.quotable.io/random`)
    .then(function(quote) {
        $('#quoteText').text(quote.content)
        $('#quoteAuthor').text(quote.author)
        $('#quoteLikes').text(quote.length)
    })
    .catch(() => {
        $('#quoteError').html(`An error occurred while performing this operation`)
    })
})