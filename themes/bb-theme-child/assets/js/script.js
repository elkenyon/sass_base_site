
document.addEventListener("DOMContentLoaded", function(){
    if (window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches) {
        console.log('DARK')
        document.documentElement.setAttribute('data-theme', 'dark')
    }else{
        console.log('Light')
        document.documentElement.setAttribute('data-theme', 'light');
    }
})

// if (localStorage.getItem('data-theme') === 'dark') {

//     document.body.classList.add('dark-mode');
    
// }