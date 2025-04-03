console.log("hello world.");

async function getBooks() {
    try {
        const response = await fetch('https://ytdwordpress1.local/wp-json/cra/v1/books');
        const data = await response.json();

        let books = data;
        console.log(books);

        return books;
    } catch (error) {
        console.error('Error fetching books:', error);
    }
}

getBooks();
