$(document).ready(function() {
    const urlArr = window.location.href.split('/');
    const lengthOfUrlArr = urlArr.length;
    const navigationPage = urlArr[lengthOfUrlArr - 1];
    $('.sidebar ul a').removeClass('sidebarActive');
    $(`.${navigationPage}`).addClass('sidebarActive');
    if ( 'dashboard' !== navigationPage ) {
        $('.dashboardActive').addClass('d-none');
        $('.dashboardDeactive').removeClass('d-none');
    }
})