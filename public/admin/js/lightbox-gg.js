function openLightbox(event) {
    closeLightbox();
    $('.main-section').append('<div id="theImg" class="lightbox-image" style="font-size:20px">' +
        '<a href="#" onclick="closeLightbox()" class="close-button"><div class="fa fa-close"></div></a></div>');
    $(new Image()).attr({'src': '' + $(event.target).attr("src"),"class":"inset-shadowed"}).prependTo($('#theImg'));
    $('#theImg').append('<div class="lightbox-desc">'+$(event.target).attr('alt')+'</div>');
    $('#theImg').animate({"opacity":"1"}, 500);
}
function closeLightbox()
{
    $('#theImg').animate({"opacity":"0"}, 200,function()
    {
        $("#theImg").remove();

    });
}