

<style>
    .fcontainer-modal{
        font-size: 0.8em;
    }
    .card{
        width: 10em;
    }
    .card-body{
        /* padding: 10px; */
        padding: 0.5rem 0.5rem !important;
    }
    .preloader {
        width: 70px;
        height: 70px;
        border: 10px solid #eee;
        border-top: 10px solid #666;
        border-radius: 50%;
        animation-name: girar;
        animation-duration: 2s;
        animation-iteration-count: infinite;
        animation-timing-function: linear;
        margin: auto;
        margin-top: 4%;
        margin-bottom: 6%;

    }
    .preloader2{
        margin: auto;
        /* margin-top: 15%; */
    }
    #imgCuadro{
        display: flex;
    }
    /* #preloader{
        display: block;
        margin: auto;
        margin-top: 15%;
    } */
    @keyframes girar {
    from {
        transform: rotate(0deg);
    }
    to {
        transform: rotate(360deg);
    }
    }
</style>
<div class="container">
    <div class="form-row align-items-center">
        <div class="col-6">
            <label class="sr-only" for="inlineFormInput">Mis Enlaces</label>
            <input type="text" class="form-control mb-2" id="inlineFormInput" name="url" placeholder="https://cuevana3.io/serie/panic">
        </div>
        <div class="col-auto">
            <button type="submit" class="btn btn-primary mb-2" onclick="ejecutar();">Submit</button>
        </div>
    </div>    


        <!-- ======= Portfolio Details Section ======= -->
<section id="portfolio-details" class="portfolio-details">
    <div class="container">
        <div class="row">

            <div class="col-lg-8">
            <div id="resul-title">
                <!-- <h2 class="portfolio-title">This is an example of portfolio detail</h2> -->
            </div>
            <div id="imgCuadro">
                <div id="resul-img" class="owl-carousel portfolio-details-carousel">
                    <!-- <img src="assets/img/portfolio/portfolio-1.jpg" class="img-fluid" alt="">
                    <img src="assets/img/portfolio/portfolio-2.jpg" class="img-fluid" alt="">
                    <img src="assets/img/portfolio/portfolio-3.jpg" class="img-fluid" alt=""> -->
                </div>
                <div id="resul-img2" class="owl-carousel portfolio-details-carousel">
                    <div id="tmdb_id"></div>
                    <div id="tmdb_title"></div>
                    <!-- <img src="assets/img/portfolio/portfolio-1.jpg" class="img-fluid" alt="">
                    <img src="assets/img/portfolio/portfolio-2.jpg" class="img-fluid" alt="">
                    <img src="assets/img/portfolio/portfolio-3.jpg" class="img-fluid" alt=""> -->
                </div>
            </div>
            </div>

            <div class="col-lg-4 portfolio-info">
            <ul>
            <div id="info_s"></div>
            </ul>
            <!-- <h3>Información</h3> -->
            <!-- <ul>
                <li><strong>Category</strong>: Web design</li>
                <li><strong>Client</strong>: ASU Company</li>
                <li><strong>Project date</strong>: 01 March, 2020</li>
                <li><strong>Project URL</strong>: <a href="#">www.example.com</a></li>
            </ul> -->

            <div id="result-descripcion">

            </div>
            <!-- <p>
                Autem ipsum nam porro corporis rerum. Quis eos dolorem eos itaque inventore commodi labore quia quia. Exercitationem repudiandae officiis neque suscipit non officia eaque itaque enim. Voluptatem officia accusantium nesciunt est omnis tempora consectetur dignissimos. Sequi nulla at esse enim cum deserunt eius.
            </p> -->
            </div>

        </div>
    </div>
</section><!-- End Portfolio Details Section -->

<div class="row">
        <div class="preloader" style="display: none;"></div>
</div>

<hr class="mb-5"/>
<section>
      
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <!-- <li class="nav-item waves-effect waves-light">
            <a class="nav-link" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="false">Home</a>
        </li>
        <li class="nav-item waves-effect waves-light">
            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Profile</a>
        </li>
        <li class="nav-item waves-effect waves-light">
            <a class="nav-link active" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="true">Contact</a>
        </li> -->
    </ul>
    <div class="tab-content" id="myTabContent">
    </div>
    <!-- <div class="col-6" id="enlaces_comprobados" style="font-size: 13px;"></div> -->
</section>



<!-- 
<section id="hero" class="d-flex align-items-center">
    

    <div id="resul-img" class="container d-flex flex-column align-items-center justify-content-center" data-aos="fade-up">

        <h1>Enlaces directos mas faciles</h1>
        <h2>By Break</h2>
    </div>

</section> -->
<!-- End Hero -->

    
    <div class="row">
        <div class="preloader" style="display: none;"></div>
    </div>
    <div class="row" id="resultado">
    </div>
    <div class="row">
        <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Enlaces</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div id="cargap" class="col-6"></div>
                    <div class="modal-body">
                        <div>
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a href="#home" class="nav-link active" id="home-tab" data-toggle="tab" role="tab" aria-contols="home" aria-selected="true">Home</a>
                                </li>
                                <li class="nav-item">
                                    <a href="#profile" class="nav-link" id="profile-tab" data-toggle="tab" role="tab" aria-contols="profile" aria-selected="false">ID Pelicula</a>
                                </li>
                                <li class="nav-item">
                                    <a href="#contact" class="nav-link" id="contact-tab" data-toggle="tab" role="tab" aria-contols="contact" aria-selected="false">Contact</a>
                                </li>
                            </ul>
                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                    <div class="container fcontainer-modal">
                                    
                                        <div class="row">
                                            <div class="col-8">
                                                <div class="preloader1" style="display: none;">
                                                    <div class="preloader"></div>
                                                </div>
                                            <!-- <img src="http://167.86.105.129/panel/assets/images/45.svg" alt="" srcset="" style="margin: auto;display: block;"> -->
                                                <div id="modalEnlaces"></div>
                                            </div>
                                            <div class="preloader2" style="display: none;">
                                                <div class="preloader"></div>
                                            </div>
                                            <div class="col-4" id="modalPeso"></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12">
                                                <div id="MostrarComando"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                    <div class="container fcontainer-modal">
                                        <div class="card-deck" >
                                            <div class="row" id="MostrarComando"></div>
                                            <div class="row" id="tmdbContenedor"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                                    <h3>Contact Us</h3>
                                    <h4>Avadh Tutor get daily videos</h4>
                                    <!-- <div id="MostrarComando"></div> -->
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- </div> -->
</div>

<!-- <script src="assets/js/sc.js"></script> -->
<script src="assets/js/scraping.js"></script>


