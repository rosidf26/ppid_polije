<!DOCTYPE html>
<html>

<head>
    <!-- ini head -->
    @include('frontpage.templates.head')
</head>

<body>

    <div class="body">
        <!-- ini header -->
        @include('frontpage.templates.header')

        <div role="main" class="main">

            <!-- ini header -->
            @include('frontpage.sections.page_header')

            <div class="container py-4">

                <div class="row">
                    <div class="col">
                        <div class="blog-posts single-post">

                            <article class="post post-large blog-single-post border-0 m-0 p-0">
                                <h4 class="mb-3">OPSI 1</h4>

                                <div class="post-content ml-0">
                                    <img src="{{ url('frontpage/img/blog/medium/blog-5.jpg') }}" class="img-fluid float-left mr-4 mt-2" alt="" />
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur lectus lacus, rutrum sit amet placerat et, bibendum nec mauris. Duis molestie, purus eget placerat viverra, nisi odio gravida sapien, congue tincidunt nisl ante nec tellus. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce sagittis, massa fringilla consequat blandit, mauris ligula porta nisi, non tristique enim sapien vel nisl. Suspendisse vestibulum lobortis dapibus. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Praesent nec tempus nibh. Donec mollis commodo metus et fringilla. Etiam venenatis, diam id adipiscing convallis, nisi eros lobortis tellus, feugiat adipiscing ante ante sit amet dolor. Vestibulum vehicula scelerisque facilisis. Sed faucibus placerat bibendum. Maecenas sollicitudin commodo justo, quis hendrerit leo consequat ac. Proin sit amet risus sapien, eget interdum dui. Proin justo sapien, varius sit amet hendrerit id, egestas quis mauris.</p>
                                    <p>Ut ac elit non mi pharetra dictum nec quis nibh. Pellentesque ut fringilla elit. Aliquam non ipsum id leo eleifend sagittis id a lorem. Sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Aliquam massa mauris, viverra et rhoncus a, feugiat ut sem. Quisque ultricies diam tempus quam molestie vitae sodales dolor sagittis. Praesent commodo sodales purus. Maecenas scelerisque ligula vitae leo adipiscing a facilisis nisl ullamcorper. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae;</p>
                                    <p>Curabitur non erat quam, id volutpat leo. Nullam pretium gravida urna et interdum. Suspendisse in dui tellus. Cras luctus nisl vel risus adipiscing aliquet. Phasellus convallis lorem dui. Quisque hendrerit, lectus ut accumsan gravida, leo tellus porttitor mi, ac mattis eros nunc vel enim. Nulla facilisi. Nam non nulla sed nibh sodales auctor eget non augue. Pellentesque sollicitudin consectetur mauris, eu mattis mi dictum ac. Etiam et sapien eu nisl dapibus fermentum et nec tortor.</p>
                                    <p>Curabitur nec nulla lectus, non hendrerit lorem. Quisque lorem risus, porttitor eget fringilla non, vehicula sed tortor. Proin enim quam, vulputate at lobortis quis, condimentum at justo. Phasellus nec nisi justo. Ut luctus sagittis nulla at dapibus. Aliquam ullamcorper commodo elit, quis ornare eros consectetur a. Curabitur nulla dui, fermentum sed dapibus at, adipiscing eget nisi. Aenean iaculis vehicula imperdiet. Donec suscipit leo sed metus vestibulum pulvinar. Phasellus bibendum magna nec tellus fringilla faucibus. Phasellus mollis scelerisque volutpat. Ut sed molestie turpis. Phasellus ultrices suscipit tellus, ac vehicula ligula condimentum et.</p>
                                    <p>Aenean metus nibh, molestie at consectetur nec, molestie sed nulla. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam nec euismod urna. Donec gravida pharetra ipsum, non volutpat ipsum sagittis a. Phasellus ut convallis ipsum. Sed nec dui orci, nec hendrerit massa. Curabitur at risus suscipit massa varius accumsan. Proin eu nisi id velit ultrices viverra nec condimentum magna. Ut porta orci quis nulla aliquam at dictum mi viverra. Maecenas ultricies elit in tortor scelerisque facilisis. Mauris vehicula porttitor lacus, vel pretium est semper non. Ut accumsan rhoncus metus non pharetra. Quisque luctus blandit nisi, id tempus tellus pulvinar eu. Nam ornare laoreet mi a molestie. Donec sodales scelerisque congue. </p>

                                </div>

                                <h4 class="mb-3">OPSI 2</h4>

                                <div class="post-image ml-0">
                                    <div class="embed-responsive embed-responsive-16by9">
                                        <video class="embed-responsive-item" autoplay="" muted="" loop="" controls="">
                                            <source src="video/memory-of-a-woman.mp4" type="video/mp4">
                                        </video>
                                    </div>
                                </div>
                            </article>

                        </div>
                    </div>
                </div>

            </div>

        </div>
        <!-- ini footer -->
        @include('frontpage.templates.footer')

    </div>

    <!-- ini js -->
    @include('frontpage.templates.js')


</body>

</html>