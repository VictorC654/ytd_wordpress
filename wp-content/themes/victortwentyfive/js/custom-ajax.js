// Saving the button that triggers the ajax request
const ajaxButton = document.getElementById("ajax-button");

ajaxButton.addEventListener("click", async function () {
    try {

        // Getting the table body and resetting it everytime the "ajaxButton" button is pressed
        const bookTableBody = document.querySelector('#bookTable tbody');
        bookTableBody.innerHTML = '';

        const response = await fetch(ajax_obj.ajax_url, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: new URLSearchParams({
                action: 'get_books',
                limit: 1 // the number that will be used for the post_per_page query argument, default is 5
            })
        });

        // JSON response is { "success"(bool), "data": [...](books array] },
        const responseData = await response.json();

        if(responseData.success)
        {
            // creating a new table cell for each book field
            bookTableBody.innerHTML = responseData.data
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
        } else {
            // displaying a message in case there are no books
            bookTableBody.innerHTML = `
                <tr>
                    <td colspan="6" class="error-message">
                        Failed to load books. Please try again later.
                    </td>
                </tr>`;
        }
    } catch (error) {
        console.error('Error getting books:', error);
    }
});
