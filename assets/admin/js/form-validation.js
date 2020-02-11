/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$(document).ready(function () {
    $.validator.addMethod('filesize', function (value, element, param) {
        // alert(element.files[0].size);
        return this.optional(element) || (element.files[0].size <= param)
    });
    //custom validation rule
    $.validator.addMethod("customemail",
            function (value, element) {
                return /^\w+([-+.']\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/.test(value);
            });

    $.validator.addMethod('decimal', function (value, element) {
        return this.optional(element) || /^((\d+(\\.\d{0,2})?)|((\d*(\.\d{1,2}))))$/.test(value);
    }, "");

    var link = $('body').data('baseurl');


    if ($("#ValidationLogin").length > 0) {
        $("#ValidationLogin").validate({
            rules: {

                email: {
                    required: true,
                    email: true,
                    maxlength: 50,
                    customemail: true
                },
                password: {
                    required: true,
                    maxlength: 20,
                    minlength: 6
                },

            },
            messages: {

                email: {
                    required: "Please enter email address.",
                    email: "Please enter valid email address.",
                    maxlength: "The email address should be less than or equal to 50 characters.",
                    customemail: "Please enter valid email."
                },
                password: {
                    required: "Please enter password.",
                    maxlength: "The Password should be between 6 to 20 characters. "
                },

            },
//            highlight: function (element, errorClass, validClass) {
//                $(element).parents(".form-group").addClass("has-error").removeClass("has-success");
//                //$(element).next("span").addClass("glyphicon-remove").removeClass("glyphicon-ok");
//            },
//            unhighlight: function (element, errorClass, validClass) {
//                $(element).parents(".form-group").addClass("has-success").removeClass("has-error");
//                //$(element).next("span").addClass("glyphicon-ok").removeClass("glyphicon-remove");
//            }
        });
    }

   
    if ($("#changePasswordValidations").length > 0) {
        $("#changePasswordValidations").validate({
            rules: {
                old_password: {
                    required: true,
                    maxlength: 20,
                    minlength: 6
                },

                new_password: {
                    required: true,
                    maxlength: 20,
                    minlength: 6
                },
                c_password: {
                    required: true,
                    maxlength: 20,
                    minlength: 6,
                    equalTo: "#passwordvalidation"
                }
            },
            messages: {

                old_password: {
                    required: "Please enter old password.",
                    maxlength: "The old password should be between 6 to 20 characters. ",
                    minlength: "The old password should be atleast 6 characters. "
                },

                new_password: {
                    required: "Please enter new password.",
                    maxlength: "The new password should be between 6 to 20 characters. ",
                    minlength: "The new password should be atleast 6 characters. "
                },

                c_password: {
                    required: "Please enter confirm password.",
                    maxlength: "The confirm password should be between 6 to 20 characters. ",
                    minlength: "The new password should be atleast 6 characters. ",
                    equalTo: "Password should be same."
                },

            },
//            highlight: function (element, errorClass, validClass) {
//                $(element).parents(".form-group").addClass("has-error").removeClass("has-success");
//                //$(element).next("span").addClass("glyphicon-remove").removeClass("glyphicon-ok");
//            },
//            unhighlight: function (element, errorClass, validClass) {
//                $(element).parents(".form-group").addClass("has-success").removeClass("has-error");
//                //$(element).next("span").addClass("glyphicon-ok").removeClass("glyphicon-remove");
//            }
        });
    }
 


    if ($("#profileFormValidations").length > 0) {
        $("#profileFormValidations").validate({
            rules: {
                name: {
                    required: true,
                    maxlength: 50
                },
                contact_number: {
                    required: true,
                    integer: true,
                    maxlength: 12,
                    minlength: 10,
                    /* remote: {
                        type: 'post',
                        url: link + 'admin/ajax/check_mobile',
                        data: {
                            'email': function () {
                                return $('#contact_number').val()
                            },
                            'tbl': 'users',
                            'id': $('#adminId').val(),
                        },
                        dataType: 'json'
                    }*/

                },

                email: {
                    required: true,
                    email: true,
                    maxlength: 50,
                    customemail: true,
                   /*  remote: {
                        type: 'post',
                        url: link + 'admin/ajax/check_email',
                        data: {
                            'email': function () {
                                return $('#email').val()
                            },
                            'tbl': 'users',
                            'id': $('#adminId').val(),
                        },
                        dataType: 'json'
                    }*/

                },
                address: {
                    required: true,
                    maxlength: 200
                },

                admin_images: {
                    required: function (element) {
                        return $("#old_path").val() == '';
                    },
                    extension: "png|jpe?g|bmp",
                    filesize: 2048576
                },

            },
            messages: {

                name: {
                    required: "Please enter name.",
                    maxlength: "The name should less than or equal to 50 characters. "
                },
                contact_number: {
                    required: "Please enter contact number.",
                    integer: "Please enter only number",
                    maxlength: "The contact number should less than or equal to 12 characters. ",
                    minlength: "The contact number atleast 10 characters. ",
                    remote: "Contact number already exist."
                },

                email: {
                    required: "Please enter email address.",
                    customemail: "Please enter valid email.",
                    email: "Please enter a valid email address.",
                    remote: "Email already exits."
                },
                address: {
                    required: "Please enter address .",
                    maxlength: "The address should less than or equal to 150 characters. "
                },

                admin_images: {
                    required: "Please select employee image.",
                    extension: "File must be PNG,JPG,BMP image format only.",
                    filesize: "File must be PNG,JPG,BMP and less than 2MB"
                },

            },
//            highlight: function (element, errorClass, validClass) {
//                $(element).parents(".form-group").addClass("has-error").removeClass("has-success");
//                // $(element).next("span").addClass("glyphicon-remove").removeClass("glyphicon-ok");
//            },
//            unhighlight: function (element, errorClass, validClass) {
//                $(element).parents(".form-group").addClass("has-success").removeClass("has-error");
//                // $(element).next("span").addClass("glyphicon-ok").removeClass("glyphicon-remove");
//            }
        });
    }
  
  if ($("#usersForm").length > 0) {
        $("#usersForm").validate({
            rules: {
                name: {
                    required: true,
                    maxlength: 50
                },
                userId: {
                    required: true,
                    maxlength: 10,
                    minlength: 6,
                    remote: {
                        type: 'post',
                        url: link + 'admin/ajax/check_sponsered',
                        data: {
                            'userId': function () {
                                return $('#userId').val()
                            },
                            'tbl': 'users',
                            'id': $('#usersId').val(),
                        },
                        dataType: 'json'
                    }
                },
                contact_number: {
                    required: true,
                    integer: true,
                    maxlength: 12,
                    minlength: 10,
                    /*   remote: {
                        type: 'post',
                        url: link + 'admin/ajax/check_mobile',
                        data: {
                            'email': function () {
                                return $('#contact_number').val()
                            },
                            'tbl': 'users',
                            'id': $('#usersId').val(),
                        },
                        dataType: 'json'
                    }*/

                },

                email: {
                    required: true,
                    email: true,
                    maxlength: 50,
                    customemail: true,
                    /*   remote: {
                        type: 'post',
                        url: link + 'admin/ajax/check_email',
                        data: {
                            'email': function () {
                                return $('#email').val()
                            },
                            'tbl': 'users',
                            'id': $('#usersId').val(),
                        },
                        dataType: 'json'
                    } */

                },
                address: {
                    required: true,
                    maxlength: 200
                },


                /*profile_picture: {
                    required: function (element) {
                        return $("#old_path").val() == '';
                    },
                    extension: "png|jpe?g|bmp",
                    filesize: 2048576
                },*/

                password: {
                    required: true,
                    maxlength: 20,
                    minlength: 6
                },
                confirm_password: {
                    required: true,
                    maxlength: 20,
                    minlength: 6,
                    equalTo: "#password"
                }

            },
            messages: {

                name: {
                    required: "Please enter name.",
                    maxlength: "The name should less than or equal to 50 characters. "
                },
                userId: {
                    required: "Please enter Users Id.",
                    maxlength: "Thev User Id should less than or equal to 10 characters. ",
                    minlength: "The contact number atleast 6 characters. ",
                    remote: "User Id already exist."
                },
                contact_number: {
                    required: "Please enter contact number.",
                    integer: "Please enter only number",
                    maxlength: "The contact number should less than or equal to 12 characters. ",
                    minlength: "The contact number atleast 10 characters. ",
                   /*   remote: "Contact number already exist." */
                },

                email: {
                    required: "Please enter email address.",
                    customemail: "Please enter valid email.",
                    email: "Please enter a valid email address.",
                   /*   remote: "Email already exits."*/
                },
                address: {
                    required: "Please enter address .",
                    maxlength: "The address should less than or equal to 150 characters. "
                },

                /*profile_picture: {
                    required: "Please select employee image.",
                    extension: "File must be PNG,JPG,BMP image format only.",
                    filesize: "File must be PNG,JPG,BMP and less than 2MB"
                },*/
                password: {
                    required: "Please enter new password.",
                    maxlength: "The new password should be between 6 to 20 characters. ",
                    minlength: "The new password should be atleast 6 characters. "
                },

                confirm_password: {
                    required: "Please enter confirm password.",
                    maxlength: "The confirm password should be between 6 to 20 characters. ",
                    minlength: "The new password should be atleast 6 characters. ",
                    equalTo: "Password should be same."
                },

            },

        });
    }


    if ($("#chngPassValidations").length > 0) {
        $("#chngPassValidations").validate({
            rules: {
                password: {
                    required: true,
                    maxlength: 20,
                    minlength: 6
                },
                cpassword: {
                    required: true,
                    maxlength: 20,
                    minlength: 6,
                    equalTo: "#password"
                }
            },
            messages: {
                password: {
                    required: "Please enter password.",
                    maxlength: "The password should be between 6 to 20 characters. ",
                    minlength: "The password should be atleast 6 characters. "
                },

                cpassword: {
                    required: "Please enter confirm password.",
                    maxlength: "The confirm password should be between 6 to 20 characters. ",
                    minlength: "The new password should be atleast 6 characters. ",
                    equalTo: "Password should be same."
                },

            },

        });
    }


    if ($("#levelForm").length > 0) {
        $("#levelForm").validate({
            rules: {
                team: {
                    required: true,
                },
               
            },
            messages: {
                team: {
                    required: "Please enter team.",
                   },
                },

        });
    }


if ($("#newsForm").length > 0) {
    $("#newsForm").validate({
        rules: {
            title: {
                required: true,
                maxlength: 100,
            },
            description: {
                required: true,
            }
        },
        messages: {
            title: {
                required: "Please enter title.",
                maxlength: "The title should be greater than or equal to 100 characters. ",
            },

            description: {
                required: "Please enter confirm password.",
            },

        },

    });
}

if ($("#pinGeneratForm").length > 0) {
    $("#pinGeneratForm").validate({
        rules: {
            /*pin_value: {
                required: true,
                maxlength: 10,
                remote: {
                        type: 'post',
                        url: link + 'admin/ajax/check_pin_value',
                        data: {
                            'pin_value': function () {
                                return $('#pin_value').val()
                            },
                            'tbl': 'user_pin',
                            'id': $('#pin_id').val(),
                        },
                        dataType: 'json'
                    }
            },*/
            quantity: {
                required: true,
                integer : true,
                digits : true,
                maxlength : 3,
                minlength : 1,
            },
            userId: {
                required: true,
            }
        },
        messages: {
            /*pin_value: {
                required: "Please enter a pin value",
                maxlength: "The pin value should be greater than or equal to 10 characters. ",
                remote : "Pin generate already exist."
            },*/
            quantity: {
                required: "Please enter a quantity",
                integer : "Please enter only digits",
                digits : "Please enter only digits",
                maxlength: "The quantity should be greater than or equal to 3 characters. ",
                minlength: "The quantity atleast 1 characters. ",
            },
            userId: {
                required: "Select a user",
            },

        },

    });
}


});