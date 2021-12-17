function toggleSidebar() {
    let sidebarSetting = document.querySelector('.mobile-nav');

    if (sidebarSetting.style.display == "block")
    {
        sidebarSetting.style.display = "none";
    }
    else {
        sidebarSetting.style.display = "block";
    }
}

$('.filter').on('click', function () {
    let filter = $(this).attr("data-filter");
   
    if ($(".filter").hasClass("active")) {
        $(".filter").removeClass("active");

        $('#academies > div').fadeIn();
    }
    else if (!$(".filter").hasClass("active")) {
        $('.filter[data-filter="'+filter+'"]').addClass("active");
        $('#academies > div').fadeOut();
        $('#academies > [data-filter="'+filter+'"]').fadeIn();
    }    
});