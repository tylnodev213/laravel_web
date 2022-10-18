$('#myModal').on('shown.bs.modal', function () {
    $('#myInput').trigger('focus')
})

$('#submit').click(function(){
    $('#myForm').submit();
});

$('.delete').on('click',function(){
    let id = $(this).attr('data-id');
    $('#id_delete').val(id);
});
