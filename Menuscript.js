// Fetch the list of documents from the server
fetch('getDocuments.php')
	.then(response => response.json())
	.then(data => {
		// Create a list of document links
		const documentsList = document.getElementById('documentsList');
		data.documents.forEach(document => {
			const li = document.createElement('li');
			const a = document.createElement('a');
			a.href = `download.php?id=${document.id}`;
			a.textContent = document.title;
			li.appendChild(a);
			documentsList.appendChild(li);
		});
	});

// Handle the form submission
const form = document.querySelector('form');
form.addEventListener('submit', event => {
	event.preventDefault();

	// Get the form data
	const formData = new FormData(form);

	// Send the form data to the server
	fetch('upload.php', {
		method: 'POST',
		body: formData
	})
		.then(response => response.json())
		.then(data => {
			// Add the new document to the list
			const documentsList = document.getElementById('documentsList');
			const li = document.createElement('li');
			const a = document.createElement('a');
			a.href = `download.php?id=${data.id}`;
			a.textContent = data.title;
			li.appendChild(a);
			documentsList.appendChild(li);
		});
});