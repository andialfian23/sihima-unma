<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">

<head>
    <?php $this->load->view('template/head') ?>

</head>

<body class="vertical-layout vertical-menu-modern 2-columns menu-collapsed fixed-navbar" data-open="click" data-menu="vertical-menu-modern" data-col="2-columns">
    <!-- TOPBAR -->
    <?php $this->load->view('template/header') ?>
    <!-- END TOPBAR -->

    <!-- SIDEBAR -->
    <?php $this->load->view('template/sidebar'); ?>

    <!-- END SIDEBAR -->

    <!-- CONTENT  -->
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-body">
                <!-- START -->
                <section id="compact-style">
                    <div class="row">
                        <div class="col-12">

                            <?= $this->session->flashdata('message'); ?>

                            <div class="card" style="zoom: 1;">
                                <div class="card-header">
                                    <h2 class="card-title"><?= $title ?> </h2>
                                    <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                                    <div class="heading-elements">
                                        <ul class="list-inline mb-0">
                                            <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="card-content collapse show">
                                    <div class="card-body card-dashboard">

                                        <?= $this->session->flashdata('toastr'); ?>

                                        <?php $this->load->view($file) ?>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- FINISH -->
            </div>
        </div>
    </div>
    <!-- END CONTENT -->

    <?php $this->load->view('template/footer') ?>

    <!-- BEGIN MODERN JS-->
    <?php $this->load->view('template/js') ?>
    <!-- END MODERN JS-->
</body>

</html>