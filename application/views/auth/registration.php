<div class="container">

    <div class="card o-hidden border-0 shadow-lg my-5 col-lg-7 mx-auto">
        <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
                <div class="col-lg">
                    <div class="p-5">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4">Buat Akun Pengguna Baru</h1>
                        </div>
                        <form class="user" method="post" action="<?= base_url('auth/registration'); ?>" enctype="multipart/form-data">

                            <div class="form-group">
                                <input type="text" class="form-control" id="name" name="name" placeholder="Full name" value="<?= set_value('name'); ?>">
                                <?= form_error('name', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>

                            <div class="form-group">
                                <input type="email" class="form-control" id="email" name="email" placeholder="Email Address" value="<?= set_value('email'); ?>">
                                <?= form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>

                            <div class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <input type="password" class="form-control" id="password1" name="password1" placeholder="Password">
                                    <?= form_error('password1', '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>
                                <div class="col-sm-6">
                                    <input type="password" class="form-control" id="password2" name="password2" placeholder="Repeat Password">
                                </div>
                            </div>

                            <div class="form-group">
                                <input type="text" class="form-control" id="no_identitas" name="no_identitas" placeholder="no ktp" value="<?= set_value('no_identitas'); ?>">
                                <?= form_error('no_identitas', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>

                            <div class="form-group">
                                <select class="form-control" name="tipe_identitas">
                                    <option value="<?= set_value('tipe_identitas'); ?>">Pilih jenis identitas</option>
                                    <option value="ktp">ktp</option>
                                    <option value="pasport">pasport</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <select class="form-control" name="atwork">
                                    <option value="<?= set_value('atwork'); ?>">bekerja di provider ?</option>
                                    <?php foreach ($provid->result() as $pro) { ?>
                                        <option value="<?= $pro->id_provider; ?>">

                                            <i class="fa fa-plus">
                                                <?= $pro->nama_provider; ?>
                                            </i>

                                        </option>
                                    <?php } ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <input type="text" class="form-control" id="alamat" name="alamat" placeholder="alamat" value="<?= set_value('alamat'); ?>">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" id="no_hp" name="no_hp" placeholder="nomor hp" value="<?= set_value('no_hp'); ?>">
                            </div>


                            <hr>
                            <!-- input data diri -->
                            <p style="color: red; font-style: italic;">pastikan no HP anda benar</p>
                            <!-- bukti SK kerja -->
                            <!-- <div class="form-group">
                                <label for="file1" class="col-sm-4 col-form-label">Input SK Kerja Anda </label>
                                <input type="file" class="form-control" name="file1" id="file1">
                            </div> -->
                            <!-- bukti identitas -->
                            <!-- <div class="form-group">
                                <label for="file2" class="col-sm-4 col-form-label">Input File Identitas Anda </label>
                                <input type="file" class="form-control" name="file1" id="file2">
                            </div> -->

                            <button type="submit" class="btn btn-primary btn-user btn-block  border-bottom-success">
                                Register Account
                            </button>
                        </form>

                        <hr>
                        <div class="text-center">
                            <a class="small" href="<?= base_url('auth/forgotpassword'); ?>">Forgot Password?</a>
                        </div>
                        <div class="text-center">
                            <a class="small" href="<?= base_url('auth'); ?>">Already have an account? Login!</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>