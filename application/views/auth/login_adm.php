<div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

        <div class="col-lg-7">

            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-lg">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">Login Page</h1>
                                </div>

                                <!-- jika sedang sesi OTP -->
                                <?php
                                $modOTP = $this->session->userdata('emailOTP');
                                $sesi = $this->session->userdata('sesiotp');

                                if ($modOTP) { ?>

                                    <form class="user" method="post" action="<?= base_url('admin_auth'); ?>">
                                        <div class="form-group">
                                            <input type="text" hidden class="form-control" id="email" name="email" value="<?= $modOTP; ?>">
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="kode_otp" name="kode_otp" placeholder="Masukkan Kode OTP anda!">
                                        </div>
                                        <p style="color: red; font-style: italic;">pastikan sesi kode otp yang dikirim sama dengan yang tampil pada halaman ini</p>
                                        <p style="color: black; font-style: bold">sesi KodeOTP = <?= $sesi; ?></p>
                                        <button type="submit" class="btn btn-primary btn-user btn-block border-bottom-success">
                                            Submit
                                        </button>
                                    </form>

                                <?php } else { ?>
                                    <form class="user" method="post" action="<?= base_url('admin_auth'); ?>">
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="nip" name="nip" placeholder="Nomor Induk Pegawai" value="<?= set_value('nip'); ?>">
                                            <?= form_error('nip', '<small class="text-danger pl-3">', '</small>'); ?>
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                                            <?= form_error('password', '<small class="text-danger pl-3">', '</small>'); ?>
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-user btn-block border-bottom-success">
                                            Login
                                        </button>
                                    </form>
                                <?php } ?>

                                <hr>
                                <center><a href="<?= base_url('') ?>">->kembali ke halaman utama</a></center>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

</div>