<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <title>{{ $title }}</title>
</head>
<body>
<div>
    <h1>Đây là form add</h1>
    <form method="post"
          action="{{ route('schools.store') }}"
            enctype="multipart/form-data"
    >
        <div>
            {{--        đây là token --}}
            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">

            {{--        đây là method--}}
            <input type="hidden" name="_method" value="POST">


            <input type="text"
                   name="school_name"
                   placeholder="Nhập tên trường"
                   value="{{ old('school_name') }}"
            /><br>

{{--            <input type="file"--}}
{{--                    name="logo"--}}
{{--                    placeholder="Chọn logo"--}}
{{--                    value="{{ old('logo') }}"--}}
{{--            /><br>--}}

            <button type="submit">Submit</button>

        </div>
    </form>
    <br>
        <div id="response"></div>
    <br>
    <div>
        <a href="{{ route('schools.index') }}">Quay lại</a>
    </div>
</div>


<script>
    $(document).ready(function(){
        $("form").on("submit", function(event){
            console.log('Form submitted');
            event.preventDefault();

            var formData = new FormData(this);

            $.ajax({
                url: "{{ route('schools.store') }}",
                type: 'POST',
                data: formData,
                processData: false,  // tell jQuery not to process the data
                contentType: false,  // tell jQuery not to set contentType
                success: function(response){
                    $('#response').html(response);
                },
                error: function(jqXHR, textStatus, errorThrown){
                    console.log(textStatus, errorThrown);
                    // You can do something with the error here
                }
            });
        });
    });
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
