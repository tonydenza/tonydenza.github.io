function hideLoadingScreen() {
    const loadingScreen = document.getElementById('loading-screen');
    loadingScreen.style.opacity = 0;
    setTimeout(() => {
        loadingScreen.style.display = 'none';
    }, 1000);
}

document.addEventListener('DOMContentLoaded', () => {
    setTimeout(hideLoadingScreen, 3000);
});