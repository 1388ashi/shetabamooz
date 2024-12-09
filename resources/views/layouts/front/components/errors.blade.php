<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>

<script>
    @foreach($errors->all() as $error)
    @if ($error == 'کاربر قبلا ثبت نام کرده!')
        Toastify({
            text: @json($error),
            duration: 3000,
            destination: "https://github.com/apvarun/toastify-js",
            newWindow: true,
            close: true,
            gravity: "top", // `top` or `bottom`
            positionLeft: true, // `true` or `false`
            backgroundColor: "linear-gradient(to right, #FF5353, #FF5353)",
        }).showToast();
    @else
        Toastify({
            text: "لطفا اطلاعات را به صورت صحیح وارد کنید!",
            duration: 3000,
            destination: "https://github.com/apvarun/toastify-js",
            newWindow: true,
            close: true,
            gravity: "top", // `top` or `bottom`
            positionLeft: true, // `true` or `false`
            backgroundColor: "linear-gradient(to right, #FF5353, #FF5353)",
        }).showToast();
    @endif
    @endforeach
</script>
{{--source:--}}
{{--https://stackoverflow.com/questions/51874756/how-to-use-toastify-js-with-laravel-5-6--}}
