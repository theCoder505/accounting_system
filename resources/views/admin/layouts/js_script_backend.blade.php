<script src="{{ asset('assets/backend/plugins/') }}/jquery/jquery.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>


<script type="text/javascript">
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    });


    @if (Session::has('message'))
        var type = "{{ Session::get('alert-type', 'info') }}"
        switch (type) {
            case 'info':

                toastr.options.timeOut = 10000;
                toastr.info("{{ Session::get('message') }}");
                var audio = new Audio('audio.mp3');
                audio.play();
                break;
            case 'success':

                toastr.options.timeOut = 10000;
                toastr.success("{{ Session::get('message') }}");
                var audio = new Audio('audio.mp3');
                audio.play();

                break;
            case 'warning':

                toastr.options.timeOut = 10000;
                toastr.warning("{{ Session::get('message') }}");
                var audio = new Audio('audio.mp3');
                audio.play();

                break;
            case 'error':

                toastr.options.timeOut = 10000;
                toastr.error("{{ Session::get('message') }}");
                var audio = new Audio('audio.mp3');
                audio.play();

                break;
        }
    @endif





    //category
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        token = $("input[value='_token']").val();


        $('.edit').on('click', function() {
            var id = $(this).attr("data-id");
            data = {
                "_token": token,
                "id": id
            };
            $.ajax({
                url: "category/" + id + '/edit',
                type: "get",
                data: data,
                success: function(response) {
                    // console.log(response);
                    $('.category-form').html(response);
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(textStatus, errorThrown);
                }
            });
        });

        $('.editincome_expense_category').on('click', function() {
            var id = $(this).attr("data-id");
            data = {
                "_token": token,
                "id": id
            };
            $.ajax({
                url: "income_expense_category/" + id + '/edit',
                type: "get",
                data: data,
                success: function(response) {
                    // console.log(response);
                    $('.income_expense_category-form').html(response);
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(textStatus, errorThrown);
                }
            });
        });

        $('.edittechnology').on('click', function() {
            var id = $(this).attr("data-id");
            data = {
                "_token": token,
                "id": id
            };
            $.ajax({
                url: "technology/" + id + '/edit',
                type: "get",
                data: data,
                success: function(response) {
                    // console.log(response);
                    $('.technology-form').html(response);
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(textStatus, errorThrown);
                }
            });
        });

        $('.editSubcategory').on('click', function() {
            var id = $(this).attr("data-id");
            data = {
                "_token": token,
                "id": id
            };
            $.ajax({
                url: "subcategory/" + id + '/edit',
                type: "get",
                data: data,
                success: function(response) {
                    // console.log(response);
                    $('.subcategory-form').html(response);
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(textStatus, errorThrown);
                }
            });
        });



        $('.unitEdit').on('click', function() {
            var id = $(this).attr("data-id");
            data = {
                "_token": token,
                "id": id
            };
            $.ajax({
                url: "unit/" + id + '/edit',
                type: "get",
                data: data,
                success: function(response) {
                    // console.log(response);
                    $('.unit-form').html(response);
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(textStatus, errorThrown);
                }
            });
        });

        $('.unitBrand').on('click', function() {
            var id = $(this).attr("data-id");
            data = {
                "_token": token,
                "id": id
            };
            $.ajax({
                url: "brand/" + id + '/edit',
                type: "get",
                data: data,
                success: function(response) {
                    // console.log(response);
                    $('.brand-form').html(response);
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(textStatus, errorThrown);
                }
            });
        });



        
        $('.editCompany').on('click', function() {
            var id = $(this).attr("data-id");
            data = {
                "_token": token,
                "id": id
            };
            $.ajax({
                url: "company/" + id + '/edit',
                type: "get",
                data: data,
                success: function(response) {
                    // console.log(response);
                    $('.company-form').html(response);
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(textStatus, errorThrown);
                }
            });
        });
        
        $('.editservice').on('click', function() {
            var id = $(this).attr("data-id");
            data = {
                "_token": token,
                "id": id
            };
            $.ajax({
                url: "service/" + id + '/edit',
                type: "get",
                data: data,
                success: function(response) {
                    // console.log(response);
                    $('.service-form').html(response);
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(textStatus, errorThrown);
                }
            });
        });
        
        $('.editwork').on('click', function() {
            var id = $(this).attr("data-id");
            data = {
                "_token": token,
                "id": id
            };
            $.ajax({
                url: "work/" + id + '/edit',
                type: "get",
                data: data,
                success: function(response) {
                    // console.log(response);
                    $('.work-form').html(response);
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(textStatus, errorThrown);
                }
            });
        });

        $('.editRole').on('click', function() {
            var id = $(this).attr("data-id");
            data = {
                "_token": token,
                "id": id
            };
            $.ajax({
                url: "role/" + id + '/edit',
                type: "get",
                data: data,
                success: function(response) {
                    // console.log(response);
                    $('.role-form').html(response);
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(textStatus, errorThrown);
                }
            });
        });

        $('.adminEdit').on('click', function() {
            var id = $(this).attr("data-id");
            data = {
                "_token": token,
                "id": id
            };
            $.ajax({
                url: "admins/" + id + '/edit',
                type: "get",
                data: data,
                success: function(response) {
                    // console.log(response);
                    $('.admin-form').html(response);
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(textStatus, errorThrown);
                }
            });
        });









    });


    function getProductDetails(val) {
        var token = $("input[name=_token]").val();
        var datastr = "product_id=" + val + "&token=" + token;

        $.ajax({
            type: "post",
            url: "<?php echo route('admin/get_product_details'); ?>",
            data: datastr,
            cache: false,
            beforeSend: function() {
                // setting a timeout
            },
            success: function(data) {

                if (data.product.qty == null) {
                    $('.availableQty').val(0);
                } else {
                    $('.availableQty').val(data.product.qty);
                }


                $('.ProductCode').val(data.product.code);
                $('.ProductColor').val(data.product.color);
                $('.ProductCategory').val(data.category.name);
                $('.ProductSubCategory').val(data.subcategory.name);
                $('.ProductBrand').val(data.brand.name);
                $('.ProductUnit').val(data.unit.name);
                $('.price').val(data.product.selling_price);
            },
            error: function(jqXHR, status, err) {
                alert(status);
                console.log(err);
            },
            complete: function() {
                // alert("Complete");
            }
        });
    }


    function getCompanyDetails(val) {
        var token = $("input[name=_token]").val();
        var datastr = "company_id=" + val + "&token=" + token;

        $.ajax({
            type: "post",
            url: "<?php echo route('admin/get_company_details'); ?>",
            data: datastr,
            cache: false,
            beforeSend: function() {
                // setting a timeout
            },
            success: function(data) {
                console.log(data.company)
                $('.company_address').val(data.company.address);
                $('.company_number').val(data.company.phone);
                $('.per_month_amount').val(data.company.monthly_collection_amount);
            },
            error: function(jqXHR, status, err) {
                alert(status);
                console.log(err);
            },
            complete: function() {
                // alert("Complete");
            }
        });
    }



    function getCategoryDetails(val) {
        var token = $("input[name=_token]").val();
        var datastr = "category_id=" + val + "&token=" + token;

        $.ajax({
            type: "post",
            url: "<?php echo route('admin/get_category_details'); ?>",
            data: datastr,
            cache: false,
            beforeSend: function() {
                // setting a timeout
            },
            success: function(data) {
                $('#total').val(data.category.amount);
            },
            error: function(jqXHR, status, err) {
                alert(status);
                console.log(err);
            },
            complete: function() {
                // alert("Complete");
            }
        });
    }

    function getProjects(val) {
        var token = $("input[name=_token]").val();
        var datastr = "company_id=" + val + "&token=" + token;

        $.ajax({
            type: "post",
            url: "<?php echo route('admin/get_projects'); ?>",
            data: datastr,
            cache: false,
            beforeSend: function() {
                // setting a timeout
            },
            success: function(data) {
                console.log(data)
                $('.project_id').html(data);
            },
            error: function(jqXHR, status, err) {
                alert(status);
                console.log(err);
            },
            complete: function() {
                // alert("Complete");
            }
        });
    }


    function getIECategory(val) {
        var token = $("input[name=_token]").val();
        var datastr = "type=" + val + "&token=" + token;

        if(val == 'Income'){
            $('#client_div').show();
            $('#project_div').show();
        }else{
            $('#client_div').hide();
            $('#project_div').hide();
        }


        $.ajax({
            type: "post",
            url: "<?php echo route('admin/get_ie_category'); ?>",
            data: datastr,
            cache: false,
            beforeSend: function() {
                // setting a timeout
            },
            success: function(data) {
                $('.income_expense_category_id').html(data);
            },
            error: function(jqXHR, status, err) {
                alert(status);
                console.log(err);
            },
            complete: function() {
                // alert("Complete");
            }
        });
    }



    function getProjectDetails(val) {
        var token = $("input[name=_token]").val();
        var datastr = "project_id=" + val + "&token=" + token;

        $.ajax({
            type: "post",
            url: "<?php echo route('admin/get_project_details'); ?>",
            data: datastr,
            cache: false,
            beforeSend: function() {
                // setting a timeout
            },
            success: function(data) {
                $('#total').val(data.project.project_budget);
            },
            error: function(jqXHR, status, err) {
                alert(status);
                console.log(err);
            },
            complete: function() {
                // alert("Complete");
            }
        });
    }




    $(document).ready(function() {
        $('#summernote').summernote();
    });


    $(document).ready(function() {
        $('.summernote').summernote();
    });



    $(document).ready(function() {
        $('.select2').select2({
            placeholder: 'Select '
        });
    });
</script>
