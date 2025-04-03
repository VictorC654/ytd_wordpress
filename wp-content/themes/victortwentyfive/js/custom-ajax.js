const ajaxButton = document.getElementById("ajax-button");

ajaxButton.addEventListener("click", async function () {
    try {
        const bookTableBody = document.querySelector('#bookTable tbody');
        bookTableBody.innerHTML = '';
        let limit = 5;
        const response = await fetch(ajax_obj.ajax_url, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: new URLSearchParams({
                action: 'get_books',
                limit: 5
            })
        });

        let { success, data: books } = await response.json();

        if(success)
        {
            bookTableBody.innerHTML = books
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
    } catch (error) {
        console.error('Error getting books:', error);
    }
});
