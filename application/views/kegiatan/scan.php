<div class="row">
    <div class="col-md-6">
        <div class="form-group row">
            <label class="col-md-4 col-form-label" for="sebagai">Pilih Kamera</label>
            <select class="form-control col-md-8" id="sebagai"></select>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12 text-center">
        <h4>Arahkan QR-Code <b><?= $sebagai ?></b> Ke Kamera!</h4>
        <canvas class="my-1"></canvas>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <table class="table table-bordered responsive" width="100%" id="dataTables_absen">
            <thead>
                <tr>
                    <th>No</th>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>Keterangan</th>
                    <th>--</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no_kg = $this->uri->segment('3');
                $no = 1;
                foreach ($tampil['result'] as $t) :
                    ?>
                    <tr>
                        <td><?= $no ?></td>
                        <td><?= $t['id_peserta'] ?></td>
                        <td><?= $t['nm_pd'] ?></td>
                        <td><?= $t['keterangan'] ?></td>
                        <td>
                            <?php
                                $id_peserta = substr($t['id_peserta'], 0, 2);
                                if ($id_peserta != 'PS') {
                                    $jns = 'mhs_unma';
                                } else {
                                    $jns = 'non_unma';
                                }
                                ?>
                            <a href="<?= base_url("Absen/del_absen/" . $no_kg . '/' . $t['id_absen']) ?>" onclick="return confirm('Apakah anda yakin ingin menghapus <?= $t['nm_pd'] ?> ?')" class="btn btn-danger btn-sm mt-1">
                                <i class="fa fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                <?php $no++;
                endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<script type="text/javascript" src="<?= base_url("extra-libs/webcodecamjs/") ?>js/qrcodelib.js"></script>
<script type="text/javascript" src="<?= base_url("extra-libs/webcodecamjs/") ?>js/webcodecamjquery.js"></script>
<script>
    //script tabel
    $(document).ready(function() {
        var tabel = $('#dataTables_absen').DataTable({
            responsive: true,
            language: {
                url: "<?= base_url("assets/ID.json"); ?>"
            },

        });
    });


    //SCRIPT WEBCODECAM
    var arg = {
        resultFunction: function(result) {
            var sebagai = '<?= $sebagai; ?>';
            var redirect = '<?= base_url("Absen/hasil_scan/" . $no_kg) ?>/' + sebagai;
            $.redirectPost(redirect, {
                no_qr: result.code //no_qr
            });
        }
    };

    var decoder = $("canvas").WebCodeCamJQuery(arg).data().plugin_WebCodeCamJQuery;
    decoder.buildSelectMenu("select");
    decoder.play();
    $('select').on('change', function() {
        decoder.stop().play();
    });

    // jquery extend function
    $.extend({
        redirectPost: function(location, args) {
            var form = '';
            $.each(args, function(key, value) {
                form += '<input type="hidden" name="' + key + '" value="' + value + '">';
            });
            $('<form action="' + location + '" method="POST">' + form + '</form>').appendTo('body').submit();
        }
    });

    //CONFIGURASI CAMERA
    decoder.options.zoom = 0;
    decoder.options.flipHorizontal = true;
</script>