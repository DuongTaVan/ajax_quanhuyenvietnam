<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<form action="">
    <div>
        <label for="">Thanh Pho</label>
        <select class="js-location" name="" id="" data-type="city">
            <option value="">Chọn Tỉnh/Thành Phố</option>
            @foreach($tinhthanh as $city)
                <option value="{{$city->code}}">{{$city->name}}</option>
            @endforeach
        </select>
    </div>

    <div>
        <label for="">Quan Huyen</label>
        <select class="js-location" id="district" data-type="district">
            <option value="">Chọn Quận/Huyện</option>
        </select>
    </div>

    <div>
        <label for="">Xa Phuong</label>
        <select id="wards" data-type="wards">
            <option value="">Chọn Xã/Phường</option>
        </select>
    </div>
</form>
</body>
</html>


<script
        src="https://code.jquery.com/jquery-3.4.1.js"
        integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
        crossorigin="anonymous">

</script>

<script>
    $(function () {
        $.ajaxSetup({
            headers : {
                'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
            }
        });

        $(".js-location").change(function (event) {
            event.preventDefault();
            let route = '{{route('ajax_get.location')}}';
            let $this = $(this);
            let type = $this.attr('data-type');
            let parentID = $this.val();
            $.ajax({
                method: "GET",
                url : route,
                data: {
                    type: type,
                    parent: parentID
                }
            })
            .done(function (msg) {
                if (msg.data)
                {
                    let html = '';
                    let element = '';
                    if (type == 'city')
                    {
                        html = "<option>Chọn Quận/Huyện</option>";
                        element = '#district';
                    }else{
                        html = "<option>Chọn Xã/Phường</option>";
                        element = '#wards';
                    }

                    $.each(msg.data, function ( value,index) {
                        html+= "<option value='"+index.code+"'>"+index.name+"</option>"
                    })

                    $(element).html('').append(html);
                }
            });
        })
    })
</script>