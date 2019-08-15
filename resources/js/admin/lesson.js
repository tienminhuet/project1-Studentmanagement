$(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    CKEDITOR.replace( 'editor1' );
    $('.Exercise').on('click', function() {
        $('#submitExercise').modal('show');
        $('#submitExercise').attr('lesson_exercise_id', $(this).attr('data-id'));
    })
    $('.submitExercise').on('click', function(e) {
        e.preventDefault();
        var formData = new FormData();
        formData.append('lesson_id', $(this).attr('data-lessonId'));
        formData.append('lession_exercise_id', $('#submitExercise').attr('lesson_exercise_id'));
        formData.append('content', CKEDITOR.instances.editor1.getData());
        $.ajax({
            type: 'post', 
            url: route('submitExercise'),
            processData: false,
            contentType: false,
            data:formData,
            dataType: 'JSON',
            success: function (response) {
                $('#submitExercise').modal('hide');
                toastr.success(response.success);
            },
            error:function(jqXHR, textStatus, errorThrown){
                if (jqXHR.responseJSON.errors.content !== undefined){
                    toastr.error(jqXHR.responseJSON.errors.content[0]);
                }
            }
        })
    });

    $('.showHomework').on('click', function(e) {
        e.preventDefault();
        $('#mark').html('');
        $('#content').html('');
        $('#comment').html('');
        $('.submitMarking').attr('data-homeworkId', '');
        var formData = new FormData();
        formData.append('lesson_id', $(this).attr('data-lessonId'));
        formData.append('lession_exercise_id', $(this).attr('data-id'));
        formData.append('user_id', $(this).attr('data-userId'));
        $.ajax({
            type: 'post', 
            url: route('showHomework'),
            processData: false,
            contentType: false,
            data:formData,
            dataType: 'JSON',
            success: function (response) {
                $('.submitMarking').attr('data-homeworkId', response.id);
                $('#mark').html(response.mark);
                $('#content').html(response.content);
                $('#comment').html(response.comment);
                $('#mark1').val(response.mark);
                $('#comment1').val(response.comment);
            },
        });
    })

    $('.submitMarking').on('click', function(e) {
        e.preventDefault();
        var formData = new FormData();
        formData.append('homeworkId', $(this).attr('data-homeworkId'));
        formData.append('mark', $('#mark1').val());
        formData.append('comment', $('#comment1').val());
        $.ajax({
            type: 'post', 
            url: route('submitMarking'),
            processData: false,
            contentType: false,
            data:formData,
            dataType: 'JSON',
            success: function (response) {
                if (response.error == true) {
                    toastr.error(response.success);
                } else {
                    toastr.success(response.success);
                }
            },
        });
    });
});
