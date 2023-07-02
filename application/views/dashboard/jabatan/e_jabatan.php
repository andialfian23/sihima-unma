<div class="row">
    <div class="col-md-6">

        <form action="<?= base_url('Admin/e_jabatan/' . $jabatan['id_jabatan']) ?>" method="post" accept-charset="utf-8">
            <div class="form-group row">
                <label for="jabatan" class="col-md-4 col-form-label">Nama Jabatan</label>
                <div class="col-md-8">
                    <div class="input-group">
                        <input type="text" name="jabatan" id="jabatan" class="form-control" autofocus value="<?= $jabatan['jabatan'] ?>">
                        <?= form_error('jabatan', '<div class="col-12"><small class="text-danger">', '</small></div>') ?>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <label for="level" class="col-md-4 col-form-label">Level Jabatan</label>
                <div class="col-md-8">
                    <div class="input-group">
                        <select name="level" id="level" class="form-control">
                            <?php
                            $role = $this->db->get_where('t_role', ['level' => $jabatan['level']])->row_array()['role'];
                            ?>
                            <option value="<?= $jabatan['level'] ?>" hidden><?= $role ?></option>
                            <?php
                            $level = $this->db->where('level>', '3')->where('level<7')->get('t_role')->result_array();
                            foreach ($level as $t) :
                            ?>
                                <option value="<?= $t['level'] ?>"><?= $t['role'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-7 offset-md-5">
                    <input type="submit" value="Simpan" class="btn btn-primary btn-md" />
                    <input type="reset" value="Ulangi" class="btn btn-danger btn-md" />
                </div>
            </div>
        </form>
    </div>
</div>