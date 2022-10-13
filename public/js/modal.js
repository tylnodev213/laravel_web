$('#myModal').on('shown.bs.modal', function () {
    $('#myInput').trigger('focus')
})

$('#submit').click(function(){
    $('#myForm').submit();
});
