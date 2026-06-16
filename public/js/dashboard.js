const body = document.getElementById('body');

const themeButton =
document.getElementById('toggleTheme');

themeButton.addEventListener('click', () => {

    body.classList.toggle('dark-mode');

    localStorage.setItem(
        'theme',
        body.classList.contains('dark-mode')
    );
});

if(localStorage.getItem('theme') === 'true')
{
    body.classList.add('dark-mode');
}