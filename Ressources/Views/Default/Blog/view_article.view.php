<div class="container">
    <div class="row">
        <section class="title-page col-12">
            <div class="marg-container">
                <h2><a class="btn-sm btn-dark" href="<?php echo $this->slugs["bloghome"]; ?>">Blog</a><span
                            class="additional-message-title"> / <?php echo $article_content['title']; ?></span></h2>
            </div>
        </section>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-12">
            <div>
                <div class="article">
                    <div class="content-article">
                        <div class="container">
                            <div class="row">
                                <div class="col-10">
                                    <div>
                                        <section class="media-content">
                                        </section>
                                        <section class="text-content">
                                            <div class="title-article">
                                                <h1><?php echo $article_content['title']; ?></h1>
                                            </div>
                                            <div class="text-article">
                                                <p><?php echo $article_content['content'] ?></p>
                                            </div>
                                        </section>
                                        <section class="info-article">
                                            <div>
                                                <span>Created <?php echo $article_content['datecreate'] ?></span>
                                            </div>
                                        </section>
                                        <!--<section class="action-article">
                                            <nav>
                                                <div class="action">
                                                    <div class="container">
                                                        <div class="svg-action">
                                                            <i class="material-icons">
                                                                share
                                                            </i>
                                                        </div>
                                                        <div class="name-action">share</div>
                                                    </div>
                                                </div>
                                                <div class="action">
                                                    <div class="container">
                                                        <div class="svg-action">
                                                            <i class="material-icons">
                                                                code
                                                            </i>
                                                        </div>
                                                        <div class="name-action">integrate</div>
                                                    </div>
                                                </div>
                                            </nav>
                                        </section>-->
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <div>
                                        <h3>Comments</h3>
                                        <div class="container">
                                            <?php if(isset($comments)):?>
                                                <?php $this->addModal("comment", $comments); ?>
                                            <?php else:?>
                                                <p>Aucun commentaire pour le moment</p>
                                            <?php endif;?>
                                            <?php if(isset($this->Auth)):?>
                                                <?php $this->addModal("form", $formAddComment, $errors); ?>
                                            <?php endif;?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
