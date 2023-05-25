<?php
session_start();
require ('inc/pdo.php');
require ('inc/fonction.php');
require('inc/request.php');
require('inc/validation.php');



include ('inc/header.php'); ?>
    <section id="a_propos">
        <div class="wrap">
            <div class="container_apropos">
                <div class="text_apropos">
                    <p>À propos de nous</p>
                </div>
            </div>
        </div>
    </section>

    <section id="qui_sommesnous">
        <div class="wrap">
            <div class="container_apropos">
                <div class="img">
                    <img src="asset/img/img-equipe.svg" alt="">
                </div>
                <div class="text">
                    <h2>Qui nous-sommes ?</h2>
                    <p>Lorem ipsum dolor sit amet,
                        consectetur adipisicing elit.
                        Ab consequatur dolore doloremque doloribus eos illum impedit itaque iusto nihil nobis officiis optio pariatur perspiciatis quas sed,
                        sequi soluta veniam voluptas.
                        Accusamus, ad aliquid aperiam blanditiis consequatur est fugiat illo nobis,
                        nostrum placeat porro quibusdam sint voluptatibus.
                        Ad animi at aut cumque cupiditate dolor dolorem doloribus earum eligendi enim eum fuga fugiat fugit illum,
                        impedit iste iusto laudantium maxime minima minus necessitatibus nemo nulla porro praesentium provident quaerat quibusdam repellat similique sit soluta sunt totam ullam ut vel veniam voluptas voluptatum!
                        Accusantium beatae consectetur corporis deleniti earum excepturi facilis ipsam natus,
                        non nostrum officia omnis qui sapiente sit suscipit voluptas voluptatum.
                        Ad autem blanditiis commodi cumque deleniti iure magni molestias nesciunt provident quibusdam,
                        quidem sunt vitae voluptatem.
                        Dicta quod quos tenetur?
                    </p>
                </div>
            </div>
            <div class="container_apropos2">
                <div class="img">
                    <img src="asset/img/a_propos_img_2.png" alt="">
                </div>
                <div class="text">
                    <h2>Comment fonctionne le carnet ?</h2>
                    <p>Lorem ipsum dolor sit amet,
                        consectetur adipisicing elit.
                        Accusamus accusantium error eveniet explicabo illo,
                        maxime nesciunt nihil omnis pariatur sequi sit,
                        voluptatibus?
                        Accusamus assumenda commodi cupiditate doloribus fuga minus modi qui quibusdam veniam!
                        Animi consequatur dolor eaque,
                        illo iste labore molestiae numquam odio placeat quibusdam rem repellat similique sint sunt voluptatibus.
                        Cupiditate delectus,
                        doloremque iusto neque nostrum praesentium reiciendis sed sint unde!
                        A aperiam consectetur explicabo iusto natus similique sunt ut voluptas!
                        Alias assumenda autem cumque dolor dolores,
                        dolorum enim esse est,
                        et eveniet ex exercitationem,
                        expedita fuga ipsum laudantium molestiae natus odio officiis omnis qui recusandae similique soluta tempore ut voluptatum!
                        Culpa fuga laborum modi neque soluta?
                    </p>
                </div>
            </div>
        </div>
    </section>

<section id="notre_equipe">
    <div class="wrap">
        <div class="container_apropos">
            <div class="titre">
                <h2>Notre équipe :</h2>
            </div>
            <div class="cont_apropos">
                <div class="img_equipe">
                    <div class="img">
                        <img src="asset/img/prince.svg" alt="">
                    </div>
                    <div class="text">
                        <h2>P.Prince</h2>
                        <p>Développeur & Chef d'équipe</p>
                    </div>
                </div>
                <div class="img_equipe">
                    <div class="img">
                        <img src="asset/img/lendoly.svg" alt="">
                    </div>
                    <div class="text">
                        <h2>O.Lendoly</h2>
                        <p>Développeur</p>
                    </div>
                </div>
                <div class="img_equipe">
                    <div class="img">
                        <img src="asset/img/claude.svg" alt="">
                    </div>
                    <div class="text">
                        <h2>M.Claude</h2>
                        <p>Développeur</p>
                    </div>
                </div>
                <div class="img_equipe">
                    <div class="img">
                        <img src="asset/img/mohamed.svg" alt="">
                    </div>
                    <div class="text">
                        <h2>M.Mohammed</h2>
                        <p>Développeur & Designeur</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php include ('inc/footer.php');