document.addEventListener('DOMContentLoaded', () => {
  const pagesList = document.getElementById('pages-list');
  const editForm = document.getElementById('edit-form');

  if (pagesList) {
    fetch('data/pages.json')
      .then(response => response.json())
      .then(data => {
        Object.keys(data).forEach(page => {
          const pageLink = document.createElement('a');
          pageLink.href = `edit.html?title=${page}`;
          pageLink.textContent = page;
          pagesList.appendChild(pageLink);
          pagesList.appendChild(document.createElement('br'));
        });
      });
  }

  if (editForm) {
    const urlParams = new URLSearchParams(window.location.search);
    const titleParam = urlParams.get('title');
    const titleInput = document.getElementById('title');
    const contentTextarea = document.getElementById('content');

    if (titleParam) {
      titleInput.value = titleParam;
      fetch('data/pages.json')
        .then(response => response.json())
        .then(data => {
          if (data[titleParam]) {
            contentTextarea.value = data[titleParam].content;
          }
        });
    }

    editForm.addEventListener('submit', (e) => {
      e.preventDefault();
      const updatedPage = {
        title: titleInput.value,
        content: contentTextarea.value
      };

      fetch('data/pages.json')
        .then(response => response.json())
        .then(data => {
          data[updatedPage.title] = { content: updatedPage.content };
          return fetch('data/pages.json', {
            method: 'POST',
            headers: {
              'Content-Type': 'application/json'
            },
            body: JSON.stringify(data, null, 2)
          });
        })
        .then(() => {
          window.location.href = 'index.html';
        });
    });
  }
});
