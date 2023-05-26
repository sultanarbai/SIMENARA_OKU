<div class="container">

    <div class="card o-hidden border-0 shadow-lg my-5 col-lg-7 mx-auto">
        <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
                <div class="col-lg">
                    <div class="p-5">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
                        </div>
                        <form class="user" method="post" action="<?= base_url('admin_auth/registration'); ?>" enctype="multipart/form-data">

                            <div class="form-group">
                                <input type="text" class="form-control   border-bottom-primary" id="name" name="name" placeholder="Full name" value="<?= set_value('name'); ?>">
                                <?= form_error('name', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control   border-bottom-primary" id="nip" name="nip" placeholder="nip" value="<?= set_value('nip'); ?>">
                            </div>

                            <div class="form-group">
                                <input type="email" class="form-control   border-bottom-warning" id="email" name="email" placeholder="Email Address" value="<?= set_value('email'); ?>">
                                <?= form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>

                            <div class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <input type="password" class="form-control   border-bottom-danger" id="password1" name="password1" placeholder="Password">
                                    <?= form_error('password1', '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>
                                <div class="col-sm-6">
                                    <input type="password" class="form-control   border-bottom-danger" id="password2" name="password2" placeholder="Repeat Password">
                                </div>
                            </div>

                            <div class="form-group">
                                <input type="text" class="form-control   border-bottom-primary" id="no_hp" name="no_hp" placeholder="nomor HP" value="<?= set_value('no_hp'); ?>">
                            </div>

                            <div class="form-group">
                                <select class="form-control border-bottom-primary" name="tipe" required>
                                    <option value="<?= set_value('tipe'); ?>">Pilih jenis akun</option>
                                    <option value="super_admin">Super Admin</option>
                                    <option value="kadin">Kepala Dinas</option>
                                    <option value="sekdin">Sekretaris Dinas</option>
                                    <option value="kabid">Kepala Bidang</option>
                                    <option value="kasi">Kepala Seksi</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <input type="text" class="form-control   border-bottom-primary" id="alamat" name="alamat" placeholder="alamat" value="<?= set_value('alamat'); ?>">
                            </div>

                            <button type="submit" class="btn btn-primary btn-user btn-block  border-bottom-success">
                                Register Account
                            </button>
                        </form>
                        <hr>
                        <p style="color: red; font-style: italic;">pastikan no HP anda benar</p>
                        <div class="text-center">
                            <a class="small" href="<?= base_url('admin_auth/forgotpassword'); ?>">Forgot Password?</a>
                        </div>
                        <div class="text-center">
                            <a class="small" href="<?= base_url('admin_auth'); ?>">Already have an account? Login!</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>