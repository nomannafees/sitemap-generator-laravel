$(document).ready(function () {
    $("form").submit(function (e) {
        e.preventDefault();
        let form = $(this);
        let formData = form.serialize();
        let submitButton = form.find("button[type='submit']");
        submitButton.prop("disabled", true);
        Swal.fire({
            title: 'Generating Sitemap...',
            html: '<b>Please wait...</b>',
            allowOutsideClick: false,
            didOpen: () => {
                Swal.showLoading();
            }
        });
        $.post(form.attr("action"), formData, function (response) {
            checkSitemapStatus();
        }).fail(function () {
            Swal.fire('Error!', 'Failed to start sitemap generation!', 'error');
            submitButton.prop("disabled", false);
        });
    });
    function checkSitemapStatus() {
        $.get("/check-sitemap-status", function (response) {
            if (response.status === "done") {
                Swal.fire({
                    icon: "success",
                    title: "Your sitemap is ready for download!",
                    showConfirmButton: true
                });
                let submitButton =$("button[type='submit']");
                submitButton.prop("disabled", false);
                $("#downloadBtn").show();
            } else {
                setTimeout(checkSitemapStatus, 5000);
            }
        });
    }
});
