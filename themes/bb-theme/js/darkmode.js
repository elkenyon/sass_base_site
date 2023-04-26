if (window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches) {
    console.log('DARK')
    document.html.dataset.theme = "dark"
}else{
    console.log('Light')
    document.html.dataset.theme = "light"
}