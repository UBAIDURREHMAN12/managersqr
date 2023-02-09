APP_URL = 'http://satori.ioptime.com/';

var competents_list = function () {

    $('.competnet_list_table').DataTable({
        "bDestroy": true,
        "processing": true,
        "serverSide": true,
        "Paginate": true,
        "scrollX": true,
        "scrollY": true,
        "ajax": {
            "url": "/get/competents/list",
            "dataType": "json",
        },
        "columns": [

            {
                "data": "first_name"
            },
            {
                "data": "last_name"
            },
            {
                "data": "email"
            },
            {
                "data": "phone_number"
            },
            {
                "data": "street_address"
            },
            {
                "data": "city"
            },
            {
                "data": "state"
            },
            {
                "data": "created_at"
            },
            {
                "data": "action"
            }
        ]

    });

}

var closed_projects = function () {

    $('.closed_projects_table').DataTable({
        "bDestroy": true,
        "processing": true,
        "serverSide": true,
        "Paginate": true,
        "scrollX": true,
        "scrollY": true,
        "ajax": {
            "url": "/get/closed/list",
            "dataType": "json",
        },
        "columns": [

            {
                "data": "id"
            },
            {
                "data": "title"
            },
            {
                "data": "reports"
            },
            {
                "data": "project_client"
            },
            {
                "data": "created_at"
            }
        ]

    });

}

var workers_list = function () {

    $('.workers_list_table').DataTable({
        "bDestroy": true,
        "processing": true,
        "serverSide": true,
        "Paginate": true,
        "scrollX": true,
        "scrollY": true,
        "ajax": {
            "url": "/get/workers/list",
            "dataType": "json",
        },
        "columns": [

            {
                "data": "first_name"
            },
            {
                "data": "last_name"
            },
            {
                "data": "email"
            },
            {
                "data": "phone_number"
            },
            {
                "data": "street_address"
            },
            {
                "data": "city"
            },
            {
                "data": "state"
            },
            {
                "data": "created_at"
            },
            {
                "data": "action"
            }
        ]

    });

}

var your_competents_table = function () {

    $('.your_competents_table').DataTable({
        "bDestroy": true,
        "processing": true,
        "serverSide": true,
        "Paginate": true,
        "scrollX": true,
        "scrollY": true,
        "ajax": {
            "url": "/your/competents/list",
            "dataType": "json",
        },
        "columns": [
            {
                "data": "first_name"
            },
            {
                "data": "last_name"
            },
            {
                "data": "email"
            },
            {
                "data": "phone_number"
            },
            {
                "data": "street_address"
            },
            {
                "data": "city"
            },
            {
                "data": "state"
            },
            {
                "data": "created_at"
            }

        ]

    });

}


var getProjectsDetails = function () {

    $('.projects_details_show_to_manager').DataTable({
        "bDestroy": true,
        "processing": true,
        "serverSide": true,
        "Paginate": true,
        "scrollX": true,
        "scrollY": true,
        "ajax": {
            "url": "/manager/get/projects/details",
            "dataType": "json",
        },
        "columns": [
            {
                "data": "id"
            },
            {
                "data": "title"
            },
            {
                "data": "counter"
            },
            {
                "data": "is_assigned_to_competentperson"
            },
            {
                "data": "responsible_competent"
            },
            {
                "data": "crews_datais"
            },
            // {
            //     "data": "workareas"
            // },
            {
                "data": "action"
            },


        ]

    });

}

var projects_for_reprots_table = function () {

    $('.projects_for_reprots_table').DataTable({
        "bDestroy": true,
        "processing": true,
        "serverSide": true,
        "Paginate": true,
        "scrollX": true,
        "scrollY": true,
        "ajax": {
            "url": "/manager/get/projects/for/reports",
            "dataType": "json",
        },
        "columns": [
            {
                "data": "id"
            },
            {
                "data": "title"
            },
            {
                "data": "reports"
            },
            {
                "data": "project_client"
            },

            {
                "data": "created_at"
            },


        ]

    });

}


var FetchReportsList = function () {

    var fromdate =  $('#fromdate').val(null);
    var todate =  $('#todate').val(null);
    var status  =  $('#select_status').val(null);

    $('.reports_table').DataTable().destroy();
    $('.reports_table tbody').empty();

    var project_id = $('#get_project_id').val();

    $('.reports_table').DataTable({
        "destroy": true,
        "bDestroy": true,
        "processing": true,
        "serverSide": true,
        "Paginate": true,
        "order": [[ 0, "desc" ]],
        // "scrollX": true,
        "scrollY": true,
        "ajax": {
            "url": "/manager/get/all/reports/"+project_id,
            "dataType": "json",
        },
        "columns": [

            {
                "data": "id"
            },
            {
                "data": "title"
            },
            //
            // {
            //     "data": "competent_person"
            // },
            {
                "data": "created_at"
            },
            {
                "data": "report_status"
            },
            {
                "data": "action"
            },


        ]

    });

}

var FetchReportsList_filter = function (fromdate,todate,status) {

    var project_id = $('#get_project_id').val();

    $('.reports_table').DataTable().destroy();
    $('.reports_table tbody').empty();

    $('.reports_table').DataTable({
        "destroy": true,
        "bDestroy": true,
        "processing": true,
        "serverSide": true,
        "Paginate": true,
        // "scrollX": true,
        "scrollY": true,
        "ajax": {
            "url": "/filter/reports/"+project_id+"/"+fromdate+"/"+todate+"/"+status,
            "dataType": "json",
        },
        "columns": [

            {
                "data": "id"
            },
            {
                "data": "title"
            },
            //
            // {
            //     "data": "competent_person"
            // },
            {
                "data": "created_at"
            },
            {
                "data": "report_status"
            },
            {
                "data": "action"
            },


        ]

    });

}


var completed_projects = function () {

    $('.completed_projects').DataTable({
        "bDestroy": true,
        "processing": true,
        "serverSide": true,
        "Paginate": true,
        "scrollX": true,
        "scrollY": true,

        "ajax": {
            "url": "/manager/get/completed/projects",
            "dataType": "json",
        },
        "columns": [

            {
                "data": "id"
            },
            {
                "data": "title"
            },
            {
                "data": "description"
            },

            {
                "data": "responsible_manager"
            },


            {
                "data": "responsible_competent"
            },
            {
                "data": "crews_datais"
            },





        ],
        // "dom": '<"top"i>rt<"bottom"flp><"clear">'

    });

}

$(document).on('click', '.manager_edit_project', function () {

    $('#response_msg').html(' ');
    var project_id = this.id;

    $.ajax({
        url: "/manager/edit/project/"+project_id,
        method: "GET",
        dataType: "json",
        success: function (data) {
            $('#projectId').val(data.projectData[0].id);
            $('#edit_project_title').val(data.projectData[0].title);
            $('#edit_project_description').val(data.projectData[0].description);
            var value1 = data.projectData[0].responsible_competent;


            // if(value1.trim()==null){
            //     $('.edit-competent-div').css('display','none');
            //     $('#edit_competent').prop('required',false);
            //     $('#edit_competent').val(null);
            // }
            // else {
            //     $('.edit-competent-div').css('display','block');
            //     $('#edit_competent option[value="' + data.projectData[0].responsible_competent +'"]').prop("selected", true);
            //     $('#edit_competent').prop('required',true);
            // }



            // $('#edit_crews_datais').val(data.projectData[0].crews_datais);

            var getdata = data.projectData[0].crews_datais;

            if(getdata) {
                $.each(getdata.split(","), function(i,e){
                    $("#edit_crews option[value='" + e + "']").prop("selected", true);
                });
            }


            // alert(getdata);
            //
            // if(!getdata.trim()) {
            //     $('.edit-workers-div').css('display','none');
            //     $('#edit_crews').prop('required',false);
            //     $("#edit_crews").children('select').each((i,el) => $(el).hide().val(""));
            // }else{
            //     $('.edit-workers-div').css('display','block');
            //     $.each(getdata.split(","), function(i,e){
            //         $("#edit_crews option[value='" + e + "']").prop("selected", true);
            //     });
            //     $('#edit_crews').prop('required',true);
            // }

            $('.manager_update_project').modal('show');
        }
    });
});




$(document).on('click', '.edit_competent', function () {
    $('#udpate_competent_form')[0].reset();

    $('#competent_update_response_msg').html(' ');
    var competent_id = this.id;
    $.ajax({
        url: "/edit/competnet/"+competent_id,
        method: "GET",
        dataType: "json",
        success: function (data) {
            $('#CompetentId').val(data.CompetentData[0].id);
            $('#edit_first_name').val(data.CompetentData[0].first_name);
            $('#edit_last_name').val(data.CompetentData[0].last_name);
            $('#edit_email').val(data.CompetentData[0].email);
            $('#edit_phone').val(data.CompetentData[0].phone_number);
            $('#edit_street_address').val(data.CompetentData[0].street_address);
            $('#edit_city').val(data.CompetentData[0].city);
            $('#edit_state').val(data.CompetentData[0].state);
            $('#edit_zip').val(data.CompetentData[0].zip_code);
            $('#edit_certification_number').val(data.CompetentData[0].certification_number);
            $('.update_competent_modal').modal('show');
        }
    })
});


$(document).on('click', '.not_assign_yet_btn', function () {

    window.location.replace("http://gosatoriapp.com/assign/to/competent");

});


$(document).on('click', '.show_crews', function () {

    var project_id = this.id;

    $.ajax({
        url: "/get/crews/"+project_id,
        method: "GET",
        dataType: "json",
        success: function (data) {

            $("#ballers").html(null)

            console.log(data.crews);

            $.each( data.crews, function( i, item ) {

                var newListItem = "<li>" + item + "</li>";

                $("#ballers").append( newListItem );

            });
            $('.crews_modal').modal('show');
        }
    });



});

$(document).on('click', '#filter', function () {


    var fromdate =  $('#fromdate').val();
    var todate =  $('#todate').val();
    var status  =  $('#select_status').val();

    if(fromdate=='' && todate==''){
        alert('Select from date and to date');
        exit();
    }

    if(fromdate!='' && todate==''){
        alert('Select to date');
        exit();
    }

    if(fromdate=='' && todate!=''){
        alert('Select from date');
        exit();
    }


    FetchReportsList_filter(fromdate,todate,status);

});

$(document).on('click', '#refresh', function () {


    var fromdate =  $('#fromdate').val(null);
    var todate =  $('#todate').val(null);
    var status  =  $('#select_status').val(null);

    FetchReportsList();

});

$(document).on('click', '.edit_worker', function () {
    $('#udpate_worker_form')[0].reset();

    $('#worker_update_response_msg').html(' ');
    var worker_id = this.id;
    $.ajax({
        url: "/edit/worker/"+worker_id,
        method: "GET",
        dataType: "json",
        success: function (data) {
            $('#WorkerId').val(data.WorkerData[0].id);
            $('#edit_worker_first_name').val(data.WorkerData[0].first_name);
            $('#edit_worker_last_name').val(data.WorkerData[0].last_name);
            $('#edit_worker_email').val(data.WorkerData[0].email);
            $('#edit_worker_phone').val(data.WorkerData[0].phone_number);
            $('#edit_worker_street_address').val(data.WorkerData[0].street_address);
            $('#edit_worker_city').val(data.WorkerData[0].city);
            $('#edit_worker_state').val(data.WorkerData[0].state);
            $('#edit_worker_zip').val(data.WorkerData[0].zip_code);
            $('#edit_worker_certification_number').val(data.WorkerData[0].certification_number);
            $('.update_worker_modal').modal('show');
        }
    })
});

$('#manager_update_project_form').on('submit', function (event) {

    $('#update_processing').css('display', 'block');
    $('.update_project_submit').prop('disabled', true);

    event.preventDefault();
    $.ajax({
        url: "/manager/update/project",
        method: "POST",
        data: new FormData(this),
        contentType: false,
        cache: false,
        processData: false,
        dataType: "json",
        success: function (data) {

            if (data.response_message) {
                $('#manager_update_project_form')[0].reset();
                $('#update_processing').css('display', 'none');
                $('.update_project_submit').prop('disabled', false);
                $('#response_msg').html(' ');
                $('#response_msg').html(data.response_message);
                getProjectsDetails();
            }
        }
    })
});



$(document).on('click', '.add_competent_btn', function () {
    $('#competent_add_response_msg').html(null);
    $('.add_competent_modal').modal('show');

    $(".print-error-msg").css('display','none');

    $('.btn-add').prop('disabled', false);

    $(".prcessing").css("display", "none");

    $('.progress-bar').hide();

    $('#competent_add_response_msg').html(null);

});

$('#udpate_competent_form').on('submit', function (event) {

    event.preventDefault();
    $.ajax({
        url: "/update/competent",
        method: "POST",
        data: new FormData(this),
        contentType: false,
        cache: false,
        processData: false,
        dataType: "json",
        success: function (data) {

            if (data.response_message) {
                $('#competent_update_response_msg').html(null);
                $('#competent_update_response_msg').html(data.response_message);
                competents_list();
            }

        }
    })
});

$('#udpate_worker_form').on('submit', function (event) {

    event.preventDefault();
    $.ajax({
        url: "/update/worker",
        method: "POST",
        data: new FormData(this),
        contentType: false,
        cache: false,
        processData: false,
        dataType: "json",
        success: function (data) {

            if (data.response_message) {
                $('#worker_update_response_msg').html(null);
                $('#worker_update_response_msg').html(data.response_message);
                workers_list();
            }
        }
    })
});

$('#add_competent_form').on('submit', function (event) {

    event.preventDefault();
    $('.btn-add').prop('disabled', true);

    $(".prcessing").css("display", "block");

    $(".print-error-msg").css('display','none');

    $.ajax({
        url: "/create/competent/person",
        method: "POST",
        data: new FormData(this),
        contentType: false,
        cache: false,
        processData: false,
        dataType: "json",
        success: function (data) {

            // if (data.response_message) {
            //     $('#competent_add_response_msg').html(' ');
            //     $('#competent_add_response_msg').html(data.response_message);
            //     competents_list();
            // }

            if($.isEmptyObject(data.error)){
                // $(".print-error-msg").find("ul").html(null);
                // $('#competent_add_response_msg').html(data.success);
                $('#result').html('<div class="alert alert-info">' + data.success + '</div>');
                $('.progress-bar').show();
                $('.progress-bar').text('Competent created');
                $('.progress-bar').css('width', '100%');
                // $('#success').html('<span class="text-success"><b>'+data.success+'</b></span><br /><br />');
                $('#success').append(data.image);

                $('.btn-add').attr('disabled', true);
                $(".prcessing").css("display", "none");
                competents_list();
            }else{
                $('#add_competent_form')[0].reset();
                printErrorMsg(data.error);
                $('#competent_add_response_msg').html(null);
                $('#competent_add_response_msg').html(data.error);
                $(".prcessing").css("display", "none");
                competents_list();
            }
        }
    });
    function printErrorMsg (msg) {
        $(".print-error-msg").find("ul").html('');
        $(".print-error-msg").css('display','block');
        $.each( msg, function( key, value ) {
            $(".print-error-msg").find("ul").append('<li>'+value+'</li>');
        });
    }
});

$(document).on('click', '.delete_competent', function () {
    var competent_id = this.id;
    if (confirm("Are you sure to delete this competent ?")) {

        $.ajax({
            url:  "/delete/competent",
            method: "POST",
            dataType: "json",
            data: {
                id: competent_id
            },
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            success: function (data) {
                $('#response_msg_for_deletion').html(' ');
                $('#response_msg_for_deletion').html(data.response_message);
                competents_list();
            }
        })
    }
    return false;
});


$(document).on('click', '.delete_worker', function () {
    var worker_id = this.id;
    if (confirm("Are you sure to delete this worker ?")) {

        $.ajax({
            url:  "/delete/worker",
            method: "POST",
            dataType: "json",
            data: {
                id: worker_id
            },
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            success: function (data) {
                $('#response_msg_for_deletion').html(' ');
                $('#response_msg_for_deletion').html(data.response_message);
                workers_list();
            }
        })
    }
    return false;
});


$(document).on('click', '.manager_reject_report', function () {
    var report_id = this.id;


    $('#report_id').val(report_id);

    $('#report_reject_form')[0].reset();

    $('#report_id').val(report_id);
    if (confirm("Are you sure to reject this report ?")) {

        $('.reject_reason_modal').modal('show');

    } else {
        return false;
    }
});


$('#report_reject_form').on('submit', function (event) {

    $('#processing_reject_form').css('display', 'block');
    $('#btn_reject').prop('disabled', true);

    event.preventDefault();
    $.ajax({
        url:  "/reject/report",
        method: "POST",
        data: new FormData(this),
        contentType: false,
        cache: false,
        processData: false,
        dataType: "json",
        success: function (data) {

            $('#processing_reject_form').css('display', 'none');
            $('#btn_reject').prop('disabled', false);

            if (data.response_message) {
                $('.reject_reason_modal').modal('hide');
                $('.response_modal').modal('show');
                $('#approved_response_message').html(' ');
                $('#reject_response_message').html(' ');
                $('#reject_response_message').html(data.response_message);


                var fromdate = $('#fromdate').val();
                var todate = $('#todate').val();
                var status = $('#status').val();

                if(fromdate==''){
                    FetchReportsList();

                }else{
                    FetchReportsList_filter(fromdate,todate,status);
                }



            }
        }
    });

});

$(document).on('click', '.manager_approve_report', function () {
    var report_id = this.id;

    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url:  "/approve/report",
        method: "POST",
        data: { id: report_id },
        cache: false,
        dataType: "json",
        success: function (data) {

            if (data.response_message) {
                $('.response_modal').modal('show');
                $('#reject_response_message').html(' ');
                $('#approved_response_message').html(' ');
                $('#approved_response_message').html(data.response_message);


                var fromdate = $('#fromdate').val();
                var todate = $('#todate').val();
                var status = $('#status').val();

                if(fromdate==''){
                    FetchReportsList();

                }else{
                    FetchReportsList_filter(fromdate,todate,status);
                }

            }

        }
    });
});



$(".add-worker-btn").click(function() {
    $('#add_worker_response').html(' ');
    $('.add_worker_modal').modal('show');
});

$('#add_worker_form').on('submit', function (event) {

    $('.add_worker_button').prop('disabled', true);
    $('.progress_bar_row').css('display', 'block');

    event.preventDefault();
    $.ajax({
        url: "/manager/add/worker",
        method: "POST",
        data: new FormData(this),
        contentType: false,
        cache: false,
        processData: false,
        dataType: "json",
        success: function (data) {
            $('.add_worker_button').prop('disabled', false);
            $('.progress_bar_row').css('display', 'none');
            // if (data.response_message) {
            //     $('#add_worker_form')[0].reset();
            //     $('.progress_bar_row').css('display', 'none');
            //     $('.add_worker_button').prop('disabled', false);
            //     $('#add_worker_response').html(' ');
            //     $('#add_worker_response').html(data.response_message);
            //     workers_list();
            // }

            if($.isEmptyObject(data.error)){
                $('#add_worker_form')[0].reset();
                $('.progress_bar_row').css('display', 'none');
                $('.print-error-msg2').css('display', 'none');
                $('.add_worker_button').prop('disabled', false);
                $('#add_worker_response').html(' ');
                $('#add_worker_response').html(data.response_message);
                workers_list();
            }else {
                $('#add_worker_response').html(null);
                $(".print-error-msg2").find("ul").html('');
                $(".print-error-msg2").css('display','block');
                $.each( data.error, function( key, value ) {
                    $(".print-error-msg2").find("ul").append('<li>'+value+'</li>');
                });
            }

        }
    });

});




$(document).ready(function () {


    // $('.work_areas_table').DataTable();

    $('.work_areas_table').DataTable({
        "bDestroy": true,
        "scrollX": true,
        "scrollY": true,
    });

    $('#fromdate').val(null);
    $('#todate').val(null);
    $('#select_status').val(null);

    $('#btn_on_going').css('background', '#A9A9A9');
    $('#btn_on_going').css('color', 'blue');

    completed_projects();
    competents_list();
    closed_projects();
    projects_for_reprots_table();
    workers_list();
    your_competents_table();
    getProjectsDetails();
    FetchReportsList();
});
