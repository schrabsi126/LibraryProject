<!DOCTYPE html>
<html>
<head>
    <title>Library</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <meta name="_token" content="{{csrf_token()}}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
    <script src="http://code.jquery.com/jquery-3.3.1.min.js"
            integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
            crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/additional-methods.min.js"></script>
</head>

<body>
<div class="container">
    <h1>Library</h1>
    <form id="form" method="POST" >
        <h2>Author</h2>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="name" >Name</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Name">
                <span class="text-danger">{{ $errors->first('name') }}</span>
            </div>

            <div class="form-group col-md-6">
                <label for="age" >Age</label>
                <input type="number" class="form-control" id="age" name="age" placeholder="age">
                <span class="text-danger">{{ $errors->first('age') }}</span>
            </div>
        </div>

        <div class="form-group">
            <label for="address" >Address</label>
            <input type="text" class="form-control" id="address" name="address" placeholder="1234 Main St">
            <span class="text-danger">{{ $errors->first('address') }}</span>
        </div>
        <h2>Book</h2>
        <div class="form-group">
            <label for="title" >Title</label>
            <input type="text" class="form-control" id="title" name="title" placeholder="Harry Potter">
            <span class="text-danger">{{ $errors->first('title') }}</span>
        </div>
        <div class="form-group">
            <label for="release_date" >Date</label>
            <input type="date" class="form-control" id="release_date" name="release_date">
            <span class="text-danger">{{ $errors->first('release_date') }}</span>
        </div>
        <button type="submit" class="btn btn-primary">create </button>
    </form>

    <button style="float: right" class="btn btn-primary" onclick="showData()">Show Data</button>
    <div id="data_container" style="display: none">
        @include('showAuthors')
    </div>
</div>
<script type="text/javascript">
    $(window).on('hashchange', function() {
        if (window.location.hash) {
            var page = window.location.hash.replace('#', '');
            if (page == Number.NaN || page <= 0) {
                return false;
            }else{
                getData(page);
            }
        }
    });

    $(document).ready(function()
    {
        $(document).on('click', '.pagination a',function(event)
        {
            event.preventDefault();

            $('li').removeClass('active');
            $(this).parent('li').addClass('active');

            var page=$(this).attr('href').split('page=')[1];

            getData(page);
        });

    });

    function getData(page){
        $.ajax(
            {
                url: '?page=' + page,
                type: "get",
                datatype: "html"
            }).done(function(data){
            $("#data_container").empty().html(data);
            location.hash = page;
        }).fail(function(jqXHR, ajaxOptions, thrownError){
            alert('No response from server');
        });
    }
</script>
<script>
    function showData() {
        var container = document.getElementById("data_container");
        if (container.style.display === "block") {
            container.style.display = "none";
        } else {
            container.style.display = "block";
        }
    }
</script>
<script>
        $("#form").validate({
            rules: {
                name: {
                    required: true,
                    maxlength: 50
                },

                age: {
                    required: true,
                    digits:true,
                },
                address: {
                    required: true,
                    maxlength: 50
                },
                title: {
                    required: true,
                    maxlength: 50
                },
                release_date: {
                    required: true
                }

            },
            messages: {

                name: {
                    required: "Please enter name",
                    maxlength: "Your  name maxlength should be 50 characters long."
                },
                age: {
                    required: "Please enter  age",
                    digits: "Please enter only numbers",
                },
                address: {
                    required: "Please enter address",
                    maxlength: "The address should less than or equal to 50 characters",
                },
                title: {
                    required: "Please enter title",
                    maxlength: "The address should less than or equal to 50 characters",
                },
                release_date: {
                    required: "Please enter date",
                },

            },
            submitHandler: function(form) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    }
                });
                jQuery.ajax({
                    url: "{{ url('author') }}",
                    method: 'post',
                    data: {
                        name: jQuery('#name').val(),
                        age: jQuery('#age').val(),
                        address: jQuery('#address').val(),
                        title: jQuery('#title').val(),
                        release_date: jQuery('#release_date').val(),
                    },
                    success: function(result){
                        document.getElementById("form").reset();
                        getData(window.location.hash.replace('#', ''));
                        alert(result);
                    },
                    error: function () {
                        alert('failed')
                    }
                });

            }
        })
</script>
</body>
</html>
