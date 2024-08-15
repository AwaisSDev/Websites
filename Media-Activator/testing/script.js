const body = document.querySelector('body'),
    sidebar = body.querySelector('nav.sidebar'),
    toggle = body.querySelector(".toggle"),
    modeSwitch = body.querySelector(".toggle-switch"),
    modeText = body.querySelector(".mode-text");

toggle.addEventListener("click", () => {
    sidebar.classList.toggle("close");
    sidebar.classList.toggle("open");
});

modeSwitch.addEventListener("click", () => {
    body.classList.toggle("dark");

    if (body.classList.contains("dark")) {
        modeText.innerText = "Light mode";
    } else {
        modeText.innerText = "Dark mode";
    }
});

// Function to show the selected page
function showPage(pageId) {
  // Hide all pages
  let pages = document.querySelectorAll('.page');
  pages.forEach(page => {
      page.classList.remove('active');
  });

  // Show the selected page
  let selectedPage = document.getElementById(pageId);
  if (selectedPage) {
      selectedPage.classList.add('active');
  }
}
