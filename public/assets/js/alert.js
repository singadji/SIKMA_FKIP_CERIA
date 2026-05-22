//== Class definition
var SweetAlert2Demo = (function () {
    //== Demos
    var initDemos = function () {
        //== Sweetalert Demo 1
        $("#alert_demo_1").click(function (e) {
            swal("Good job!", {
                buttons: {
                    confirm: {
                        className: "btn btn-success",
                    },
                },
            });
        });

        //== Sweetalert Demo 2
        $("#alert_demo_2").click(function (e) {
            swal("Here's the title!", "...and here's the text!", {
                buttons: {
                    confirm: {
                        className: "btn btn-success",
                    },
                },
            });
        });

        //== Sweetalert Demo 3
        $("#alert_demo_3_1").click(function (e) {
            swal("Good job!", "You clicked the button!", {
                icon: "warning",
                buttons: {
                    confirm: {
                        className: "btn btn-warning",
                    },
                },
            });
        });

        $("#alert_demo_3_2").click(function (e) {
            swal("Good job!", "You clicked the button!", {
                icon: "error",
                buttons: {
                    confirm: {
                        className: "btn btn-danger",
                    },
                },
            });
        });

        $("#alert_demo_3_3").click(function (e) {
            swal("Good job!", "You clicked the button!", {
                icon: "success",
                buttons: {
                    confirm: {
                        className: "btn btn-success",
                    },
                },
            });
        });

        $("#alert_demo_3_4").click(function (e) {
            swal("Good job!", "You clicked the button!", {
                icon: "info",
                buttons: {
                    confirm: {
                        className: "btn btn-info",
                    },
                },
            });
        });

        //== Sweetalert Demo 4
        $("#alert_demo_4").click(function (e) {
            swal({
                title: "Good job!",
                text: "You clicked the button!",
                icon: "success",
                buttons: {
                    confirm: {
                        text: "Confirm Me",
                        value: true,
                        visible: true,
                        className: "btn btn-success",
                        closeModal: true,
                    },
                },
            });
        });

        $("#alert_demo_5").click(function (e) {
            swal({
                title: "Input Something",
                html: '<br><input class="form-control" placeholder="Input Something" id="input-field">',
                content: {
                    element: "input",
                    attributes: {
                        placeholder: "Input Something",
                        type: "text",
                        id: "input-field",
                        className: "form-control",
                    },
                },
                buttons: {
                    cancel: {
                        visible: true,
                        className: "btn btn-danger",
                    },
                    confirm: {
                        className: "btn btn-success",
                    },
                },
            }).then(function () {
                swal("", "You entered : " + $("#input-field").val(), "success");
            });
        });

        $("#alert_demo_6").click(function (e) {
            swal("This modal will disappear soon!", {
                buttons: false,
                timer: 3000,
            });
        });

        $(document).on("click", ".btn-delete", function (e) {
            e.preventDefault();

            let url = $(this).data("url");

            swal({
                title: "Anda yakin?",
                text: "Anda akan menghapus data!",
                icon: "warning",
                buttons: {
                    confirm: {
                        text: "Ya, hapus!",
                        className: "btn btn-success",
                    },
                    cancel: {
                        visible: true,
                        className: "btn btn-danger",
                        text: "Batal",
                    },
                },
            }).then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        url: url,
                        type: "POST",
                        data: {
                            _method: "DELETE",
                            _token: $('meta[name="csrf-token"]').attr(
                                "content",
                            ),
                        },
                        success: function (response) {
                            swal({
                                title: "Terhapus!",
                                text:
                                    response.message ||
                                    "Data berhasil dihapus.",
                                icon: "success",
                                buttons: {
                                    confirm: {
                                        className: "btn btn-success",
                                    },
                                },
                            }).then(() => {
                                location.reload();
                            });
                        },
                        error: function (xhr) {
                            swal(
                                "Error!",
                                "Data tidak dapat dihapus.",
                                "error",
                            );
                        },
                    });
                } else {
                    swal.close();
                }
            });
        });

        $(document).on("click", ".btn-publish-toggle", function (e) {
            e.preventDefault();

            let url = $(this).data("url");

            swal({
                title: "Apakah Anda yakin?",
                text: "Status akan diubah!",
                icon: "warning",
                buttons: {
                    confirm: {
                        text: "Ya, update!",
                        className: "btn btn-success",
                    },
                    cancel: {
                        visible: true,
                        text: "Batal",
                        className: "btn btn-danger",
                    },
                },
            }).then((willUpdate) => {
                if (willUpdate) {
                    $.ajax({
                        url: url,
                        type: "PATCH", // ✅ FIX
                        data: {
                            _token: $('meta[name="csrf-token"]').attr(
                                "content",
                            ),
                        },

                        success: function (response) {
                            swal({
                                title: "Berhasil!",
                                text:
                                    response.message ||
                                    "Status berhasil diubah.",
                                icon: "success",
                            }).then(() => {
                                location.reload();
                            });
                        },

                        error: function () {
                            swal("Error!", "Update gagal.", "error");
                        },
                    });
                }
            });
        });

        $("#alert_demo_8").click(function (e) {
            swal({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                type: "warning",
                buttons: {
                    cancel: {
                        visible: true,
                        text: "No, cancel!",
                        className: "btn btn-danger",
                    },
                    confirm: {
                        text: "Yes, delete it!",
                        className: "btn btn-success",
                    },
                },
            }).then((willDelete) => {
                if (willDelete) {
                    swal("Poof! Your imaginary file has been deleted!", {
                        icon: "success",
                        buttons: {
                            confirm: {
                                className: "btn btn-success",
                            },
                        },
                    });
                } else {
                    swal("Your imaginary file is safe!", {
                        buttons: {
                            confirm: {
                                className: "btn btn-success",
                            },
                        },
                    });
                }
            });
        });

        $("#btn-flag-toggle").click(function (e) {
            e.preventDefault();

            let url = $(this).data("url");

            swal({
                title: "Apakah Anda yakin?",
                text: "Status flag akan diubah!",
                icon: "warning",
                buttons: {
                    confirm: {
                        text: "Ya, update!",
                        className: "btn btn-success",
                    },
                    cancel: {
                        visible: true,
                        text: "Batal",
                        className: "btn btn-danger",
                    },
                },
            }).then((willUpdate) => {
                if (willUpdate) {
                    $.ajax({
                        url: url,
                        type: "GET", // sesuai route kamu
                        success: function () {
                            swal({
                                title: "Updated!",
                                text: "Status flag berhasil diubah.",
                                icon: "success",
                                buttons: {
                                    confirm: {
                                        className: "btn btn-success",
                                    },
                                },
                            }).then(() => {
                                location.reload();
                            });
                        },
                        error: function () {
                            swal("Error!", "Update gagal.", "error");
                        },
                    });
                } else {
                    swal.close();
                }
            });
        });

        $(document).on("click", ".btn-setMenu-toggle", function (e) {
            e.preventDefault();

            let url = $(this).data("url");
            let text = $(this).data("text");

            swal({
                title: "Apakah Anda yakin?",
                text: text,
                icon: "warning",
                buttons: {
                    confirm: {
                        text: "Ya, set menu!",
                        className: "btn btn-success",
                    },
                    cancel: {
                        visible: true,
                        text: "Batal",
                        className: "btn btn-danger",
                    },
                },
            }).then((willUpdate) => {
                if (willUpdate) {
                    $.ajax({
                        url: url,
                        type: "GET",
                        success: function (response) {
                            swal({
                                title: "Berhasil!",
                                text: response.message,
                                icon: "success",
                                buttons: {
                                    confirm: {
                                        className: "btn btn-success",
                                    },
                                },
                            }).then(() => {
                                location.reload();
                            });
                        },
                        error: function (xhr) {
                            let msg = "Gagal menjadikan menu utama!";
                            if (xhr.responseJSON && xhr.responseJSON.message) {
                                msg = xhr.responseJSON.message;
                            }
                            swal({
                                title: "Error!",
                                text: msg,
                                icon: "error",
                                buttons: {
                                    confirm: {
                                        className: "btn btn-danger",
                                    },
                                },
                            });
                        },
                    });
                } else {
                    swal.close();
                }
            });
        });
    };

    return {
        //== Init
        init: function () {
            initDemos();
        },
    };
})();

//== Class Initialization
jQuery(document).ready(function () {
    SweetAlert2Demo.init();
});
