<?= '<script>
    jQuery(document).ready(function() {
        $("' . $validator['selector'] . '").each(function() {
            $(this).validate({
                errorElement: "span",
                errorClass: "invalid-feedback",
                errorPlacement: function(error, element) {
                    error.appendTo(element.parents("div.form-group"));
                    // if (element.parent(".input-group").length ||
                    //     element.prop("type") === "checkbox" || element.prop("type") === "radio") {
                    //     error.insertAfter(element.parent());
                    // } else {
                    //     error.insertAfter(element);
                    // }
                },
                highlight: function(element) {
                    $(element).closest(".form-control").addClass("is-invalid"); // add the Bootstrap error class to the control group
                },
                ' . ((isset($validator['ignore']) && is_string($validator['ignore'])) ? 'ignore: "' . $validator['ignore'] . '",' : '') . '
                unhighlight: function(element) {
                    $(element).closest(".form-control").removeClass("is-invalid");
                },
                success: function(element) {
                    $(element).closest(".form-control").removeClass("is-invalid"); // remove the Boostrap error class from the control group
                },
                focusInvalid: true,
                ' . ((Config::get('jsvalidation.focus_on_error')) ? '
                    invalidHandler: function(form, validator) {
                        if (!validator.numberOfInvalids())
                            return;
                        $("html, body").animate({
                            scrollTop: $(validator.errorList[0].element).offset().top - 175
                        }, ' . Config::get('jsvalidation.duration_animate') . ');
                        $(validator.errorList[0].element).focus();
                    },' : '') . '
                rules: ' . json_encode($validator['rules']) . ',
            });

            $(this).on("submit", function(e) {
                e.preventDefault();
            });
        });
    });
</script>';
