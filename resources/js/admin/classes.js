$(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('#happenning').DataTable({
        processing: true,
        serverSide: true,
        ajax: $('#happenning').attr('data-url'),
        columns: [
            { data: 'id', name: 'id' },
            { data: 'name', name: 'name' },
            { data: 'subject_id', name: 'subject_id' },
            { data: 'user_id', name: 'user_id' },
            { data: 'created_at', name: 'created_at' },
            { data: 'action', name: 'action' },
        ],
    });

    $('#teacherClass-happen').DataTable({
        processing: true,
        serverSide: true,
        ajax: $('#teacherClass-happen').attr('data-url'),
        columns: [
            { data: 'id', name: 'id' },
            { data: 'name', name: 'name' },
            { data: 'created_at', name: 'created_at' },
            { data: 'action', name: 'action' },
        ],
    });

    $('.submit-add').on('click', function(e) {
        e.preventDefault();
        var formData1 = new FormData();
        formData1.append('subject_id', $('#course').val());
        formData1.append('user_id', $('#teacher').val());
        formData1.append('name', $('#add-name').val());
        $.ajax({
            type: 'post', 
            url: route('addClass'),
            processData: false,
            contentType: false,
            data:formData1,
            dataType: 'JSON', 
            success: function (response) {
                $('#upcomming').DataTable().ajax.reload(null, false);
                $('#addNewClass').modal('hide');
                if (response.error == true) {
                    toastr.error(response.success);
                } else {
                    toastr.success(response.success);
                }
            },  
            error:function(jqXHR, textStatus, errorThrown){
                if (jqXHR.responseJSON.errors.name !== undefined){
                    toastr.error(jqXHR.responseJSON.errors.name[0]);
                }
            }
        })
    });
});

$(document).on('click', '.status2', function() {
    $('#upcomming').DataTable({
        destroy: true,
        processing: true,
        serverSide: true,
        ajax: $('#upcomming').attr('data-url'),
        columns: [
            { data: 'id', name: 'id' },
            { data: 'name', name: 'name' },
            { data: 'subject_id', name: 'subject_id' },
            { data: 'user_id', name: 'user_id' },
            { data: 'created_at', name: 'created_at' },
            { data: 'action', name: 'action' },
        ],
    });
    $('#upcomming').DataTable().ajax.reload(null, false);
})

$(document).on('click', '.status3', function() {
    $('#finished').DataTable({
        destroy: true,
        processing: true,
        serverSide: true,
        ajax: $('#finished').attr('data-url'),
        columns: [
            { data: 'id', name: 'id' },
            { data: 'name', name: 'name' },
            { data: 'subject_id', name: 'subject_id' },
            { data: 'user_id', name: 'user_id' },
            { data: 'created_at', name: 'created_at' },
            { data: 'action', name: 'action' },
        ],
    });
//     $('#finished').DataTable().ajax.reload(null, false);
})

$(document).on('click', '.adddetail', function() {
    var classId = $(this).attr('data-id');
    $('#AddStudent2Class').attr('class-id', classId);
    $('#addDetail').modal('show');
    $('#AddStudent2Class').DataTable({
        destroy: true,
        processing: true,
        serverSide: true,
        ajax: {
            url: route( 'datatables.addDetaiClass', {'classId': classId} ),
        },
        columns: [
            { data: 'id', name: 'id' },
            { data: 'name', name: 'name' },
            { data: 'email', name: 'email' },
            { data: 'created_at', name: 'created_at' },
            { data: 'action', name: 'action' },
        ],
    })
});

$(document).on('click', '.switch-indicator', function(e){
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.value) {
            e.preventDefault();
            var formData = new FormData();
            var classId = $('#AddStudent2Class').attr('class-id');
            formData.append('user_id', $(this).attr('user-id'));
            formData.append('class_id', classId);
            formData.append('inclass', $(this).attr('data-status'));
            $.ajax({
                type: 'post', 
                url: route( 'addStudentToClass'),
                processData: false,
                contentType: false,
                data:formData,
                dataType: 'JSON', 
                success: function (response) {
                    $('#user-table').DataTable().ajax.reload(null, false);
                    if (response.error == true) {
                        toastr.error(response.success);
                    } else {
                        toastr.success(response.success);
                    }
                },  
                error:function(jqXHR, textStatus, errorThrown){
                 
                }
            })
        }
    })
});

$('#StudenClass').DataTable({
    destroy: true,
    processing: true,
    serverSide: true,
    ajax: $('#StudenClass').attr('data-url'),
    columns: [
        { data: 'id', name: 'id' },
        { data: 'name', name: 'name' },
        { data: 'created_at', name: 'created_at' },
        { data: 'action', name: 'action' },
    ],
});

$(document).on('click', '.teacherClass2', function() {
    $('#teacherClass-upcomming').DataTable({
        destroy: true,
        processing: true,
        serverSide: true,
        ajax: $('#teacherClass-upcomming').attr('data-url'),
        columns: [
            { data: 'id', name: 'id' },
            { data: 'name', name: 'name' },
            { data: 'created_at', name: 'created_at' },
            { data: 'action', name: 'action' },
        ],
    });
})

$(document).on('click', '.teacherClass3', function() {
    $('#teacherClass-finished').DataTable({
        destroy: true,
        processing: true,
        serverSide: true,
        ajax: $('#teacherClass-finished').attr('data-url'),
        columns: [
            { data: 'id', name: 'id' },
            { data: 'name', name: 'name' },
            { data: 'created_at', name: 'created_at' },
            { data: 'action', name: 'action' },
        ],
    });
})
