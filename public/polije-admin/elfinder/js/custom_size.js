$(document).on("dialogopen", ".dialogelfinder", function () {
    let $dialog = $(this);

    // resize dialog
    $dialog.dialog("option", {
        width: $(window).width() - 60,
        height: $(window).height() - 80,
        position: { my: "center", at: "center", of: window },
        resizable: true,
    });

    // paksa resize isi elFinder
    setTimeout(function () {
        $dialog.find(".ui-dialog-content").css({
            width: "100%",
            height: $dialog.height() - 45 + "px",
        });

        $dialog.find(".elfinder").css({
            width: "100%",
            height: "100%",
        });

        // trigger internal resize elFinder
        $(window).trigger("resize");
    }, 100);
});
