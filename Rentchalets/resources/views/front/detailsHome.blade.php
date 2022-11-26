<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Creative - Start Bootstrap Theme</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="{{ asset('/assets/front/assets/favicon.ic') }}" />
        <!-- Bootstrap Icons-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
        <!-- Google fonts-->
        <link href="https://fonts.googleapis.com/css?family=Merriweather+Sans:400,700" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic" rel="stylesheet" type="text/css" />
        <!-- SimpleLightbox plugin CSS-->
        {{-- <link href="https://cdnjs.cloudflare.com/ajax/libs/SimpleLightbox/2.1.0/simpleLightbox.min.css" rel="stylesheet" /> --}}
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="{{ asset('/assets/front/css/styles.css') }}" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css" integrity="sha256-mmgLkCYLUQbXn0B1SRqzHar6dCnv9oZFPEC1g1cwlkk=" crossorigin="anonymous" />
    </head>

    <body id="page-top">
        {{-- <!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-light fixed-top py-3" id="mainNav">
            <div class="container px-4 px-lg-5">
                <a class="navbar-brand" href="#page-top">Start Bootstrap</a>
                <button class="navbar-toggler navbar-toggler-right" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ms-auto my-2 my-lg-0">
                        <li class="nav-item"><a class="nav-link" href="#about">About</a></li>
                        <li class="nav-item"><a class="nav-link" href="#services">Services</a></li>
                        <li class="nav-item"><a class="nav-link" href="#portfolio">Portfolio</a></li>
                        <li class="nav-item"><a class="nav-link" href="#contact">Contact</a></li>
                    </ul>
                </div>
            </div>
        </nav> --}}
        <div class="container">
            <div class="row">
                <div class="col-md-5">
                    <div class="project-info-box mt-0">
                        <h5>{{ $home->title }}</h5>
                        <p class="mb-0">{{ $home->description }}</p>
                    </div><!-- / project-info-box -->

                    <div class="project-info-box">
                        <div id="alert_data"></div>
                        <p><b>Address:</b> CUPCAKE CO</p>
                        <p><b>Price:</b> {{ $home->price }}</p>
                        <form id="formData">
                            @csrf
                            <input type="hidden" name="id" value="{{ $home->id }}">
                            <p class="mb-0"><b>Select Date:</b> <input type="date" name="date" id=""></p>
                            <input class="btn btn-primary" type="submit" value="choose" required>
                        </form>
                    </div><!-- / project-info-box -->
                </div><!-- / column -->

                <div class="col-md-7">
                    <img src="{{ asset($home->image) }}" alt="project-image" class="rounded">
                    <div class="project-info-box">
                        <p><b>Categories:</b> Design, Illustration</p>
                    </div><!-- / project-info-box -->
                </div><!-- / column -->
            </div>
        </div>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

        <script>
            $("#formData").submit(function (e) {

            e.preventDefault(); // avoid to execute the actual submit of the form.
            $.ajax({
                type: "POST",
                url: '/home-details/choose',
                data: $(this).serialize(),
                success: function (data) {
                    if (data.specialPrice == 'yes') {
                        console.log('yes');
                    } esle {
                        $('#alert_data').empty()
                        $('#alert_data').append('<div class="alert alert-success alert-dismissible fade show" role="alert">' +
                            '<i class="fa fa-exclamation-circle me-2"></i>Successfuly operation' +
                            '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>' +
                            '</div>')
                        setTimeout(function () {
                            $('#alert_data').empty()
                        }, 5000);
                    }

                },
                error: function (data) {
                    $('#alert_data').empty();
                    for (const key in data.responseJSON.errors) {
                        $('#alert_data').append(
                            '<div class="alert alert-danger alert-dismissible fade show" role="alert">\n' +
                            '<i class="fa fa-exclamation-circle me-2"></i>' + data.responseJSON.errors[key][0] + '\n' +
                            '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>\n' +
                            '</div>'
                        )
                    }
                }
            });
            });
        </script>
    </body>
</html>

