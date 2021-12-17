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