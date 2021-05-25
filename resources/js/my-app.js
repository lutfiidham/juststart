"use strict";

const KTApp = require("../metronic/js/components/app");

// Component Definition
var MyApp = (() => {
    return {
        blockPage: () => {
            const options = {
                overlayColor: "#000000",
                state: "primary",
                message: "Loading...",
                size: "lg"
            };
            return KTApp.blockPage(options);
        },
        unblockPage: () => KTApp.unblockPage(),
        initAjaxBlockPage: () => {
            $(document).ajaxStart(function() {
                MyApp.blockPage();
            });

            $(document).ajaxStop(function() {
                MyApp.unblockPage();
            });
        },
        alert: (
            title,
            message,
            type = "info",
            confirmCallback = null,
            confirmParameter = null
        ) => {
            var options = {
                title: title,
                text: message,
                icon: type,
                buttonsStyling: false,
                confirmButtonText: "Ok!",
                customClass: {
                    confirmButton: "btn btn-primary"
                }
            };
            return Swal.fire(options).then(result => {
                if (result.value) {
                    confirmCallback(confirmParameter);
                }
            });
        },
        confirm: (
            title,
            message,
            type = "question",
            confirmCallback = null,
            confirmParameter = null,
            cancelCallback = null,
            cancelParameter = null
        ) => {
            var options = {
                title: title,
                text: message,
                icon: type,
                showCancelButton: true,
                confirmButtonText: "Yes"
            };
            return Swal.fire(options).then(result => {
                if (result.value) {
                    confirmCallback(confirmParameter);
                } else if (result.dismiss === "cancel") {
                    cancelCallback(cancelParameter);
                }
            });
        },
        notify: (title, message, type = "primary") => {
            const icon = {
                primary: "la la-info-circle",
                success: "la la-check-circle",
                info: "la la-info-circle",
                warning: "la la-warning",
                danger: "la la-times-circle",
                dark: "la la-info-circle"
            };
            let content = {
                title: title,
                message: message
                // icon: "icon " + icon[type]
            };
            return $.notify(content, {
                type: type,
                allow_dismiss: true,
                newest_on_top: true,
                mouse_over: false,
                showProgressbar: false,
                spacing: 10,
                timer: 2500,
                placement: {
                    from: "top",
                    align: "right"
                },
                offset: {
                    x: 30,
                    y: 30
                },
                delay: 1000,
                z_index: 10000,
                animate: {
                    enter: "animate__animated animate__fadeInDown",
                    exit: "animate__animated animate__fadeOutDown"
                }
            });
        },
        ajax: (method, url, data = null, callback = null) => {
            MyApp.blockPage();
            $.ajax({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
                },
                type: method,
                url: url,
                data: data,
                contentType:
                    data instanceof FormData
                        ? false
                        : "application/x-www-form-urlencoded",
                processData: !(data instanceof FormData),
                dataType: "JSON",
                success: function(response) {
                    if (callback) {
                        callback(response);
                    }
                },
                error: function(response, status, error) {
                    const json = response.responseJSON;
                    MyApp.alert("Error", json.message, "error");
                }
            }).always(function() {
                MyApp.unblockPage();
            });
        },
        ajaxGet: (url, data = null, callback = null) => {
            MyApp.ajax("GET", url, data, callback);
        },
        ajaxPost: (url, data = null, callback = null) => {
            MyApp.ajax("POST", url, data, callback);
        },
        ajaxPut: (url, data = null, callback = null) => {
            MyApp.ajax("PUT", url, data, callback);
        },
        ajaxDelete: (url, data = null, callback = null) => {
            MyApp.ajax("DELETE", url, data, callback);
        }
    };
})();

// webpack support
if (typeof module !== "undefined" && typeof module.exports !== "undefined") {
    module.exports = MyApp;
}
