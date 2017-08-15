<script>
function toa(data) {
    switch(data['alert-type']){
        case 'info':
            toastr.info(data.message, "Did You Know?");
        break;

        case 'warning':
            toastr.warning(data.message, "Be Careful!");
        break;

        case 'success':
            toastr["success"](data.message, "Congratulations!");
        break;

        case 'error':
            toastr.error(data.message, "Oops!");
        break;
    }
}
</script>