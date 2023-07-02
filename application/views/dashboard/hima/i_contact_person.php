<div class="row">
    <div class="col-md-6">

        <form action="<?= base_url('Himpunan/add_cp') ?>" method="post" accept-charset="utf-8">
            <?php if (akses('Admin')->num_rows() > 0) { ?>
                <div class="form-group row">
                    <label class="col-md-3 label-control" for="id_hima">Himpunan</label>
                    <div class="col-md-9">
                        <select id="id_hima" name="id_hima" class="form-control" required>
                            <option value="<?= session_gan('hima_id') ?>" hidden><?= session_gan('nama_hima') ?></option>
                            <?php
                            $hima = $this->db->get('t_hima')->result();
                            foreach ($hima as $h) {
                                echo '<option value="' . $h->id_hima . '"> ' . $h->nama_hima . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                </div>

            <?php } ?>
            <div class="form-group row">
                <label for="nama_contact" class="col-md-4 col-form-label">Nama Kontak</label>
                <div class="col-md-8">
                    <div class="input-group">
                        <input type="text" name="nama_contact" id="nama_contact" class="form-control" autofocus>
                        <?= form_error('nama_contact', '<div class="col-12"><small class="text-danger">', '</small></div>') ?>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <label for="no_telp" class="col-md-4 col-form-label">Nomor Telepon</label>
                <div class="col-md-8">
                    <div class="input-group">
                        <input type="text" name="no_telp" id="no_telp" class="form-control">
                        <?= form_error('no_telp', '<div class="col-12"><small class="text-danger">', '</small></div>') ?>
                    </div>
                </div>
            </div>

            <div class="form-group row">
                <div class="col-md-7 offset-md-5">
                    <input type="submit" value="Simpan" class="btn btn-primary btn-md" />
                </div>
            </div>
        </form>
    </div>
</div>