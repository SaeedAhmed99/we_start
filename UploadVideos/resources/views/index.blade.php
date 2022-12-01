<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Laravel 9 JavaScript File Upload with Progress Bar</title>
        <link rel="stylesheet" href="{{ asset('css/style.css') }}">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body>
        <section>
            <form id="uploadFile" autocomplete="off" enctype="multipart/form-data">
                @csrf
                @method('post')
                <p>Upload File</p>
                <div id="alert"></div>
                <div>
                    <input type="file" name="video" id="upload" style="display: none">
                    <label for="upload">Select File</label>
                </div>
                <button><span>&#8682; Upload</span> <span class="uploading">Uploading.....</span></button>
                <button class="cancel">Cancel Upload</button>
                <div  class="pr">
                    <strong>
                        <h4 class="ex">PDF</h4>
                        <h5 class="size">2.5kb</h5>
                    </strong>
                    <progress min="0" max="100" value="0"></progress>
                    <span  class="progress-indicator"></span>
                </div>
            </form>
        </section>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script>
            let file = document.getElementById('upload');
            let button = document.getElementsByTagName('button');
            let progress = document.querySelector('progress');
            let p_i = document.querySelector('.progress-indicator');
            let load  = 0;
            let process = '';


            file.oninput = ()=> {
                let filename = file.files[0].name;
                let extention = filename.split('.').pop();
                let filesize = file.files[0].size;

                if (filesize <= 1000000) {
                    filesize = (filesize/1000).toFixed(2) + 'kb';
                }

                if (filesize == 1000000 || filesize <= 1000000000) {
                    filesize = (filesize/1000000).toFixed(2) + 'mb';
                }

                if (filesize == 1000000000 || filesize <= 1000000000000) {
                    filesize = (filesize/1000000000).toFixed(2) + 'gb';
                }

                document.querySelector('label').innerHTML = filename;
                document.querySelector('.ex').innerHTML = extention;
                document.querySelector('.size').innerHTML = filesize;
                getFile(filename);
            }

            let upload = ()=> {
                if(load >= 100) {
                    setInterval(process);
                    p_i.innerHTML = '100%' + ' ' + 'Upload Completed';
                    button[0].classList.remove('active');
                } else {
                    load++;
                    progress.value = load;
                    p_i.innerHTML = load + '%' + ' ' + 'Upload ';
                    button[1].onclick = e=>{
                        e.preventDefault();
                        setInterval(process);
                        document.querySelector('.pr').style.display = 'none';
                        button[1].style.visibility = 'hidden';
                        button[0].classList.remove('active');
                    }
                }
            }

            function getFile(fileName) {
                if(fileName) {
                    document.querySelector('.pr').style.display = 'block';
                    load = 0;
                    progress.value = 0;
                    p_i.innerText = '';
                    button[0].onclick = e=>{
                        e.preventDefault();
                        button[0].classList.add('active');
                        button[1].style.visibility = 'visible';
                        process = setInterval(upload, 100);
                        $("#uploadFile").submit();
                        $("#uploadFile").submit(function (e) {
                            e.preventDefault();
                            // var formData = new FormData(this);
                            var formData = new FormData($('#uploadFile')[0]);
                            console.log('ascascas');
                            $.ajax({
                                type: "POST",
                                enctype: 'multipart/form-data',
                                url: 'upload',
                                data: formData,
                                cache: false,
                                contentType: false,
                                processData: false,
                                success: function (data) {
                                    $('#alert').empty()
                                    $('#alert').append(`
                                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                                            <i class="fa fa-exclamation-circle me-2"></i>Successfuly Uploaded
                                        </div>
                                    `)
                                },
                                error: function (data) {
                                    $('#alert').empty()
                                    for (const key in data.responseJSON.errors) {
                                        $('#alert').append(
                                            '<div class="alert alert-danger alert-dismissible fade show" role="alert">\n' +
                                            '<i class="fa fa-exclamation-circle me-2"></i>' + data.responseJSON.errors[key][0] + '\n' +
                                            '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>\n' +
                                            '</div>'
                                        )
                                    }
                                }
                            });
                        });
                    }
                }
            }

        </script>
        {{-- <link rel="stylesheet" href="{{ asset('js/main.js') }}"> --}}
    </body>
</html>
