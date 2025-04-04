// Saving the button that triggers the ajax request
const ajaxButton = document.getElementById("ajax-button");

ajaxButton.addEventListener("click", () => {
    const bookTableBody = document.querySelector("#bookTable tbody"); // select table body where we insert the books

    jQuery.ajax({
        url: ajax_obj.ajax_url,
        type: 'POST',
        data: {
            action:'get_books'
        },
        success: function(response) {
            // add a new cell for each field of book
            bookTableBody.innerHTML = response.data
                .map(book =>
                    `<tr>
                <td>${book.book_title}</td>
                <td>${book.book_author}</td>
                <td>${book.book_genre}</td>
                <td>${book.book_price}</td>
                <td>${book.book_publication_date}</td>
                <td>${book.book_rating}</td>
            </tr>`
                ).join('');
        }
    })
});
