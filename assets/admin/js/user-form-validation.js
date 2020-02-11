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
                    /*email: true,
                    maxlength: 50,
                    customemail: true*/
                },
                password: {
                    required: true,
                    maxlength: 20,
                    minlength: 6
                },

            },
            messages: {

                email: {
                    required: "Please enter user Id.",
                    /*email: "Please enter valid email address.",
                    maxlength: "The email address should be less than or equal to 50 characters.",
                    customemail: "Please enter valid email."*/
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
                   /*  remote: {
                        type: 'post',
                        url: link + 'user/ajax/check_mobile',
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
                    /* remote: {
                        type: 'post',
                        url: link + 'user/ajax/check_email',
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
  
  if ($("#bankForm").length > 0) {
        $("#bankForm").validate({
            rules: {
                account_holder_name: {
                    required: true,
                    maxlength: 50
                },
                account_number: {
                    required: true,
                    maxlength: 25,
                    integer : true,
                    digits : true,
                    remote: {
                        type: 'post',
                        url: link + 'user/ajax/check_account_number',
                        data: {
                            'account_number': function () {
                                return $('#account_number').val()
                            },
                            'tbl': 'bank_account',
                            'id': $('#bankId').val(),
                        },
                        dataType: 'json'
                    }

                },
                bank_name: {
                    required: true,
                    maxlength: 100,
                },

                branch_location: {
                    required: true,
                },
                ifsc_number: {
                    required: true,
                    maxlength: 20
                },
                pan_number: {
                    required: true,
                    maxlength:20
                },

            },
            messages: {

                account_holder_name: {
                    required: "Please enter account holder name.",
                    maxlength: "The name should less than or equal to 50 characters. "
                },
                account_number: {
                    required: "Please enter account number.",
                    maxlength: "The account number should less than or equal to 25 characters. ",
                    remote: "Account number already exist.",
                    integer: "Please enter only number",
                    digits: "Please enter only number",
                    
                },
                bank_name: {
                    required: "Please enter bank name.",
                    maxlength: "The bank name should less than or equal to 12 characters. ",
                    remote: "Contact number already exist."
                },

                branch_location: {
                    required: "Please enter branch location.",
                    
                },
                ifsc_number: {
                    required: "Please enter ifcs number .",
                    maxlength: "The ifcs number should less than or equal to 20 characters. "
                },
                pan_number: {
                    required: "Please enter pan number .",
                    maxlength: "The pan number should less than or equal to 20 characters. "
                },
            },

        });
    }


if ($("#activateIdForm").length > 0) {
    $("#activateIdForm").validate({
        rules: {
            userId: {
                required: true,
                maxlength :12,
                remote: {
                        type: 'post',
                        url: link + 'user/ajax/check_member_id',
                        data: {
                            'userId': function () {
                                return $('#userId').val()
                            },
                            'tbl': 'users',
                        },
                        dataType: 'json'
                    }
            },
            pin_value: {
                required: true,
                maxlength: 10,
                remote: {
                        type: 'post',
                        url: link + 'user/ajax/check_activate_id',
                        data: {
                            'pin_value': function () {
                                return $('#pin_value').val()
                            },
                            'tbl': 'user_pin',
                        },
                        dataType: 'json'
                    }
            },
            
        },
        messages: {
            userId: {
                required: "Please enter a user id",
                maxlength: "The user  id should be greater than or equal to 12 characters. ",
                remote : "Please enter the correct user id"
            },
            pin_value: {
                required: "Please enter a pin value",
                maxlength: "The pin value should be greater than or equal to 10 characters. ",
                remote : "Please enter the correct pin value"
            },

           

        },

    });
}

    if ($("#transferForm").length > 0) {
    $("#transferForm").validate({
        rules: {
            userId: {
                required: true,
                maxlength: 10,
                remote: {
                        type: 'post',
                        url: link + 'user/ajax/check_transfer_user_Id',
                        data: {
                            'userId': function () {
                                return $('#userId').val()
                            },
                            'tbl': 'users',
                        },
                        dataType: 'json'
                    }
            },
            pinId: {
                required: true,
               
            },
            
        },
        messages: {
            userId: {
                required: "Please enter a user id",
                maxlength: "The user  id should be greater than or equal to 10 characters. ",
                remote : "User id is not available please check"
            },
            pinId: {
                required: "Please check atleast one pin",
                
            },

           

        },

    });
}


if ($("#validationRegistration").length > 0) {
        $("#validationRegistration").validate({
            rules: {
                full_name: {
                    required: true,
                    maxlength: 50
                },
                contact_number: {
                    required: true,
                    integer: true,
                    maxlength: 12,
                    minlength: 6,
                    /* remote: {
                        type: 'post',
                        url: link + 'user/ajax/check_mobile',
                        data: {
                            'contact_number': function () {
                                return $('#contact_number').val()
                            },
                            'tbl': 'users',
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
                        url: link + 'user/ajax/check_email',
                        data: {
                            'email': function () {
                                return $('#email').val()
                            },
                            'tbl': 'users',
                        },
                        dataType: 'json'
                    }*/

                },
                sponsored_id: {
                    required : true,
                    maxlength: 10,
                    remote: {
                        type: 'post',
                        url: link + 'user/ajax/check_sponsoredId',
                        data: {
                            'sponsored_id': function () {
                                return $('#userId').val()
                            },
                            'tbl': 'users',
                        },
                        dataType: 'json'
                    }

                },
                password: {
                    required: true,
                    maxlength: 25,
                    minlength: 6,
                },
                tez_number: {
                    integer: true,
                    maxlength: 12,
                    minlength: 10,
                },

                payphone: {
                    integer: true,
                    maxlength: 12,
                    minlength: 10,
                },
                
            },
            messages: {

                full_name: {
                    required: "Please enter name.",
                    maxlength: "The name should less than or equal to 50 characters. "
                },
                contact_number: {
                    required: "Please enter contact number.",
                    integer: "Please enter only number",
                    maxlength: "The contact number should less than or equal to 12 characters. ",
                    minlength: "The contact number atleast 10 characters. ",
                   /* remote: "Contact number already exist."*/
                },

                email: {
                    required: "Please enter email address.",
                    customemail: "Please enter valid email.",
                    email: "Please enter a valid email address.",
                    /*remote: "Email already exits."*/
                },
                sponsored_id :{
                    required: "Please enter sponsored id.",
                    maxlength: "The sponsored id should be less than or equal to 10 characters. ",
                    remote: "Please enter correct sponsor id."
                },
                password: {
                    required: "Please enter password .",
                     maxlength: "The password should less than or equal to 25 characters. ",
                    minlength: "The password atleast 6 characters. ",
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

});
