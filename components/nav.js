fetch('/navigation-data')
  .then(response => response.json())
  .then(data => {
    const navTemplate = document.getElementById('nav-placeholder');
    navTemplate.innerHTML = Mustache.render(`{{> nav}}`, data);
  });
