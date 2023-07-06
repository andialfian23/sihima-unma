<!DOCTYPE html>

<html class="loading" lang="en" data-textdirection="ltr">

<head>
    <?php $this->load->view('dashboard/template/head') ?>
</head>

<body class="vertical-layout ">
    <!-- fixed-top-->
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-body">
                <!--START-->
                <section id="compact-style">
                    <div class="card" style="zoom: 1; background:#000;">
                        <div class="card-content collapse show">
                            <div class="card-body card-dashboard">
                                <div class="row rounded p-1">
                                    <?= $this->session->flashdata('message'); ?>
                                </div>
                                <div class="row">
                                    <?php
                                    $result = json_decode($this->curl->simple_get(ADD_API . 'API/App?id_app=16'), true);
                                    $no2 = 0;
                                    foreach ($result as $t) {
                                        $msg = [];
                                        $id_user = ($t['app_level'] == '1') ? $t['id_user'] : $t['username'];
                                        $time = date('Y-m-d H:i:s');
                                        $msg = "$time#" . $id_user . "#" . $t['id_level'] . "#" . $t['app_level'] . "#" . $t['src_detail'];

                                        $id = encrypt_encode($msg);
                                    ?>

                                        <div class="col-md-3 col-sm-4">
                                            <div class="card">
                                                <div class="card-body">
                                                    <a href="<?= base_url("Auth/verify_v2/" . $id) ?>" class="btn-info text-white btn card-link btn-block">
                                                        <?= $t['nama_user'] ?>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    <?php
                                        $no2++;
                                    }
                                    ?>

                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!--END-->
            </div>
        </div>
    </div>
</body>

</html>