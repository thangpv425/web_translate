@if(Session::has('message'))
var type = "{{ Session::get('alert-type', 'info') }}";
switch(type){
    case 'info':
        toastr.info("{!! Session::get('message') !!}", "Did You Know?");
    break;

    case 'warning':
        toastr.warning("{!! Session::get('message') !!}", "Be Careful!");
    break;

    case 'success':
        toastr["success"]("{!! session('message') !!}", "Congratulations!");
    break;

    case 'error':
        toastr.error("{!! Session::get('message') !!}", "Oops!");
    break;
}
@endif
